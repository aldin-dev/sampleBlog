@extends('layouts.main')
@section('content')
    <div class="panel-heading"><a href="/home">Home</a> | My Posts</div>
    <div class="panel-body">
        <a class="btn btn-primary" href="/posts/create"><span class="glyphicon glyphicon-plus-sign"></span> Create Post</a>
        <hr/>
        <div>
            @if(count($posts) < 1)
                <p>No post found plese create one...</p>
            @else
                @foreach($posts as $post)
                <div style="padding:10px;margin-bottom:20px;">
                    <div class="clearfix">
                        <div class="pull-left"><h3><b>{{$post->user->name}}</b></h3></div>
                        <div class="pull-right">
                            @if(Auth::id() == $post->user->id)
                            <div class="clearfix">
                            
                            {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST']) !!}
                            {{ csrf_field() }}

                                <span class="pull-right"><button onclick="return confirm('Are you sure?')" type="submit" title="Delete" class="btn btn-link"><span class="glyphicon glyphicon-trash"></span></button></span>
                            
                            {!! Form::hidden('_method', 'DELETE') !!}
                            
                            {!! Form::close() !!}
                            
                                <span class="pull-right"><a class="btn btn-link" title="Edit" href="/posts/{{$post->id}}/edit"><span class="glyphicon glyphicon-pencil"></span></a></span>
                        </div>
                        @endif
                        <p>Posted on : {{\Carbon\Carbon::parse($post->created_At)->format('d/m/Y - h:i:a')}}</p>
                    </div>
                </div>
                    <h4>{{$post->post_name}}</h4>
                    <p>{{$post->post_description}}</p>
                    <img class="img img-responsive" src="/storage/images/{{$post->image}}"/>
                </div>
                <hr/>
                @endforeach
            @endif
        </div>
    </div>
@endsection