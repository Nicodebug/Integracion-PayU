<!DOCTYPE HTML>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Validador de Pago</title>
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Titillium+Web');
section {
    background-color: rgba(0,0,0,0.0);
    border-color: rgba(0,0,0,0.10);
    border-style: solid;
    border-color: rgba(0,0,0,0.0);
}

img{
	display:block;
	margin:auto;
}
section {
	margin-left: auto;
	margin-right: auto;
	padding-left:20px;
	padding-right:20px;
	width: 350px;
	text-align:center;
}
input {
	margin-left: auto;
	margin-right: auto;
		font-size:18px;
	font-family: 'Titillium Web', sans-serif;
	text-align: center;
}
input[type="numb"] {
	font-size:18px;
	justify-content: center;
	margin-left: auto;
	margin-right: auto;
}
p {
	font-size:18px;
	font-family: 'Titillium Web', sans-serif;
	text-align: center;
}
div{
	margin-left: auto;
	margin-right: auto;
	justify-content: center;
	
}
.pay {
	padding-left: 30px;
	padding-right: 30px;
	text-align:center;
}	
form {
	text-align: center;
	padding-left: 25px;
	padding-right: 30px;}
</style>
</head>
<body>
<section>
<br><br><br>

<img src="http://rutasescolares.transportescircular.com/wp-content/uploads/2017/08/rutas_logo-01.png" alt="Mountain View" style="width:280px;height:110px;">

<p>Por su seguridad ingrese código de estudiante.</p>

<?php

if(isset($_POST['submit']))

{

$name = $_POST['name'];

echo "<p><b> $name </b><br> Exito, ahora puedes proceder a hacer el pago.</p>";

}

?>
<div>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<input type="numb" name="name" minlength="8" maxlength="8" pattern="([0-9]{8})" style="text-align:center;">

<input type="submit" name="submit" value="Validar" align="center"><br>

</form>
</div>

<?php 
$apiKey = "2ktakdcadoocpnfak1s3c2eh18";
$merchantId = "523720";
$referenceCode =  "$name";
$amount = "129700";
$currency = "COP";
$stringToHash = $apiKey . "~" . $merchantId . "~" . $referenceCode . "~" . $amount . "~" . $currency;
$signature = md5($stringToHash);
?>
<br><br><br>
<div class="pay">
<form method="post" action="https://gateway.payulatam.com/ppp-web-gateway/" accept-charset="UTF-8">
  <input type="image" border="0" alt="" src="http://www.payulatam.com/img-secure-2015/boton_pagar_grande.png" onClick="this.form.urlOrigen.value = window.location.href;" class="payu" />
  <input name="buttonId" type="hidden" value="cNRI15UGhfb6v7zpTZF7HNw95SHNm2NOYJWkuQ5kn9i4vciGnpZgxA=="/>
  <input name="merchantId" type="hidden" value="<?php echo $merchantId;?>"/>
  <input name="accountId" type="hidden" value="564105"/>
  <input name="description" type="hidden" value="Excedente Ruta corta"/>
  <input name="referenceCode" type="hidden" value="<?php echo $referenceCode;?>"/>
  <input name="amount" type="hidden" value="<?php echo $amount;?>"/>
  <input name="tax" type="hidden" value="0"/>
  <input name="taxReturnBase" type="hidden" value="0"/>
  <input name="currency" type="hidden" value="COP"/>
  <input name="lng" type="hidden" value="es"/>
  <input name="approvedResponseUrl" type="hidden" value="http://rutasescolares.transportescircular.com/index.php/transaccion-aprobada/"/>
  <input name="declinedResponseUrl" type="hidden" value="http://rutasescolares.transportescircular.com/index.php/transaccion-rechazada/"/>
  <input name="pendingResponseUrl" type="hidden" value="http://rutasescolares.transportescircular.com/index.php/transaccion-en-proceso/"/>
  <input name="displayShippingInformation" type="hidden" value="NO"/>
  <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
  <input name="buttonType" value="SIMPLE" type="hidden"/>
  <input name="signature" value="<?php echo $signature; ?>" type="hidden"/>
</form>
</div>
</section>
</body>
</html>

