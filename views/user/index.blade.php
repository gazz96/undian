@extends('layout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">USERS</h1>
                <div>
                    <a href="{{url('users/form')}}" class="btn btn-primary rounded-pil">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>USERNAME</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->status}}</td>
                        <td>
                            <a href="{{url('users/form/' . $user->id)}}">Edit</a> | 
                            <a href="{{url('users/delete/' . $user->id)}}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

</div>

@endsection