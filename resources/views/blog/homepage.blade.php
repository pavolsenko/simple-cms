@extends('layouts/default')

@section('content')

    <section id="page-head-bg">
    </section><!--page-head bg end-->

    <section id="blog-list" class="padding-80">
        <div class="container">
            <div class="section-heading text-center">
                @if(is_null($category_id))
                <h4 class="small section-title"><span>@lang('blogPost.something_to_read')</span></h4>
                <h1 class="large section-title">@lang('blogPost.welcome_to_my_blog')</h1>
                @else
                <h4 class="small section-title"><span>Something to read</span></h4>
                <h1 class="large section-title">Welcome to my Blog</h1>
                @endif
            </div><!--section heading-->
        </div><!--section heading-->

        <div class="container">
            <div class="row">
                <div class="col-sm-9">

                @if(!empty($posts))

                    @foreach($posts as $blog_post)

                    <div class="blog-item-sec">
                        <div class="blog-item-head">
                            <h3>
                                <a href="blog/{{ $blog_post['url'] }}">
                                    {{ $blog_post['title'] }}
                                </a>
                            </h3>
                        </div>

                        @include('partials/blogPostInfo')

                        <div class="blog-item-post-desc">
                            {!! $blog_post['intro_text'] !!}
                        </div>

                        <div class="blog-more-desc">
                            <div class="row">
                                <div class="col-sm-7 col-xs-12">
                                    <ul class="list-inline social-colored">
                                        <li class="empty-text">Share:</li>
                                        <li><a href="#"><i class="fa fa-facebook icon-fb" data-toggle="tooltip" title="" data-original-title="Facebook" data-placement="top"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter icon-twit" data-toggle="tooltip" title="" data-original-title="Twitter" data-placement="top"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus icon-plus" data-toggle="tooltip" title="" data-original-title="Google pluse" data-placement="top"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest icon-pin" data-toggle="tooltip" title="" data-original-title="Linkedin" data-placement="top"></i></a></li>

                                    </ul> <!--colored social-->
                                </div>
                                <div class="col-sm-5 text-right col-xs-12">
                                    <a href="blog/{{ $blog_post['url'] }}" class="btn btn-theme-color">@lang('blogPost.read_more') <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach

                    @include('partials/pagination')
                @else
                    <div class="alert alert-warning">
                        <i class="glyphicon glyphicon-info-sign"></i>&nbsp;
                        @lang('blogPost.no_blog_posts_to_display')
                    </div>
                @endif

                </div>
                <div class="col-sm-3">
                    @include('blog/rightColumn')
                </div>

            </div>
        </div>
    </section>

@stop