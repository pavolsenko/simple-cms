@extends('layouts/admin')

@section('content')
    <div class="row">

        <div class="col-xs-10 col-xs-offset-1">

        <h1>@lang('blogPost.blog_post_dashboard_heading')</h1>

        <a href="{{ URL::route('getCreateBlogPost') }}" class="btn btn-primary">@lang('blogPost.create_new')</a>

        @include('partials.pagination')

        @if(!empty($posts))

            <table class="table table-striped table-condensed table-responsive table-hover">
                <thead>
                <tr>
                    <th>@lang('blogPost.id')</th>
                    <th>&nbsp;</th>
                    <th>@lang('blogPost.published')</th>
                    <th style="min-width:200px">
                        <i class="glyphicon glyphicon-triangle-top"></i> @lang('blogPost.created_at')<br>
                        <i class="glyphicon glyphicon-triangle-top"></i> @lang('blogPost.last_updated_at')
                    </th>
                    <th>@lang('blogPost.action')</th>
                </tr>
                </thead>

            @foreach($posts as $post)

                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>
                        <a href="{{ URL::route('getUpdateBlogPost', $post['id']) }}"><b>{{ $post['title'] }}</b></a><br>
                        {{ $post['intro_text'] }}
                    </td>
                    <td class="text-center">
                        @if($post['enabled'])
                        <i class="glyphicon glyphicon-ok"></i>
                        @else
                        <i class="glyphicon glyphicon-remove"></i>
                        @endif
                    </td>
                    <td>
                        <i class="glyphicon glyphicon-triangle-top"></i> {{ $post['created_at'] }}<br>
                        <i class="glyphicon glyphicon-triangle-top"></i> {{ $post['updated_at'] }}</td>
                    <td>@include('admin/blogPosts/action')</td>
                </tr>

            @endforeach

            </table>
        @else

            <div class="alert alert-warning">
                <i class="glyphicon glyphicon-info-sign"></i>&nbsp;
                @lang('blogPost.no_blog_posts_to_display')
            </div>

            @endif

            <a href="{{ URL::route('getCreateBlogPost') }}" class="btn btn-primary">@lang('blogPost.create_new')</a>

            @include('partials.pagination')

        </div>
    </div>

@stop