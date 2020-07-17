<!DOCTYPE html>
<html>
<head>

    <title>Calculadora de pretamo</title>
    <link rel="stylesheet" href="style.css">

</head>
    <form action="prestamo.php" method="post">

        <label for="v_inmueble">Valor del inmueble</label>
        <input type="number" id="v_inmueble" name="v_inmueble" required autofocus>
        <br><br>
        <label for="p_inicial">Pago inicial</label>
        <input type="number" id="p_inicial" name="p_inicial" required>
        <br><br>
        <label for="interes">taza de Interes anual (%)</label>
        <input type="number" id="interes" name="interes" required>
        <br><br>
        <label for="periodo">Periodo de Pago (meses)</label>
        <input type="number" id="periodo" name="periodo" required>
        <br><br>
        <button type="submit">Calcular</button>
    </form>


</body>
</html>


<?php


$v_inmueble = $_POST['v_inmueble'];
$p_inicial = $_POST['p_inicial'];
$interes = $_POST['interes'];
$periodo = $_POST['periodo'];

$capital = $v_inmueble - $p_inicial;
$interes = $interes /100;
$pago_mensual = $interes / 12 * pow( 1+ $interes / 12, $periodo) / (pow(1 + $interes/12, $periodo) -1) * $capital;
$total=round($pago_mensual * $periodo,2);

function tiempo($tiempo)
{
    if ($tiempo <= 12)
    {
       return $tiempo = $tiempo . ' meses';
    }
    elseif($tiempo % 12 == 0 && $tiempo > 12)
    {
      return  $tiempo = $tiempo/12 . ' años';
    }
    else
    {
       return $tiempo = intdiv($tiempo,12) . ' años y ' . $tiempo % 12 . ' meses';
    }
}




echo 'El pago mensual seria de US$' . round($pago_mensual,2) .'<br>';

echo "Para una hipoteca de US$$capital amortizado en " . tiempo($periodo) . '<br>';

echo 'Hipoteca total con interes US$' . $total ;

$total= $total + $p_inicial;

echo '<br> Total con anticipo US$' . $total;
?>