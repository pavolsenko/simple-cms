                    <div class="blog-item-post-info">
                        <span>@lang('blogPost.posted_by') {{ $blog_post['author']['first_name'] }} {{ $blog_post['author']['last_name'] }} |
                            @lang('blogPost.posted_on') {{ date('j M Y', strtotime($blog_post['created_at'])) }} |
                            @if(!empty($blog_post['comments']))
                                @if(count($blog_post['comments']) === 1)
                                    1 @lang('comment.comment')
                                @else
                                    {{ count($blog_post['comments']) }} @lang('comment.comments')
                                @endif
                            @else
                                0 @lang('comment.comments')
                            @endif
                        </span>
                    </div>