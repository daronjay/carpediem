@extends('layouts.app')

@section('content')
   <div class="container">
        <div class="row">
          <div class="col-md-12 ">
              <div class="main-content">
                  @if ($post)
                    <div class="banner-image" style="background-image:url({{ $post->bannerPath }})">
                      <h2>
                        {{ $post->title }}
                      </h2>
                    </div>

                    <div className="content">
                      {!! $post->content !!}
                    </div>
                  @else
                  <h2>Oops, no such posting</h2><p>did you type the URL correctly?</p>
                  @endif
              </div>
            </div>
          </div>
      </div>
@endsection
