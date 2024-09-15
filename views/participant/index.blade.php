@extends('layout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">PARTISIPAN</h1>
                <div>
                    
                    <a href="{{url('participants/form?drawing_id=' . $_GET['drawing_id'] ?? '')}}" class="btn btn-primary rounded-pill">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UNDIAN</th>
                        <th>NIPP</th>
                        <th>NAMA</th>
                        <th>SUBAREA</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($participants as $participant)
                    <tr>
                        <td>{{$participant->drawing->name ?? ''}}</td>
                        <td>{{$participant->nipp}}</td>
                        <td>{{$participant->name}}</td>
                        <td>{{$participant->subarea}}</td>
                        <td>
                            <a href="{{url('participants/form/' . $participant->id)}}">Edit</a> | 
                            <a href="{{url('participants/delete/' . $participant->id)}}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

</div>


@endsection