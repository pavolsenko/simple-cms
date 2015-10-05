@extends('layouts/default')

@section('content')

    <section id="page-head-bg">
    </section><!--page-head bg end-->

    <section id="blog-list" class="padding-80">
        <div class="container">
            <div class="section-heading text-center">
                <h4 class="small section-title"><span>Something to read</span></h4>
                <h1 class="large section-title">Welcome to my Blog</h1>
            </div><!--section heading-->
        </div><!--section heading-->

        <div class="container">
            <div class="row">
                <div class="col-sm-9">

                @if(!empty($posts))

                    @foreach($posts as $post)

                    <div class="blog-item-sec">
                        <div class="blog-item-head">
                            <h3>
                                <a href="blog-post.html">
                                    {{ $post['title'] }}
                                </a>
                            </h3>
                        </div><!--blog post item heading end-->
                        <div class="blog-item-post-info">
                            <span><a href="blog-post.html">By Blog Author</a> | posted on {{ $post['created_at'] }} | Tags: <a class="label label-info" href="blog-post.html">Sports</a> | <a href="blog-post.html"> 3 comments</a> |  </span>
                        </div><!--blog post item info end-->
                        <div class="blog-item-post-desc">
                            {{ $post['intro_text'] }}
                        </div><!--blog-item-post-desc end-->
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
                                    <a href="blog-post.html" class="btn btn-theme-color">Read more <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div><!--blog more desc end-->
                    </div>

                    @endforeach

                @else

                    <div class="alert alert-warning">
                        <i class="glyphicon glyphicon-info-sign"></i>&nbsp;
                        @lang('blogPost.no_blog_posts_to_display')
                    </div>

                @endif

                </div>

                <div class="col-sm-3">
                    <div class="sidebar-box">
                        <h4>Categories</h4>
                        <ul class="list-unstyled cat-list">
                            <li><a href="#">Sports <span class="label label-danger">34</span></a></li>
                            <li><a href="#">Marketing <span class="badge bg-info">22</span></a></li>
                            <li><a href="#">Responsive <span class="badge">14</span></a></li>
                            <li><a href="#">Audio <span class="badge">13</span></a></li>
                            <li><a href="#">Business <span class="badge">28</span></a></li>
                        </ul>
                    </div>

                    <div class="sidebar-box">
                        <h4>Latest posts</h4>

                        lorem ipsum dolor sit amet
                    </div>

                    <div class="sidebar-box">
                        <h4>Follow me</h4>
                        <ul class="list-inline social-colored">
                            <li><a href="#"><i class="fa fa-facebook icon-fb" data-toggle="tooltip" title="" data-original-title="Facebook" data-placement="top"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter icon-twit" data-toggle="tooltip" title="" data-original-title="Twitter" data-placement="top"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus icon-plus" data-toggle="tooltip" title="" data-original-title="Google pluse" data-placement="top"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin icon-in" data-toggle="tooltip" title="" data-original-title="Linkedin" data-placement="top"></i></a></li>

                        </ul> <!--colored social-->
                    </div>

                </div>



            </div>
        </div>
    </section>

@stop