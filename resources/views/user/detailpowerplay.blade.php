@extends('template.user')
@section('css')
    <link href="{{ asset('css/shop-homepage.css')}}" rel="stylesheet" />
@endsection

@section('content_barang')

    <div class="container">

        <div class="row">

        <div class="col-lg-3">

            <h1 class="my-4 container-my-4">Kategori</h1>
            @forelse ($kategori as $kt)
            <div class="list-group">
                <a href="{{ route('user.kategori',['kategori' => $kt->kategoris]) }}" class="list-group-item">{{ $kt->kategoris }}</a>
            </div>
            @empty
                <td colspan="8" class="text-center">Data tidak ada</td>
            @endforelse

        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
            <div class="card my-4 container-my-4">
                <div class="col-lg-7">
                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                            <img class="d-block img-fluid" src="{{ asset($powerplays->gambar) }}" alt="First slide" style="width:400px;height:400px;">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block img-fluid" src="{{ asset($powerplays->gambar1) }}" alt="Second slide" style="width:400px;height:400px;">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block img-fluid" src="{{ asset($powerplays->gambar2) }}" alt="Third slide" style="width:400px;height:400px;">
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
                    <h3 class="card-title">{{ $powerplays->nama_barang }}</h3>
                    <h4>{{ 'Rp '.number_format($powerplays->harga,2,',','.')}}</h4>
                    <p class="card-text">{{ $powerplays->deskripsi }}</p>
                    
                    <br>
                    <br>
                    <a href="{{ route('user.index') }}" class="btn btn-success">Leave a Review</a>
                    <a href="{{ $powerplays->link }}" class="btn btn-info">Beli</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection