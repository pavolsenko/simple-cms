@extends('layouts/admin')

@section('content')
    <div class="row">

        <div class="col-xs-10 col-xs-offset-1">

        @if(!empty($posts))

            <table class="table table-striped table-condensed table-responsive table-hover">
                <thead>
                <tr>
                    <th>@lang('blogPost.id')</th>
                    <th>&nbsp;</th>
                    <th>Enabled</th>
                    <th style="min-width:200px">@lang('blogPost.created_at')</th>
                    <th style="min-width:200px">@lang('blogPost.last_updated_at')</th>
                    <th>@lang('blogPost.action')</th>
                </tr>
                </thead>

            @foreach($posts as $post)

                <tr>
                    <td>{{ $post['id'] }}</td>
                    <td>
                        <b>{{ $post['title'] }}</b><br>
                        {{ $post['intro_text'] }}
                    </td>
                    <td class="text-center">
                        @if($post['enabled'])
                        <i class="glyphicon glyphicon-ok"></i>
                        @else
                        <i class="glyphicon glyphicon-remove"></i>
                        @endif
                    </td>
                    <td>{{ $post['created_at'] }}</td>
                    <td>{{ $post['updated_at'] }}</td>
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

        </div>
    </div>

@stop