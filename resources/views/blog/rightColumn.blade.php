            <div class="sidebar-box">
                <h4>Categories</h4>
                @if(empty($categories))

                <div class="alert alert-warning">
                    @lang('blog.no_categories_found')
                </div>

                @else

                <ul class="list-unstyled cat-list">
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ URL::route('blogCategory', ['id' => $category['id'], 'url' => $category['url']]) }}">{{ $category['title'] }}
                            <span class="label label-danger pull-right">{{ $category['posts'] }}</span></a>
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="sidebar-box">
                <h4>@lang('blog.latest_posts')</h4>

                @if(empty($latest_posts))

                    <div class="alert alert-warning">
                        @lang('blog.no_recent_posts_found')
                    </div>
                @else

                    <ul class="list-unstyled cat-list">
                        @foreach($latest_posts as $blog_post)
                            <li>
                                <a href="{{ URL::route('blogPost', ['id' => $blog_post['id'], 'url' => $blog_post['url']]) }}">{{ $blog_post['title'] }}</a>
                                @lang('blog.posted_by') {{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }}<br>
                                @lang('blog.posted_on') {{ date('j M Y', strtotime($blog_post['created_at'])) }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="sidebar-box">
                <h4>@lang('blog.follow_me')</h4>
                <ul class="list-inline social-colored">
                    <li><a href="#"><i class="fa fa-facebook icon-fb" data-toggle="tooltip" title="" data-original-title="Facebook" data-placement="top"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter icon-twit" data-toggle="tooltip" title="" data-original-title="Twitter" data-placement="top"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus icon-plus" data-toggle="tooltip" title="" data-original-title="Google pluse" data-placement="top"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin icon-in" data-toggle="tooltip" title="" data-original-title="Linkedin" data-placement="top"></i></a></li>

                </ul>
            </div>

