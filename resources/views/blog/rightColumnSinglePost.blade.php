
            <div class="sidebar-box">
                <h4>@lang('blogPost.related_posts')</h4>

                @if(empty($blog_post['related']))

                <div class="alert alert-warning">
                    @lang('blogPost.no_more_posts')
                </div>

                @else

                    lorem ipsum dolor sit amet
                @endif
            </div>
