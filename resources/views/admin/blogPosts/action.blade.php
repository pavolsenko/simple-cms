<div class="btn-group">
    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
        <li><a href="{{ URL::route('getUpdateBlogPost', $blog_post['id']) }}">@lang('blogPost.edit')</a></li>
        @if($blog_post['enabled'])
            <li><a href="#">@lang('blogPost.unpublish')</a></li>
        @else
            <li><a href="#">@lang('blogPost.publish')</a></li>
        @endif
        <li role="separator" class="divider"></li>
        <li><a href="{{ URL::route('getDeleteBlogPost', $blog_post['id']) }}">@lang('blogPost.delete')</a></li>
    </ul>
</div>
