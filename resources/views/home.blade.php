@extends('layouts.app')

@section('content')
   <div class="container">
        <div class="row">
          <div class="col-md-12 ">
              <div class="main-content">
                  @foreach ($posts as $post)
                    <h3>
                      <a href="{{url('posts', [$post->_id])}}">{{ $post->title }}</a>
                    </h3>
                    <div className="content">
                      {!! $post->content !!}
                    </div>
                @endforeach
              </div>
            </div>
          </div>
      </div>
@endsection
