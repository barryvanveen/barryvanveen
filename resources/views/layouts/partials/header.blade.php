<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    @if($is_admin)
                        {{ trans('nav.title-admin') }}
                    @else
                        {{ trans('nav.title-public') }}
                    @endif</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if($is_admin)
                    <ul class="nav navbar-nav">
                        @foreach($adminnav as $navitem)
                            <li class="{{ $navitem['classnames'] }}">
                                <a href="{{ $navitem['slug'] }}">{{ $navitem['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <p class="navbar-text navbar-right">
                        {{ trans('nav.signed-in-as') }} {{ $current_user->full_name }}.
                        <a href="{{ route('admin.logout') }}">{{ trans('nav.sign-out') }}</a>.</p>
                @else
                    <ul class="nav navbar-nav">
                        @foreach($mainnav as $navitem)
                            <li class="{{ $navitem['classnames'] }}">
                                <a href="{{ $navitem['slug'] }}">{{ $navitem['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </nav>
</header>
