@extends('layouts.index')

@section('content')
<div class="container vh-100 mt-5">
    <div class="pt-5">
        <table id="table" class="table table-striped table-bordered table-hover border display nowrap">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->username }}</td>
                    <td><a href="{{ route('admin.show',$user->username) }}" class="btn btn-warning">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
