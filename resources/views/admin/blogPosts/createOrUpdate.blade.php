@extends('layouts/admin')

@section('content')

    <div class="col-sm-10 col-sm-offset-1">
        <h1>
            @lang('blog.blog_post_editor')
        </h1>
    </div>

    <div class="col-sm-8 col-sm-offset-1">
        @if(isset($blog_post))
            {!! Form::model($blog_post, ['route' => ['postUpdateBlogPost', $blog_post['id']]]) !!}
            {!! Form::hidden('id', $blog_post['id']) !!}
        @else
            {!! Form::open(['route' => 'postCreateBlogPost']) !!}
        @endif

        @if(session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="pull-right">
                    @if(isset($blog_post))
                        @lang('blog.id'): {{ $blog_post['id'] }} |
                        @lang('blog.created_at'): {{ $blog_post['created_at'] }} |
                        @lang('blog.last_updated_at'): {{ $blog_post['updated_at'] }}
                    @endif
                </div>
                @include('admin/blogPosts/toolbar')
            </div>

            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('title', trans('blog.title')) !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('intro_text', trans('blog.intro_text')) !!}
                    {!! Form::textarea('intro_text', null, ['class' => 'form-control editable']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('body_text', trans('blog.body_text')) !!}
                    {!! Form::textarea('body_text', null, ['class' => 'form-control editable']) !!}
                </div>
            </div>

            <div class="panel-footer">
                @include('admin/blogPosts/toolbar')
            </div>

        </div>

        <h4>@lang('comment.comments')</h4>

    </div>

    <div class="col-sm-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blog.settings')</b>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-default">@lang('blog.published')</a>
                        <a href="#" class="btn btn-default">@lang('blog.draft')</a>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('author', trans('blog.author')) !!}
                    {!! Form::select('author', $authors, isset($blog_post) ? $blog_post['author_id'] : null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('categories', trans('blog.category')) !!}
                    {!! Form::select('categories[]', $categories, $selected_categories, ['class' => 'form-control', 'multiple' => true, 'id' => 'category-multiselect']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit(trans('blog.save'), ['class' => 'btn btn-primary btn-sm']) !!}
                    <a href="#" class="btn btn-default btn-sm">@lang('blog.manage_authors')</a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blog.images')</b>
            </div>
            <div class="panel-body">
                @lang('blog.featured_image')
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <b>@lang('blog.seo_settings')</b>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    {!! Form::label('url', trans('blog.url')) !!}
                    {!! Form::text('url', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meta_title', trans('blog.meta_title')) !!}
                    {!! Form::text('meta_title', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meta_description', trans('blog.meta_description')) !!}
                    {!! Form::textarea('meta_description', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('meta_keywords', trans('blog.meta_keywords')) !!}
                    {!! Form::textarea('meta_keywords', null, ['class' => 'form-control']) !!}
                </div>

            </div>
        </div>
    </div>

    {!! Form::close() !!}

@stop