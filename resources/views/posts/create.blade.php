@extends('layouts.main')
@section('content')
<div class="panel-heading"><a href="/posts">Posts</a> > Create Post</div>
    <div class="panel-body">

        {!! Form::open(['action' => 'PostController@store', 'method' => 'Post', 'enctype' => 'multipart/form-data']) !!}
        {{ csrf_field() }}
        <div id="image_viewer">
        <img class="img img-responsive" src="{{asset('/storage/images/default_img.png')}}"/>
        </div>
        <div class="form-group">
        {!! Form::label('image', 'Image', ['class' => '']) !!}
        {!! Form::file('image', ['id' => 'blog_img', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('post_name', 'Post Name', ['class' => '']) !!}
            {!! Form::text('post_name', '', ['class' => 'form-control', 'placeholder' => 'Enter Post Name...', 'required', 'maxlength' => 50]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('post_description', 'Post Description', ['class' => '']) !!}
            {!! Form::textarea('post_description', '', ['class' => 'form-control', 'placeholder' => 'Enter Post Description...', 'required']) !!}
        </div>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
        
    </div>
@endsection