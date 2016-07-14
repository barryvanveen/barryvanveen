<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="footer__menu">
                    @if(!empty(config('custom.linkedin_profile')))
                        <li class="footer__menu-item">
                            <a href="{{ config('custom.linkedin_profile') }}" class="footer__menu-item-link" target="_blank">
                                <i class="icon icon--linkedIn">LinkedIn</i>
                            </a>
                        </li>
                    @endif
                    @if(!empty(config('custom.github_profile')))
                        <li class="footer__menu-item">
                            <a href="{{ config('custom.github_profile') }}" class="footer__menu-item-link" target="_blank">
                                <i class="icon icon--github">GitHub</i>
                            </a>
                        </li>
                    @endif
                    <li class="footer__menu-item">
                        <a href="{{route('blog-rss')}}" class="footer__menu-item-link" title="{{ trans('nav.rss-title') }}">
                            <i class="icon icon--rss">RSS feed</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
