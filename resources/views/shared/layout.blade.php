<html>
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Super site - @yield('title')</title>
  </head>
    <body>
        @section('navbar')
        <header class="fixed-top" id="header">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" asp-area="" asp-controller="home" asp-action="index">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item" style="margin-left: auto; margin-right: auto;">
                            <form class="form-inline my-2 my-lg-0" asp-area="" asp-controller="movie" asp-action="search" method="get">
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