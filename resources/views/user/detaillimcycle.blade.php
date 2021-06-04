<!-- memanggil template user  -->
@extends('template.user')
@section('css')
    <link href="{{ asset('css/shop-homepage.css')}}" rel="stylesheet" />
@endsection

@section('content_barang')

    <div class="container">
    <!-- kategori routing dan tampilan -->
        <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4 container-my-4">Kategori</h1>
            @forelse ($kategori1 as $kt1)
            <div class="list-group">
                <a href="{{ route('user.kategori1',['kategori1' => $kt1->kategori1s]) }}" class="list-group-item">{{ $kt1->kategori1s }}</a>
            </div>
            @empty
                <td colspan="8" class="text-center">Data tidak ada</td>
            @endforelse

        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
        <!-- gambar bergerak menampilkan gambar barang yang dijual  -->
            <div class="card my-4 container-my-4">
                <div class="col-lg-7">
                    <div id="carouselExampleIndicators" class="carousel slide my-4 " data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                            <img class="d-block img-fluid" src="{{ asset($limcycles->gambar) }}" alt="First slide" style="width:400px;height:400px;">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block img-fluid" src="{{ asset($limcycles->gambar1) }}" alt="Second slide" style="width:400px;height:400px;">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block img-fluid" src="{{ asset($limcycles->gambar2) }}" alt="Third slide" style="width:400px;height:400px;">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                <!-- menampilkan nama barang harga dan deskripsi barang  -->
                    <h3 class="card-title">{{ $limcycles->nama_barang }}</h3>
                    <h4>{{ 'Rp '.number_format($limcycles->harga,2,',','.')}}</h4>
                    <p class="card-text">{{ $limcycles->deskripsi }}</p>
                    
                    <br>
                    <br>
                    <!-- untuk keluar tampilan detail -->
                    <a href="{{ route('user.index1') }}" class="btn btn-success">Leave a Review</a>
                    <!-- untuk membeli barang yang di arahkan ke website bukalapak -->
                    <a href="{{ $limcycles->link }}" class="btn btn-info">Beli</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection