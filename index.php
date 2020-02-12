<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Online 3</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/extrastyle.css" />
</head>

<body>
    <header class="container">
        <div class="row page-header">
            <div class="col-2 circulo"><img src="img/logo.svg" alt="logo"></div>
            <div id="texto-header" clas="col-10">
                <h1><span>D</span>esarrollo <span>W</span>eb en <span>E</span>ntorno <span>S</span>ervidor</h1>
                <h3>Tarea Online 03</h3>
            </div>
        </div>
    </header>
    <div id="espacio"></div>
    <main class="container">
        <div class="row" id="cuerpo">
            <nav class="nav-var col-2">
                <ul class="navbar-nav ml-auto">         
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/online4/">Principal</a>
                    </li>                  
                </ul>
            </nav>
            <section class="container col-10" id="principal">
            <h2>Ejercicio 3</h2>
            <hr/>
               <div class="container">
            <div class="row">

                <form action='login.php' method='post'>
                    
                    <div class="form-group">
                        Usuario: <input type='text' name='username' title='Username' required='required' />
                    </div>
                    <div class="form-group">
                        Contraseña: <input type='password' name='password' title='Password' required='required' />
                    </div>
                        <input class="btn btn-success" type='submit' value='Conectarse' />

                        <button class="btn btn-dark" onclick="location.href = 'signup.php'">Registrarse</button>
                  
                </form>

            </div>
        </div>
            </section>
        </div>
    </main>
    <div id="espacio"></div>
    <footer class="container footer-copyright text-center py-3 fixed-bottom">
    © 2020 Copyright: FC Desarrollos
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>
