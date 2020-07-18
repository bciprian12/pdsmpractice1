<!DOCTYPE html>
<html>
<head>

    <title>Calculadora de pretamo</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<div class="principal">

    <h1>Prestamo Inmobiliario</h1>
    <form  method="post" class="centrado">

        <label for="v_inmueble">Valor del inmueble</label><br>
        <input type="number" id="v_inmueble" name="v_inmueble" 
            min=1 placeholder="100,000" required autofocus 
            <?php if(isset($_REQUEST['v_inmueble']) && $_REQUEST['v_inmueble'] !=''):?> 
            value="<?php echo $_REQUEST['v_inmueble'];?>"<?php endif;?>>
        <br><br>
        <label for="p_inicial">Pago inicial</label><br>
        <input type="number" id="p_inicial" name="p_inicial" 
            min=1 placeholder="50,000" required
            <?php if(isset($_REQUEST['p_inicial']) && $_REQUEST['p_inicial'] !=''):?> 
            value="<?php echo $_REQUEST['p_inicial'];?>"<?php endif;?>>
        <br><br>
        <label for="interes">Taza de Interes anual (%)</label><br>
        <input type="number" id="interes" name="interes" 
            placeholder="20" required min=1 max=100
            <?php if(isset($_REQUEST['interes']) && $_REQUEST['interes'] !=''):?> 
            value="<?php echo $_REQUEST['interes'];?>"<?php endif;?>>
        <br><br>
        <label for="periodo">Periodo de Pago (meses)</label><br>
        <input type="number" id="periodo" name="periodo" 
            min=1 placeholder="12" required
            <?php if(isset($_REQUEST['periodo']) && $_REQUEST['periodo'] !=''):?> 
            value="<?php echo $_REQUEST['periodo'];?>"<?php endif;?>>
        <br><br>
        <button type="submit">Calcular</button> 
        <br>
        <button onclick="document.getElementById('v_inmueble').value ='',
        document.getElementById('p_inicial').value ='',
        document.getElementById('interes').value ='',
        document.getElementById('periodo').value ='' " >limpiar</button>
    </form>

   <br><br><br>
<?php

if (isset($_POST['v_inmueble'])){
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
       return $tiempo = '<b>' .$tiempo . '</b> meses';
    }
    elseif($tiempo % 12 == 0 && $tiempo > 12)
    {
      return  $tiempo ='<b>'. $tiempo/12 . '</b> años';
    }
    else
    {
       return $tiempo = '<b>'. intdiv($tiempo,12) . '</b> años y <b>' . $tiempo % 12 . '</b> meses';
    }
}
echo '<div>El pago mensual seria de <b>US$' . number_format($pago_mensual,2) .'</b><br><br>';


echo 'Para una hipoteca de <b>US$'.number_format($capital,2) .'</b> amortizado en ' . tiempo($periodo) . '.<br><br>';

echo 'Hipoteca total con interes: <b>US$' . number_format($total,2).'</b><br>' ;

$total= $total + $p_inicial;

echo '<br> Total con anticipo: <b>US$' . number_format($total,2).'</b><br></div>';

}

?>

</div>

</body>
</html>