@extends('layouts.app')

@section('content')
   <div class="container">
        <div class="row">
          <div class="col-md-12 ">
              <div class="main-content admin">
                  @if ($post)
                   <h2>Edit Post: {{ $post->_id }}</h2>
                  @if ($post->_id == "new")
                    <form method="post" action="{{action('PostController@store')}}">
                  @else
                    <form method="post" action="{{action('PostController@update', $post->_id )}}">
                   @endif{{csrf_field()}}
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="form-group col-md-8">
                        <label for="name">Title:</label>
                        <input type="text" class="form-control" name="title" value="{{isset($post->title)? $post->title : ""}}">
                      </div>
                    </div>
                      <div class="row">
                      <div class="col-md-2"></div>
                      <div class="form-group col-md-8">
                        <label for="price">Image:</label>
                        <input type="text" class="form-control" name="title" value="{{isset($post->bannerPath)? $post->bannerPath : ""}}">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="form-group col-md-8">
                        <label for="price">Content:</label>
                        <textarea class="form-control" name="content">{{isset($post->content) ? $post->content : ""}}</textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-2"></div>
                      <div class="form-group col-md-8">
                        <button type="submit" class="btn btn-success">Save Post</button>
                      </div>
                    </div>
                  </form>

                  @else
                  <h2>Oops, no such posting</h2><p>did you type the URL correctly?</p>
                  @endif
              </div>
            </div>
          </div>
      </div>
@endsection
