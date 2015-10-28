                <div>
                    {!! Form::submit(trans('blog.save'), ['class' => 'btn btn-primary btn-sm']) !!}
                    {!! Form::submit(trans('blog.save_and_close'), ['class' => 'btn btn-default btn-sm']) !!}
                    <a href="{{ URL::route('blogPost', ['id' => $blog_post['id'], 'url' => $blog_post['url']]) }}" class="btn btn-default btn-sm" target="_blank">
                        @lang('blog.preview')
                    </a>
                    <a href="{{ URL::route('postsDashboard') }}" class="btn btn-default btn-sm">
                        @lang('blog.cancel')
                    </a>
                </div>
