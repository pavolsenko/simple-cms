@extends('layouts/admin')

@section('content')
    <div class="row">

    @if(!empty($posts))
        @foreach($posts as $post)

        <div class="">
            {{ $post['title'] }}
            <br>
            {{ $post['intro_text'] }}
        </div>

        @endforeach
    @else

        <div class="col-xs-10 col-xs-offset-1">
            <div class="alert alert-warning">
                <i class="glyphicon glyphicon-info-sign"></i>&nbsp;
                @lang('blogPost.no_blog_posts_to_display')
            </div>
        </div>


    @endif

@stop