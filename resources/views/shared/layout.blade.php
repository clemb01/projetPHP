<html>
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/site.css">

    <title>Super site - @yield('title')</title>
    </head>
    <body>
        @section('navbar')
        <header class="fixed-top" id="header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/accueil">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item" style="margin-left: auto; margin-right: auto;">
                            <form class="form-inline my-2 my-lg-0" action="search" method="get">
                                <input class="form-control mr-sm-2" type="text" name="query" placeholder="Rechercher un film" required>
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Chercher</button>
                            </form>
                        </li>
                    </ul>
                    </div>
                </div>
            </nav>
        </header>
        @show
        <div class="container" style="margin-top:3.4rem;">
            <main role="main" class="pb-3">
                @yield('content')
            </main>           
       </div>
    <script src="/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    @yield('script')
    </body>
</html>