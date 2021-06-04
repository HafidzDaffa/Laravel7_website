@extends('template.layout')
@section('content-title')
<i class="fa fa-list"></i> Tambah Kategori
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('kategori.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategoris" placeholder="Kategori" class="form-control">
                    @error('kategori')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>


                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Tambah</button>
            </form>
        </div>
    </div>
@endsection