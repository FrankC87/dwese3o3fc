<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Online 3</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/extrastyle.css" />
</head>
 <?php session_start(); ?>
<body>
    <header class="container">
        <div class="row page-header">
            <div class="col-2 circulo"><img src="../img/logo.svg" alt="logo"></div>
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
            <?php
        if (isset($_SESSION['username']) === false) {
            ?>
            <h3>No esta conectado.</h3>
            
            </div>
            <div class="row">
            <button class="btn btn-success" onclick="location.href = 'index.php'">Volver</button>
            <?php
        } else {

            require_once('connect_db.php');
            echo "<h4>USUARIO: " . $_SESSION['username'] . "</h4>";
			echo "<hr/>";
            $username = $_SESSION['username'];          
			?>        
            </div>          
            <div class="row">
                <div class="col-6">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset><legend>Ingresos</legend>
                            Fecha: <input type="date" name="ingreso[]" required='required' ><br />
                            Descripcion: <input type='text' name='ingreso[]' required='required' /><br />
                            Cantidad: <input type="number" name="ingreso[]" value="0" min="0" step="0.01" max="99999999.99" required='required'/><br /><br />
                            <input class="btn btn-primary" type='submit' value='Enviar' />                          
                        </fieldset>
                    </form>
                </div>
                <div class="col-6">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <fieldset><legend>Gastos</legend>
                            Fecha: <input type="date" name="gasto[]" required='required' ><br />
                            Descripcion: <input type='text' name='gasto[]' required='required' /><br />
                            Cantidad: <input type="number" name="gasto[]" value="0" min="0" step="0.01" max="99999999.99" required='required'/><br /><br />
                            <input class="btn btn-primary" type='submit' value='Enviar' />   
                        </fieldset>
                    </form>
                </div>
            </div>
            <br/>
           
        <?php
 
            if(isset($_POST['ingreso'])){
                $nuevoMovimiento=$_POST['ingreso'];
                array_push($nuevoMovimiento,"I");
				unset($_POST['ingreso']);
                
            }
            if(isset($_POST['gasto'])){
                $nuevoMovimiento=$_POST['gasto'];
                array_push($nuevoMovimiento,"G");
				unset($_POST['gasto']);
            }
            if(isset($nuevoMovimiento)){
                
                $sql = 'INSERT INTO movimientos(nick,fecha,descripcion,cantidad,tipo) values(?,?,?,?,?)';
                $sth = $dbh->prepare($sql);
                $success = $sth->execute(array($username,$nuevoMovimiento[0],$nuevoMovimiento[1],$nuevoMovimiento[2],$nuevoMovimiento[3]));
                
                if ($success) {

                    $date = new DateTime($nuevoMovimiento[0]);

                    ?>
                    <div class="col-6">                  
                    <table class="table">
                    <?php
                    if($nuevoMovimiento[3]==="I")
                    {
                        echo "<tr><th>Ingreso Registrado</th></tr>";
                    }
                    else{
                        echo "<tr><th>Gasto Registrado</th></tr>";
                    }
                    ?>                   
                    <tr><th>Fecha</th><th>Descripcion</th><th>Cantidad</th></tr>
                    <tr><td><?=date_Format($date,'d-m-Y')?></td><td><?=$nuevoMovimiento[1]?></td><td><?=$nuevoMovimiento[2]?></td></tr>
                    </table>
                    </div>
                    <?php
					unset($nuevoMovimiento);
                }
                else{
                    echo "<h4>Movimiento No Registrado</h4>";
                }
            }
    
        
        ?>
             <br/>
             <div class="row">
			 <table>
			 <tr>
             <th><button class="btn btn-success" onclick="location.href = 'generator.php'">Generar</button></th>     
             <th><button class="btn btn-danger" onclick="location.href = 'logout.php'">Desconectarse</button></th>
			 <tr>
			 </table>
            </div>
		<?php }
		?>
        </div>
            </section>
        </div>
    </main>
    <div id="espacio"></div>
    <footer class="container footer-copyright text-center py-3">
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
