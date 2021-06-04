@extends('template.user')
@section('css')
    <link href="{{ asset('css/shop-homepage.css')}}" rel="stylesheet" />
@endsection

@section('content_barang')
<div class="container">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-5 container-my-4">Kategori</h1>
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

        <div id="carouselExampleIndicators" class="carousel slide my-5 container-my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="{{ asset('img/noimage.jpg')}}" alt="First slide" style="width:900px;height:400px;">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{ asset('img/noimage.jpg')}}" alt="Second slide" style="width:900px;height:400px;">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="{{ asset('img/noimage.jpg')}}" alt="Third slide" style="width:900px;height:400px;">
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
        <div class="row">
          <div class="col-lg-5">

                  <form action="{{ route('user.search1') }}" method="get">
                      <div class="input-group mb-2">
                          <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                          </div>
                          <input type="search" placeholder="Pencarian" name="search" class="form-control" aria-label="Search" aria-describedby="basic-addon1">
                      </div>
                  </form>
          </div>
        </div> 

        <div class="row">
        @forelse ($limcycles as $lid)

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="{{ route('user.show1',['limcycles' => $lid->kode_barang]) }}">
              <img class="card-img-top" src="{{ asset($lid->gambar) }}" alt="" style="width:232px;height:232px;"></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="{{ route('user.detail1',['limcycles' => $lid->lid]) }}">{{ $lid->nama_barang }}</a>
                </h4>
                <h5>{{ 'Rp '.number_format($lid->harga,2,',','.')}}</h5>
                <p class="card-text">{{ $lid->deskripsi }}</p>
              </div>
              <div class="card-footer">
                    <a href="{{ route('user.detail1',['limcycles' => $lid->lid]) }}" class="btn btn-success"><i class=""></i>Detail</a>
                    <a href="{{ $lid->link }}" class="btn btn-info"><i class=""></i>Beli</a>

              </div>
            </div>
          </div>
            @empty
            <div class="col-lg-12">
                <div class="text-center">
                    <h1>Data tidak ada!</h1>
                </div>
            </div>
        @endforelse


        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
  </div>
<div class="row mt-5">
    <div class="col-lg-12">
        {{ $limcycles->appends(Request::all())->links() }}
    </div>
</div>
@endsection
