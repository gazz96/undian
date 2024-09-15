@extends('layout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">FORM UNDIAN</h1>
            </div>
        </div>

        <div class="col-md-4">


            <form action="{{ url("drawings") }}" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="truth_action" value="{{$drawing->id ? 'update' : 'create'}}">
                <input type="hidden" name="id" value="{{$drawing->id}}">

                <div class="mb-3">
                    <label for="">NAMA</label>
                    <input name="name" type="text" class="form-control" value="{{old('name', $drawing->name)}}">
                    @if($error = error('name'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="">DURASI (DETIK)</label>
                    <input name="duration" type="text" class="form-control" value="{{old('duration', $drawing->duration)}}">
                    @if($error = error('duration'))
                    <div class="d-block invalid-feedback">{{$error}}</div>
                    @endif
                </div>
                
                <div class="mb-3">
                    <label>BACKGROUND</label>
                    <input name="file" type="file" class="form-control">
                    
                    @if($drawing->background)
                    <div class="">
                        <img src="{{url($drawing->background)}}" class="w-100"/>
                    </div>
                    @endif
                </div>

            
                {{-- <div class="mb-3">
                    <label for="">STATUS</label>
                    <select name="status" id="i-status" class="form-control">
                        @foreach(['ON', 'OFF'] as $status)
                        <option value="{{$status}}" {{ ($status == old('status', $drawing->status)) ? 'selected' : '' }}>{{$status}}</option>
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