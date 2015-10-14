                    <div class="blog-more-desc author">
                        <div class="row">
                            <div class="col-sm-3">
                                <img src="http://lorempixel.com/195/195" class="img-circle img-responsive img-thumbnail">
                            </div>
                            <div class="col-sm-9">
                                <h4>{{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }}</h4>
                                <b>{{ $blog_post['author']['title'] }}</b><br>
                                {{ $blog_post['author']['bio'] }}
                                <br><br>
                                <ul class="list-inline social-colored">
                                    <li><a href="#"><i class="fa fa-facebook icon-fb" data-toggle="tooltip" title="" data-original-title="Facebook" data-placement="top"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter icon-twit" data-toggle="tooltip" title="" data-original-title="Twitter" data-placement="top"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus icon-plus" data-toggle="tooltip" title="" data-original-title="Google pluse" data-placement="top"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
