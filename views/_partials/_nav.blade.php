<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">TalkingSpaces</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/">Home</a></li>
                @if (userLoggedIn() == false)
                <li><a href="/register">Create An Account</a></li>
                @endif
                @if (userLoggedIn() != false)
                <li><a href="/topic/create">Create Topic</a></li>
                @endif
            </ul>

        </div><!--/.nav-collapse -->
    </div>
</nav>