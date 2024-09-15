@extends('layout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">HADIAH</h1>
                <div>
                    <a href="{{url('prizes/form?drawing_id=' . $_GET['drawing_id'] ?? '')}}" class="btn btn-primary rounded-pil">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>UNDIAN</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prizes as $prize)
                    <tr>
                        <td>{{$prize->drawing->name ?? ''}}</td>
                        <td>{{$prize->name}}</td>
                        <td>{{$prize->jabatan}}</td>
                        <td>
                            <a href="{{url('drawings/form/' . $prize->id)}}">Edit</a> | 
                            <a href="{{url('drawings/delete/' . $prize->id)}}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

</div>


@endsection