<?php

session_start();

require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();


if (isset($_SESSION['username']) === false) {

    $mpdf->WriteHTML('<h1>Usuario no Autorizado</h1>');
}
else{
    require_once('connect_db.php');

    $username=$_SESSION['username'];

    $mpdf->WriteHTML('<table width="100%">');
    $mpdf->WriteHTML('<tr bgcolor="#088A08"><th color="white" colspan="6">BALANCE</th></tr>');
    $mpdf->WriteHTML('<tr bgcolor="#01DF01"><th colspan="3">INGRESOS</th><th colspan="3">GASTOS</th></tr>');
    $mpdf->WriteHTML('<tr bgcolor="#58FA58"><th>Fecha</th><th>Descripción</th><th>Cantidad</th><th>Fecha</th><th>Descripción</th><th>Cantidad</th></tr>');
    
    //Obtenemos los datos de ingresos y gastos
    $sql = 'SELECT fecha,descripcion,cantidad
    FROM `movimientos` 	
    where nick=? and tipo=?
    order by fecha';
    $sth = $dbh->prepare($sql);
    $sth->execute(array($username,"I"));
    $resultsI = $sth->fetchAll();

    $sql = 'SELECT fecha,descripcion,cantidad
    FROM `movimientos` 	
    where nick=? and tipo=?
    order by fecha';
    $sth = $dbh->prepare($sql);
    $sth->execute(array($username,"G"));
    $resultsG = $sth->fetchAll();
    
    //Averiguamos si hay mas ingresos o gastos
    if(count($resultsI)>count($resultsG)){
        $mayor=count($resultsI);
    }
    else{
        $mayor=count($resultsG);
    }
    
    //CReamos un cadena que almacenara el codigo necesario para mostrar los ingresos y gastos en cada columna
    $cadena="";
    $ingresos=0;
    $gastos=0;
    for($i=0;$i<$mayor;$i++)
    {
        
        $cadena=$cadena."<tr>";
        if(is_array($resultsI[$i])){
            $date = new DateTime($resultsI[$i][0]);
            $cadena=$cadena."<td align='right'>".date_Format($date,'d-m-Y')."</td>";
            $cadena=$cadena."<td>".$resultsI[$i][1]."</td>";
            $cadena=$cadena."<td align='right'>".$resultsI[$i][2]." €</td>";
            $ingresos+=$resultsI[$i][2];
        }
        else{
            $cadena=$cadena."<td></td><td></td><td></td>";
        }
        if(is_array($resultsG[$i])){
            $date = new DateTime($resultsG[$i][0]);
            $cadena=$cadena."<td align='right'>".date_Format($date,'d-m-Y')."</td>";
            $cadena=$cadena."<td>".$resultsG[$i][1]."</td>";
            $cadena=$cadena."<td align='right'>".$resultsG[$i][2]." €</td>";
            $gastos+=$resultsG[$i][2];
        }
        else{
            $cadena=$cadena."<td></td><td></td><td></td>";
        }
        $cadena=$cadena."</tr>";
    }

    $mpdf->WriteHTML($cadena);

    $cadenaTotales="<tr><th colspan='2' align='right'>Total de ingresos:</th><td align='right'>".$ingresos." €</td>";
    $cadenaTotales=$cadenaTotales."<th colspan='2' align='right'>Total de gastos:</th><td align='right'>".$gastos." €</td></tr>";

    $mpdf->WriteHTML($cadenaTotales);

    $total=$ingresos-$gastos;
    $cadenaFinal="<tr><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
    $cadenaFinal=$cadenaFinal."<tr><th colspan='2' align='right'>BALANCE ACTUAL</th><th align='right'>".$total." €</th><td></td><td></td><td></td></tr>";

    $mpdf->WriteHTML($cadenaFinal);

    $mpdf->WriteHTML('</table>');
}

$mpdf->Output()

?>