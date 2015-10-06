<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">
                @lang('navigation.toggle_navigation')
            </span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admin/dashboard">
            @lang('navigation.application_name')
        </a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('navigation.blog_posts')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ URL::route('postsDashboard') }}">@lang('navigation.blog_posts_dashboard')</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('postsCreateNew') }}">@lang('navigation.create_new_blog_post')</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">@lang('navigation.blog_categories')</a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@lang('navigation.authors')<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ URL::route('authorsDashboard') }}">@lang('navigation.authors_dashboard')</a>
                    </li>
                    <li>
                        <a href="{{ URL::route('authorsCreateNew') }}">@lang('navigation.create_new_author')</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li>
                <a href="/auth/logout/">
                    <i class="glyphicon glyphicon-log-out"></i>
                    @lang('navigation.logout')
                </a>
            </li>
        </ul>
    </div><!--/.nav-collapse -->
</nav>