@extends('layouts.index')

@section('content')
<div class="container">
    <div class="my-5">
        <div class="p-3 d-flex justify-content-around">
            <div class="w-100">
                <div class="w-100 d-flex justify-content-around align-items-center">
                    <div class="w-75">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Periode</label>
                            <div class="col-sm-10">
                                <input id="daterange" type="text" name="daterange" class="form-control mb-2"
                                    value="{{ date('m/d/Y',strtotime($min)) }} - {{ date('m/d/Y',strtotime($max)) }}" />
                            </div>
                        </div>
                        <div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Merchant</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="" id="selectmerchant">
                                        <option value="semua">Semua </option>
                                        @foreach ($merchants as $merchant)
                                        <option value="{{ $merchant->id }}">{{ $merchant->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a id="btndaterange" href="#" class="ms-3 d-inline-block btn btn-primary">Cari</a>
                </div>
            </div>
            {{-- <div class="d-flex align-items-center">
                <button class="btn btn-warning" id="btnexport">Export</button>
            </div> --}}
        </div>
        <div class="table-responsive">
        </div>
        <table id="table" class="table table-striped table-bordered table-hover border display nowrap">
            <thead>
                <tr>
                    <th>Merchant Phone Number</th>
                    <th>Merchant Name</th>
                    <th>Nomor AWB</th>
                    <th>Marketplace</th>
                    <th>Courier Name</th>
                    <th>Waktu</th>
                    <th>Pencatat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
                    <td></td>
                    <td>{{ $log->merchant->nama }}</td>
                    <td>{{ $log->awb }}</td>
                    <td>{{ $log->ecom->nama }}</td>
                    <td>{{ $log->ekspdisi->nama }}</td>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->user->nama }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            responsive: true,
            dom: 'Bfrltip',
            columnDefs: [{
                target: 0,
                visible: false,
                searchable: false,
            }],
            buttons: [
                'copy',
                {
                    extend: 'excel',
                    title: '',
                    filename: "LOG {{ date('d M Y',strtotime($min)) }} {{ $max == $min ? '' : '- '.date('d M Y',strtotime($max)) }}",
                },
                {
                    extend: 'excel',
                    text: 'Excel Shipper Format',
                    title: '',
                    filename: "LOG {{ date('d M Y',strtotime($min)) }} {{ $max == $min ? '' : '- '.date('d M Y',strtotime($max)) }}",
                    exportOptions: {
                        columns: [0, 2, 3, 4]
                    },
                },
                {
                    extend: 'pdf',
                    title: '',
                    filename: "LOG {{ date('d M Y',strtotime($min)) }} {{ $max == $min ? '' : '- '.date('d M Y',strtotime($max)) }}"
                },
            ]
        });

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        const dateranges = $('#daterange').val().split(' - ');
        const mindate = formatDate(dateranges[0]);
        const maxdate = formatDate(dateranges[1]);
        let merchant = $('#selectmerchant').val();

        let url = `${mindate}/${maxdate
                }/${merchant}`;

        $('#btndaterange').attr('href', `/logs/${mindate}/${maxdate
                }/${merchant}`);
        $('#selectmerchant').change(function () {
            merchant = $('#selectmerchant').val();
            url = `${mindate}/${maxdate}/${merchant}`;
            $('#btndaterange').attr('href', `/logs/${mindate}/${maxdate
                }/${merchant}`);
        });



        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function (start, end, label) {
            $('#btndaterange').attr('href', `/logs/${start.format('YYYY-MM-DD')}/${end
                .format('YYYY-MM-DD')}`);
        });

        $('#btnexport').click(function () {
            $("#table").table2excel({
                filename: "LOG {{ date('d M Y',strtotime($min)) }} {{ $max == $min ? '' : '- '.date('d M Y',strtotime($max)) }}.xls"
            });
        });

    });

</script>
@endsection
