<div class="uk-container uk-margin-bottom">
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li class="uk-active"><a href="/">Main</a></li>
            </ul>
        </div>

        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a>{{ Auth::user()->email }}</a>
                </li>
                <li>
                    <a href="#">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</div>
