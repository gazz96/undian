@extends('layout')

@section('content')

<div class="container py-5">

    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h1 class="h3 mb-0">UNDIAN</h1>
                <div>
                    <a href="{{url('drawings/form')}}" class="btn btn-primary rounded-pil">TAMBAH</a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>PARTISIPAN</th>
                        <th width="150">DURASI</th>
                        <th width="250"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drawings as $drawing)
                    <tr>
                        <td>{{$drawing->name}}</td>
                        <td>{{$drawing->participants()->count() ?? 0 }} Orang</td>
                        <td>{{$drawing->duration}} Detik</td>
                        <td>
                            <a href="{{url('drawings/form/' . $drawing->id)}}" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-pencil"></span>
                            </a>
                            <a href="{{url('drawings/delete/' . $drawing->id)}}" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-trash"></span>
                            </a>
                            
                            <a href="{{url('participants?drawing_id=' . $drawing->id)}}" target="_blank" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-people"></span>
                            </a> 
                            
                            <a href="{{url('participants/truncate/' . $drawing->id)}}" class="btn rounded-pill border me-2 mb-2" title="TRUNCATE PARTISIPAN">
                                <span class="bi bi-person-slash"></span>
                            </a> 
                            
                            <a href="{{url('?drawing_id=' . $drawing->id)}}" target="_blank" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-play"></span> 
                            </a>
                            <a href="#modal-partisipan-{{$drawing->id}}" data-bs-toggle="modal" class="btn rounded-pill border me-2 mb-2">
                                <span class="bi bi-file-earmark-excel"></span>
                            </a>
                            {{-- <a href="{{url('prizes?drawing_id=' . $drawing->id)}}" target="_blank">Hadiah</a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

</div>

@foreach($drawings as $drawing)

<!-- MODAL IMPORT PARTICIPANT {{$drawing->name}} -->
<div class="modal fade" id="modal-partisipan-{{$drawing->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">IMPORT PARTISIPAN</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('participants/import/' . $drawing->id) }}" enctype="multipart/form-data">
            <div class="mb-3">
                <label>FILE</label>
                <input type="file" name="file" class="form-control form-custom-file">
            </div>
            
            <button class="btn btn-primary">IMPORT</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach


@endsection