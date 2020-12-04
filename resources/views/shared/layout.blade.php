<html>
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

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
        <br/>
        <div class="container" style="margin-top:5rem;">
            <main role="main" class="pb-3">
                @yield('content')
            </main>
            <div id="error">
            </div>
        </main>            
       </div>
    </body>
</html>