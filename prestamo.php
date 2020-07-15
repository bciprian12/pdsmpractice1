<?php
$v_inmueble = $_POST['v_inmueble'];
$p_inicial = $_POST['p_inicial'];
$interes = $_POST['interes'];
$periodo = $_POST['periodo'];

$capital = $v_inmueble - $p_inicial;

$interes = $interes /100;

$pago_mensual = $interes / 12 * pow( 1+ $interes / 12, $periodo) / (pow(1 + $interes/12, $periodo) -1) * $capital;

$total=round($pago_mensual * $periodo,2);

if ($periodo < 12)
{
$meses = $periodo;
$tiempo = $meses. ' meses';
}
elseif ($periodo % 12 == 0)
{
$anos = $periodo / 12;
$tiempo = $anos . ' años ';
} 
else
{
//intdiv para que solo me de el resultado entero de la division
$anos = intdiv($periodo,12);
$meses = $periodo % 12;
$tiempo = $anos . ' años y ' . $meses. ' meses';
}


echo 'El pago mensual seria de US$' . round($pago_mensual,2) .'<br>';

echo "Para una hipoteca de US$$capital amortizado en $tiempo <br>";

echo 'Hipoteca total con interes US$' . $total ;

$total= $total + $p_inicial;

echo '<br> Total con anticipo US$' . $total;
?>