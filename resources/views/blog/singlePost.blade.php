@extends('layouts/default')

@section('content')

    <br><br>
    <div class="container">
        <div class="blog-item-sec">

            <div class="blog-item-head">
                <h3>{{ $blog_post['title'] }}</h3>
            </div>

            <div class="blog-item-post-info">
                <span>By Blog Author</a> | on 1 june 2014 | Sports | 3 comments |  </span>
            </div>

        <div class="blog-item-post-desc">
                {{ $blog_post['intro_text'] }}
        </div><!--blog-item-post-desc end-->
        <br>
        <div class="blog-item-post-desc">
            {{ $blog_post['body_text'] }}
        </div><!--blog-item-post-desc end-->
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
        </div><!--blog more desc end-->

        <!--blog -post comment wrapper start-->
        <div class="comment-wrapper">
            <h4>5 Comments</h4>
            <div class="comment-box">
                <div class="comment-list">
                    <img src="img/team-1.jpg" class="img-responsive" alt="">
                    <h5><a href="#">Melinda</a> On 7 june | <a href="#">Reply</a></h5>
                    <p>
                        Magnis modipsae que lib voloratati andigen daepeditem quiate ut repore autem labor. Laceaque quiae sitiorem rest non restibusaes es tumquam core posae volor remped modis volor.
                    </p>
                </div><!--comment list end-->
                <div class="comment-list">
                    <img src="img/team-2.jpg" class="img-responsive" alt="">
                    <h5><a href="#">james</a> On 7 june | <a href="#">Reply</a></h5>
                    <p>
                        Magnis modipsae que lib voloratati andigen daepeditem quiate ut repore autem labor. Laceaque quiae sitiorem rest non restibusaes es tumquam core posae volor remped modis volor.
                    </p>
                </div><!--comment list end-->
                <div class="comment-list">
                    <img src="img/team-1.jpg" class="img-responsive" alt="">
                    <h5><a href="#">Melinda</a> On 7 june | <a href="#">Reply</a></h5>
                    <p>
                        Magnis modipsae que lib voloratati andigen daepeditem quiate ut repore autem labor. Laceaque quiae sitiorem rest non restibusaes es tumquam core posae volor remped modis volor.
                    </p>
                </div><!--comment list end-->
                <div class="comment-list">
                    <img src="img/team-3.jpg" class="img-responsive" alt="">
                    <h5><a href="#">Sharmaji</a> On 7 june | <a href="#">Reply</a></h5>
                    <p>
                        Magnis modipsae que lib voloratati andigen daepeditem quiate ut repore autem labor. Laceaque quiae sitiorem rest non restibusaes es tumquam core posae volor remped modis volor.
                    </p>
                </div><!--comment list end-->
                <div class="comment-list">
                    <img src="img/team-2.jpg" class="img-responsive" alt="">
                    <h5><a href="#">John</a> On 7 june | <a href="#">Reply</a></h5>
                    <p>
                        Magnis modipsae que lib voloratati andigen daepeditem quiate ut repore autem labor. Laceaque quiae sitiorem rest non restibusaes es tumquam core posae volor remped modis volor.
                    </p>
                </div><!--comment list end-->
            </div>
            <div class="comment-form">
                <h4>Leave a Comment</h4>
                <form class="wow animated fadeInUp" style="visibility: hidden; animation-name: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Name" id="name">
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" placeholder="Email" id="password">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Subject" id="subject">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Company" id="company">
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" placeholder="Your Comment" rows="7"></textarea>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-lg btn-theme-color">Send Comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!--blog post comment wrapper end-->
    </div>
    </div>
@stop