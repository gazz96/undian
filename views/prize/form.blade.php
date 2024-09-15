@extends('layout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">FORM PARTISIPAN</h1>
            </div>
        </div>

        <div class="col-md-4">


            <form action="{{ url("participants") }}" method="POST">
                
                <input type="hidden" name="truth_action" value="{{$participant->id ? 'update' : 'create'}}">
                <input type="hidden" name="id" value="{{$participant->id}}">
                
                <div class="mb-3">
                    <label for="">UNDIAN</label>
                    <select name="drawing_id" id="i-drawing_id" class="form-control">
                        <option value="">PILIH UNDIAN</option>
                        @foreach($drawings as $drawing)
                        <option value="{{$drawing->id}}" {{ ($drawing->id == old('drawing_id', $_GET['drawing_id'] ?? $participant->drawing_id)) ? 'selected' : '' }}>{{$drawing->name}}</option>
                        @endforeach
                    </select>
                    @if($error = error('drawing_id'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div> 

                <div class="mb-3">
                    <label for="">NAMA</label>
                    <input name="name" type="text" class="form-control" value="{{old('name', $participant->name)}}">
                    @if($error = error('name'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="">JABATAN</label>
                    <input name="jabatan" type="text" class="form-control" value="{{old('jabatan', $participant->jabatan)}}">
                    @if($error = error('jabatan'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>

            
                {{-- <div class="mb-3">
                    <label for="">STATUS</label>
                    <select name="status" id="i-status" class="form-control">
                        @foreach(['ON', 'OFF'] as $status)
                        <option value="{{$status}}" {{ ($status == old('status', $participant->status)) ? 'selected' : '' }}>{{$status}}</option>
                        @endforeach
                    </select>
                    @if($error = error('status'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div> --}}

                <button class="btn btn-primary">SIMPAN</button>

            </form>
        </div>
    </div>

</div>

@endsection