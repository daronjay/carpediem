@extends('layouts.app')

@section('content')
   <div class="container">
        <div class="row">
          <div class="col-md-12 ">
              <div class="main-content admin">
                <div class="title-bar">
                  <h2 class="admin-title">Admin for: {{ config('app.name', 'Carpe Diem') }}</h2>
                  <a href="{{url('posts/create')}}" class="btn btn-success add-new-post">Add New Post</a>
                </div>
                  @foreach ($posts as $post)
                    <div class="post-listing">
                      <div class="post-body">
                        <h3>
                          <a href="{{url('posts/'.$post->_id.'/edit')}}">{{ $post->title }}</a>
                        </h3>
                        <div className="content">
                        {{str_limit(strip_tags($post->content), 100)}}
                        </div>
                      </div>
                        <form method="post" action="{{action('PostController@destroy', $post->_id )}}"> {{method_field('DELETE')}} {{csrf_field()}}
                          <button type="submit" class="btn delete" onclick="return confirm('Are you sure?')"  >X</button>
                      </form>


                    </div>
                @endforeach
              </div>
            </div>
          </div>
      </div>
@endsection
