@extends('template/layout')
@section('content-title')
    <i class="fa fa-list"></i> Edit Kategori
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('kategori.update',['kategori' => $kategori->id]) }}" method="post" enctype="multipart/form-data">
               @method('PATCH')
                @csrf
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategoris" placeholder="Kategori" class="form-control" value="{{ $kategori->kategoris }}">
                    @error('kategori')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
            </form>
        </div>
    </div>
@endsection