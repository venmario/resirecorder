@extends('layouts.index')

@section('content')
<div class="container">
    <div class="mt-5">
        <table id="table" class="table table-striped table-bordered table-hover border">
            <thead>
                <tr>
                    <th>Merchant</th>
                    <th>AWB</th>
                    <th>Ecommerce</th>
                    <th>Ekspedisi</th>
                    <th>Waktu</th>
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
        $('#table').DataTable();
    });

    $("#table").table2excel({
        filename: "excel_sheet-name.xls"
    });

</script>
@endsection
