@extends('layouts.index')

@section('content')
<div class="container">
    <div class="my-5">
        <div class="p-3 d-flex justify-content-around">
            <div class="w-100">
                <h3>Periode</h3>
                <div class="d-flex">
                    {{-- @if (Request::is('logs/*'))
                    @php
                    $url = explode('/',Request::url());
                    @endphp
                    <input id="daterange" type="text" name="daterange" class="form-control w-25"
                        value="{{ date('m/d/Y', strtotime($url[4])) }} - {{ date('m/d/Y', strtotime($url[5])) }}" />
                    <a id="btndaterange" href="#" class="ms-3 btn btn-primary">Cari</a>
                    @else
                    <input id="daterange" type="text" name="daterange" class="form-control w-25"
                        value="{{ date('m/d/Y',strtotime($min)) }} - {{ date('m/d/Y',strtotime($max)) }}" />
                    <a id="btndaterange" href="#" class="ms-3 btn btn-primary">Cari</a>
                    @endif --}}
                    <input id="daterange" type="text" name="daterange" class="form-control w-25"
                        value="{{ date('m/d/Y',strtotime($min)) }} - {{ date('m/d/Y',strtotime($max)) }}" />
                    <a id="btndaterange" href="#" class="ms-3 btn btn-primary">Cari</a>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-warning" id="btnexport">Export</button>
            </div>
        </div>
        <table id="table" class="table table-striped table-bordered table-hover border display nowrap">
            <thead>
                <tr>
                    <th>Merchant</th>
                    <th>AWB</th>
                    <th>Ecommerce</th>
                    <th>Ekspedisi</th>
                    <th>Waktu</th>
                    <th>Pencatat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
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
            dom: 'Bfrltip',
            buttons: [
                'copy', {
                    extend: 'excel',
                    title: '',
                    filename: "LOG {{ date('d M Y',strtotime($min)) }} {{ $max == $min ? '' : '- '.date('d M Y',strtotime($max)) }}"
                }, {
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
        $('#btndaterange').attr('href', `/logs/${mindate}/${maxdate
                }`);

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
