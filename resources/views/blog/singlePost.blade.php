@extends('layouts/default')

@section('content')

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="blog-item-sec">

                    <div class="blog-item-head">
                        <h3>{{ $blog_post['title'] }}</h3>
                    </div>

                    <div class="blog-item-post-info">
                        <span>By {{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }}| Posted on {{ $blog_post['created_at'] }} | 3 comments </span>
                    </div>

                    <div class="blog-item-post-desc">
                        {!! $blog_post['intro_text'] !!}
                    </div>

                    <br>
                    <div class="blog-item-post-desc">
                        {!! $blog_post['body_text'] !!}
                    </div>

                    <div class="blog-more-desc">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12">
                                <ul class="list-inline social-colored">
                                    <li class="empty-text">Share:</li>
                                    <li><a href="#"><i class="fa fa-facebook icon-fb" data-toggle="tooltip" title="" data-original-title="Facebook" data-placement="top"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter icon-twit" data-toggle="tooltip" title="" data-original-title="Twitter" data-placement="top"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus icon-plus" data-toggle="tooltip" title="" data-original-title="Google pluse" data-placement="top"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest icon-pin" data-toggle="tooltip" title="" data-original-title="Linkedin" data-placement="top"></i></a></li>

                                </ul> <!--colored social-->
                            </div>
                            <div class="col-sm-6 col-xs-12 more-link">
                                <a href="#">Next Post&gt;&gt;</a>
                            </div>

                        </div>
                    </div>


                    @include('partials/comments')

                </div>
            </div>

            <div class="col-sm-3">
                @include('blog/rightColumn')
            </div>

        </div>
    </div>
@stop