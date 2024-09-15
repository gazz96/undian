@extends('layout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">FORM USERS</h1>
            </div>
        </div>

        <div class="col-md-4">


            <form action="{{ url("users") }}" method="POST">
                
                <input type="hidden" name="truth_action" value="{{$user->id ? 'update' : 'create'}}">
                <input type="hidden" name="id" value="{{$user->id}}">

                <div class="mb-3">
                    <label for="">NAMA LENGKAP</label>
                    <input name="name" type="text" class="form-control" value="{{old('name', $user->name)}}">
                    @if($error = error('name'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="">USERNAME</label>
                    <input name="username" type="text" class="form-control" value="{{old('username', $user->username)}}">
                    @if($error = error('username'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>

                
                <div class="mb-3">
                    <label for="">PASSWORD</label>
                    <input name="password" type="password" class="form-control">
                    @if($error = error('password'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="">STATUS</label>
                    <select name="status" id="i-status" class="form-control">
                        @foreach(['ON', 'OFF'] as $status)
                        <option value="{{$status}}" {{ ($status == old('status', $user->status)) ? 'selected' : '' }}>{{$status}}</option>
                        @endforeach
                    </select>
                    @if($error = error('status'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>

                <button class="btn btn-primary">SIMPAN</button>

            </form>
        </div>
    </div>

</div>

@endsection