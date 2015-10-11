@extends('layouts/admin')

@section('content')

    <div class="col-sm-10 col-sm-offset-1">
        <h1>
            @lang('blogPost.blog_post_editor')
        </h1>
    </div>

    <div class="col-sm-8 col-sm-offset-1">
        @if(isset($blog_post['id']))
            {!! Form::model($blog_post, ['route' => ['postUpdateBlogPost', $blog_post['id']]]) !!}
            {!! Form::hidden('id', $blog_post['id']) !!}
        @else
            {!! Form::open(['route' => 'postCreateBlogPost']) !!}
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                {{$errors->first()}}
            </div>
        @endif

        @if(isset($message))
            <div class="alert alert-warning">
                {{ $message }}
            </div>
        @endif

        <div class="form-group">
            {!! Form::submit(trans('blogPost.save'), ['class' => 'btn btn-primary']) !!}
            &nbsp;
            <a href="{{ URL::route('postsDashboard') }}" class="btn btn-default">
                @lang('blogPost.cancel')
            </a>
        </div>

        <div class="form-group">
            {!! Form::label('title', trans('blogPost.title')) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('intro_text', trans('blogPost.intro_text')) !!}
            {!! Form::textarea('intro_text', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body_text', trans('blogPost.body_text')) !!}
            {!! Form::textarea('body_text', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit(trans('blogPost.save'), ['class' => 'btn btn-primary']) !!}
            &nbsp;
            <a href="{{ URL::route('postsDashboard') }}" class="btn btn-default">
                @lang('blogPost.cancel')
            </a>
        </div>

        {!! Form::close() !!}

    </div>

    <div class="col-sm-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blogPost.settings')</b>
            </div>
            <div class="panel-body">
                lorem ipsum
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blogPost.featured_image')</b>
            </div>
            <div class="panel-body">
                lorem ipsum
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blogPost.seo_settings')</b>
            </div>
            <div class="panel-body">
                nice URL<br>
                meta title<br>
                meta description<br>
                meta keywords<br>
            </div>
        </div>
    </div>

@stop