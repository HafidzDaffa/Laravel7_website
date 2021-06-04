@extends('template/layout')
@section('content-title', 'Kategori Limcycle')

@section('content')
    <a href="{{ route('kategori1.add') }}" class="btn btn-primary mb-2"><i class="fa fa-pencil-alt"></i> Tambah</a>

    @if(session()->has('pesan'))
    <div class="alert alert-success">
        {{ session()->get('pesan') }}
    </div>
    @endif

    </div>

    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Kategori</th>
                <th><i class="fa fa-cogs"></i></th>
            </tr>
            @forelse ($kategori1 as $kt1)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kt1->kategori1s }}</td>
                    <td>
                        <div class="btn-group">

                        <a href="{{ route('kategori1.edit',['kategori1' => $kt1->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>

                        <form action="{{ route('kategori1.destroy',['kategori1' => $kt1->id]) }}" method="post">
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
@endsection