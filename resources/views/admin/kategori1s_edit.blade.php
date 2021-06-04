@extends('template/layout')
@section('content-title')
    <i class="fa fa-list"></i> Edit Kategori
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('kategori1.update',['kategori1' => $kategori1->id]) }}" method="post" enctype="multipart/form-data">
               @method('PATCH')
                @csrf
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori1s" placeholder="Kategori" class="form-control" value="{{ $kategori1->kategori1s }}">
                    @error('kategori')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
            </form>
        </div>
    </div>
@endsection