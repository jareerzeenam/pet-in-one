@extends('layouts.ui-master')

@section('content')
<div class="main-banner" style="background-image: url('/images/main-bg.jpg')">
    <div class="container">
        <div class="main-heading">
            <h1>
                Store
            </h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing
                elit. Quidem, nisi consectetur distinctio nesciunt animi
                qui tempore est voluptatibus quam impedit.
            </p>
            <a href="#" class="btn-common">Read More</a>
        </div>
    </div>
</div>
 <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12 pt-3">
        <div class>
          <div class="card card-solid">
            <div class="card-header">
              <h3 class="card-title">Products</h3>
            </div>

            <div class="card-body pb-0">
              <div class="row d-flex align-items-stretch">
               @foreach ($post as $posts)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                  <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                      <h2 class="lead">{{ $posts->title }}</h2>
                      <h2 class="lead">Rs.{{ $posts->price }}</h2>
                      <p class="text-sm"></p>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <p class="text-muted text-sm">
                            <b>Description : {{ $posts->description }}</b>

                          </p>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small">
                              <span class="fa-li">
                                <i class="fas fa-lg fa-building"></i>
                              </span>
                              Location : {{ $posts->location }}
                            </li>
                            <li class="small">
                              <span class="fa-li">
                                <i class="fas fa-lg fa-phone"></i>
                              </span>
                              Phone : <a href="tel:+{{ $posts->phone }}">{{ $posts->phone }}</a>
                              <a
                                href="#"
                              ></a>
                            </li>
                            <li class="small">
                              Posted at : {{ $posts->created_at }}

                            </li>
                          </ul>
                        </div>
                        <div class="col-5 text-center mt-3">
                        <img src="/images/post/{{ $posts->photo }}" alt class="img-circle img-fluid" />
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="text-left">
                      </div>
                      <div class="text-right">
                        <a href="store/{{ $posts->id }}" class="btn btn-sm btn-primary">
                          <i class="fas fa-user"></i>
                          View Post
                        </a>

                      </div>
                    </div>
                  </div>
                </div>

               @endforeach
              </div>

            </div>
            {{-- <div class="card-footer">
              <pagination :data="posts" @pagination-change-page="getResults"></pagination>
            </div> --}}
          </div>
        </div>


      </div>
    </div>
    {{ $post->links() }}
  </div>
@endsection
