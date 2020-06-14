@extends('layouts.ui-master')

@section('content')


 <div class="">
    <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ url('images/blog/') }}/{{ $blog->photo }}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ url('images/blog/') }}/{{ $blog->photo }}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                        <img class="d-block w-100" src="{{ url('images/blog/') }}/{{ $blog->photo }}" alt="Third slide">
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
            <div class="col-12 col-sm-6">
              <h3 class="my-3">{{ $blog->title }}</h3>
              <p><strong>Description</strong></p>
              <p>{{ $blog->description }}</p>


              {{-- <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                  Rs. {{ $blog->price }}
                </h2>
              </div> --}}

              {{-- <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Add to Cart
                </div>

                <div class="btn btn-default btn-lg btn-flat">
                  <i class="fas fa-heart fa-lg mr-2"></i>
                  Add to Wishlist
                </div>
              </div> --}}

              <div class="mt-4 product-share">
                {{-- <a href=" tel:{{ $blog->phone }}" class="text-gray">
                  <i class="fas fa-phone"></i>
                  {{ $blog->phone }}
                </a> --}}
                <br>

              </div>

              <div class="col-12">

                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                          {{-- <tr>
                        <th style="width:50%">Phone</th>
                        <td>
                            <a href=" tel:{{ $blog->phone }}" class="text-gray">
                                <i class="fas fa-phone"></i>
                                {{ $blog->phone }}
                            </a>
                        </td>
                      </tr> --}}
                      {{-- <tr>
                        <th>Location </th>
                        <td>
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $blog->location }}
                        </td>
                      </tr> --}}
                      <tr>
                        <th>Created at :</th>
                        <td>
                            {{ $blog->created_at }}
                        </td>
                      </tr>
                      {{-- <tr>
                        <th>Meetable Date | Time</th>
                        <td>{{ $blog->meeting_date_start }}  {{ $blog->meeting_time }}</td>
                      </tr> --}}
                    </tbody></table>
                  </div>
                </div>

            </div>
          </div>

        </div>
        <!-- /.card-body -->
      </div>

  </div>

@endsection
