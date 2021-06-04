@extends('template/layout')
@section('content-title')
<i class="fa fa-briefcase"></i> Edit Barang
    
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form action="{{ route('powerplay.update',['powerplays' => $powerplays->id]) }}" method="post" enctype="multipart/form-data">
               @method('PATCH')
               @csrf
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" value="{{$powerplays->nama_barang}}">
                    @error('nama_barang')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategoris" class="form-control">
                        <option value=""></option>
                        @foreach ($kategori as $kt)
                        <option value="{{ $kt->id }}" {{ ($kt->id == $powerplays->kategori_id) ? "selected" : "" }}>{{ $kt->kategoris }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="harga" placeholder="Harga" class="form-control" value="{{$powerplays-> harga}}">
                    @error('harga')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Link Pembelian</label>
                    <input type="text" name="link" placeholder="link" class="form-control" value="{{$powerplays-> link}}">
                    @error('link')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" id="ckeditor" class="form-control">{{$powerplays->deskripsi}}</textarea>
                    @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Gambar 1</label>
                    <br>
                    <img id="img-preview" src="{{ asset($powerplays->gambar) }}" width="100px" class="img-thumbnail mb-2" alt="">
                    <input type="file" class="form-control" id="form-file" name="gambar">
                    @error('gambar')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Gambar 2</label>
                    <br>
                    <img id="img-preview" src="{{ asset($powerplays->gambar1) }}" width="100px" class="img-thumbnail mb-2" alt="">
                    <input type="file" class="form-control" id="form-file" name="gambar1">
                    @error('gambar1')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Gambar 3</label>
                    <br>
                    <img id="img-preview" src="{{ asset($powerplays->gambar2) }}" width="100px" class="img-thumbnail mb-2" alt="">
                    <input type="file" class="form-control" id="form-file" name="gambar2">
                    @error('gambar2')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Edit</button>
            </form>
        </div>
    </div>
@endsection
