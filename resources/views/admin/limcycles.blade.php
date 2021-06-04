@extends('template/layout')
@section('content-title', 'Limcycle')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <a href="{{ route('limcycle.add') }}" class="btn btn-primary mb-2"><i class="fa fa-pencil-alt"></i> Tambah</a>
        </div>
        <div class="col-lg-3">

                <form action="{{ route('limcycle.search') }}" method="get">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="search" placeholder="Pencarian" name="search" class="form-control" aria-label="Search" aria-describedby="basic-addon1">
                    </div>
                </form>
        </div>
    </div>    
    @if(session()->has('pesan'))
    <div class="alert alert-success">
        {{ session()->get('pesan') }}
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Link</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
            @forelse ($limcycles as $ld)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ld->kode_barang }}</td>
                <td>{{ $ld->nama_barang }}</td>
                <td>{{ $ld->kategori1s}}</td>
                <td>{{ $ld->harga}}</td>
                <td>{{ $ld->link}}</td>
                <td>{{ $ld->deskripsi}}</td>
                <td><img src="{{ asset($ld->gambar) }}" class="img-thumbnail" width="100px"></td>
                <td>
                    <div class="btn-group">

                        <a href="{{ route('limcycle.edit',['limcycles' => $ld->lid]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                        <form action="{{ route('limcycle.destroy',['limcycles' => $ld->lid]) }}" method="post">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
                <td colspan="8" class="text-center">Data tidak ada</td>
            @endforelse
        </table>
    </div>
    
    {{ $limcycles->appends(Request::all())->links() }}
@endsection
