@extends('layouts.app')

@section('content')
   <div class="container">
        <div class="row">
          <div class="col-md-12 ">
              <div class="main-content">
                  @foreach ($posts as $post)
                    <h3>
                      <a href="{{url('/', [$post->_id])}}">{{ $post->title }}</a>
                    </h3>
                    <div className="content">
                      {{str_limit(strip_tags($post->content), 100)}}
                    </div>
                @endforeach
              </div>
            </div>
          </div>
      </div>
@endsection
