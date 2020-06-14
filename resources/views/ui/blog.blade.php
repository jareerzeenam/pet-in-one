@extends('layouts.ui-master')

@section('content')
<div class="main-banner" style="background-image: url('/images/main-bg4.jpg')">
    <div class="container">
        <div class="main-heading">
            <h1>
                Blog Articles
            </h1>
            <p>
               Read and learn more about your favourite pet before owning one.
            </p>
            <a href="#articles" class="btn-common">Show Articles</a>
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
              <div id="articles" class="row d-flex align-items-stretch">
               @foreach ($blog as $blogs)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                  <div class="card bg-light">
                    <div class="card-header text-muted border-bottom-0">
                      <h2 class=""><b>{{ $blogs->title }}</b></h2>
                      <h2 class="lead" style="text-transform: capitalize;">{{ $blogs->category }}</h2>


                      <p class="text-sm"></p>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-7">
                          <p class="text-muted text-sm pt-4">
                            {{-- <b>Description : {{ $blogs->description }}</b> --}}
                            <b>Description :   {{ Illuminate\Support\Str::limit($blogs->description, 45, $end='...') }}</b>
                          </p>
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            {{-- <li class="small">
                              <span class="fa-li">
                                <i class="fas fa-lg fa-building"></i>
                              </span>
                              Location : {{ $blogs->location }}
                            </li>
                            <li class="small">
                              <span class="fa-li">
                                <i class="fas fa-lg fa-phone"></i>
                              </span>
                              Phone : <a href="tel:+{{ $blogs->phone }}">{{ $blogs->phone }}</a>
                              <a
                                href="#"
                              ></a>
                            </li> --}}
                            <li class="small">


                            </li>
                          </ul>
                        </div>
                        <div class="col-5 text-center mt-3">
                            <img src="/images/blog/{{ $blogs->photo }}" alt class="img-circle img-fluid" />
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="text-left">
                                {{ $blogs->created_at }}
                      </div>
                      <div class="text-right">
                        <a href="blog/{{ $blogs->id }}" class="btn btn-sm btn-primary">
                          <i class="fas fa-user"></i>
                          View Article
                        </a>

                      </div>
                    </div>
                  </div>
                </div>

               @endforeach
              </div>

            </div>
            {{-- <div class="card-footer">
              <pagination :data="blogs" @pagination-change-page="getResults"></pagination>
            </div> --}}
          </div>
        </div>


      </div>
    </div>
    {{ $blog->links() }}
  </div>
@endsection
