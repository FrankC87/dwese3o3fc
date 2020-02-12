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
                <div class="col-4">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group">
                        Usuario: <input type='text' name='username' title='Username' required='required' /><br />
                    </div>
                    <div class="form-group">
                        Contraseña: <input type='password' name='password' title='Password' required='required' /><br /><br />
                    </div>

                            <input class="btn btn-success" type='submit' value='Registrarse' />
                            <button class="btn btn-secondary" onclick="location.href = 'index.php'">Volver</button>
                     
                    </form>
                </div>
                <div class="col-8">
                    <?php
                    require_once('connect_db.php');
                    if (isset($_POST['username']) && isset($_POST['password'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        $username_regex = '/^[A-Za-z][A-Za-z0-9]{3,7}$/';

                        // https://www.coding.academy/blog/how-to-use-regular-expressions-to-check-password-strength
                        $password_regex = '/^(?=.*[0-9])(?=.*[a-z]).{4,20}$/';

                        if (preg_match($username_regex, $username) === 0) {
                            ?>

                            <p>Normas del nick de usuario:</p>

                            <ul>
                                <li>Debe empezar por letra.</li>
                                <li>Minimo 4 caracteres.</li>
                                <li>Maximo 8 caracteres.</li>
                                <li>Solo letras y numeros.</li>
                            </ul>

                        <?php } elseif (preg_match($password_regex, $password) === 0) { ?>

                            <p>Normas de contraseñas:</p>

                            <ul>
                                <li>Minimo 4 caracteres.</li>
                                <li>Maximo 20 caracteres.</li>
                                <li>Debe contener un numero.</li>
                                <li>Debe contener una letra minuscula.</li>
                            </ul>
                         
                        <?php
                    } else {


                        $sql = 'SELECT nick FROM users WHERE nick=?';
                        $sth = $dbh->prepare($sql);
                        $sth->execute(array($username));
                        $password_hash=password_hash($password, PASSWORD_DEFAULT);
                        $results = $sth->fetch();
                        if (empty($results)) {

                            $sql = 'INSERT INTO users(nick,pass) values(?,?)';
                            $sth = $dbh->prepare($sql);
                            $success = $sth->execute(array($username, $password_hash));

                            if ($success) {
                                ?>

                                <p>Nuevo usuario registrado</p>

                            <?php } else { ?>

                                <p>Error de registro.</p>

                                <?php
                            }
                        } else {
                            ?>
                            <p>El nombre de usuario esta en uso.</p>

                            <?php
                        }
                    }
                }
                ?>
                <br/>
                </div>
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

