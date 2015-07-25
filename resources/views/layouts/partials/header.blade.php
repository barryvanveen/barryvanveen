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
                        Beheeromgeving
                    @else
                        Barry van Veen
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
                    <p class="navbar-text navbar-right">Ingelogd als {{ $current_user->full_name }}. <a href="{{ route('admin.logout') }}">Uitloggen</a>.</p>
                @else
                    <ul class="nav navbar-nav">
                        @foreach($mainnav as $navitem)
                            <li class="{{ $navitem['classnames'] }}">
                                <a href="{{ $navitem['slug'] }}">{{ $navitem['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <p class="navbar-text navbar-right header__rssIconContainer">
                        <a href="{{route('blog-rss')}}" title="Abonneer je op de RSS feed van mijn blog">
                            <i class="icon icon--rss"></i>
                        </a>
                    </p>
                @endif
            </div>

        </div>
    </nav>
</header>
