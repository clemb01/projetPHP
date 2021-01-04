<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/site.css">

    <title>Super site - @yield('title')</title>
    <link rel="icon" href="/favicon.ico"/>
</head>

<body>
    @section('navbar')
    <header class="fixed-top" id="header">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="/accueil">
                <img src="/favicon.ico" width="30" height="30" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/accueil">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    @if(!empty($_SESSION['user']) && ($_SESSION['user']->getRole() === "admin" || $_SESSION['user']->getRole() === "modo" ))
                    <li class="nav-item">
                        <div class="dropdown">
                            <a class="dropdown-toggle nav-link" style="height: 40px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Administration
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="/admin/commentaires">Gestion des commentaires</a>
                                @if ($_SESSION['user']->getRole() === "admin")                                
                                    <a class="dropdown-item" href="/admin/users">Gestion des utilisateurs</a>
                                @endif
                            </div>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item" style="margin-left: 20px;">
                        <form class="form-inline my-2 my-lg-0" action="/search" method="get">
                            <input class="form-control mr-sm-2" type="text" name="query" placeholder="Rechercher un film" required>
                            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Chercher</button>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right slices">
                    @if(empty($_SESSION['user']))
                        <li data-toggle='modal' data-target='#SeConnecter' class='nav-item active' onclick="" ><a class="btn btn-default BtnDroit" id="BtnLogin">Se connecter</a></li>
                        <li class='nav-item active' onclick="" ><a class="btn btn-default BtnDroit" id="BtnInscrire" href="/formulaireUser">S'inscrire</a></li>
                    @else
                        <li class='nav-item active' href="#" ><a class="btn btn-default BtnDroit">{{ $_SESSION['user']->getLogin()}}</a></li>
                        <li class='nav-item active' ><a class="btn btn-default BtnDroit" href="/accueil/logout?returnUrl={{ $_SERVER['REQUEST_URI'] }}"  id="BtnInscrire">Se deconnecter</a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </header>
    @show
    <div class="container" style="margin-top:3.4rem;">
        <main role="main" class="pb-3">
            @yield('content')
        </main>
        </main>
        <div class="modal fade" id="SeConnecter" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">Se connecter</h2>
                    </div>
                    <div class="modal-body" id="formulaire">
                        <form class="Jumbotron" action='/accueil/login' method="post">
                            <input type="text" value="{{ $_SERVER['REQUEST_URI'] }}" name="returnUrl" hidden/>
                            <p><label class="">Login</label></p>
                            <p><input type="text" value="" name="login_user" name="login_user" required></p>
                            <p><label class="">Mot de passe</label></p>
                            <p><input type="password" value="" id="mdp_user" name="mdp_user" required></p>
                            <p>
                                <button type="submit" class="btn" style="border:solid;">Se connecter</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    @yield('script')

</body>

</html>