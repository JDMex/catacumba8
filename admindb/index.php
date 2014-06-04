<?php
 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
include("includes/config.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 5//EN" "http://www.w3.org/TR/html5/html5.dtd">
<html lang="es">
<head>
    <title>Catacumba 8 - Administrator</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" href="css/html_reset.css" />  
    <link rel="stylesheet" href="css/style.css" />
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    
    <script type="text/javascript">
	$(document).ready(function() { 
	    sumEfcCheck();
	});
    </script>
</head>

<body>
    <div id="wrapper_1">    
	<div class="row_logo">
	    <img id="logo-cata8" src="images/Logo-Vertical-Ver-catacumba-8-2014.png">
	</div>
	<div class="row_menu">
	    <a href="#">Inicio</a>
	    <a href="#">Diezmo/Ofrenda</a>
	    <a href="#">Miembros</a>
	</div>
	
	<h3>Formulario Ingreso Diezmo/Ofrenda</h3>
	<!--<div class="row_one">
	    <strong>Fecha:</strong> <?php echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ; ?>
	</div>-->
	<form action="process_ing_ofr_die.php" enctype="multipart/form-data" method="post">
	    <div class="row_one" style="font-weight:bold;">
		Fecha del reporte: 
	    </div>
	    <div class="row_one" >
		<select id="month" name="month" class="slt_3">
		    <option value="none">Mes</option>
		</select>
		
		<select id="day" name="day" class="slt_3">
		    <option value="none">D&iacute;a</option>
		</select>
		
		<select id="year" name="year" class="slt_3">
		    <option value="none">A&ntilde;o</option>
		</select>
	    </div>
	    <div class="row_one prt1">
		<div class="column_left">
		    <fieldset>
			<legend>Verificaci&oacute;n #1</legend>
		    <p><label for="cash_total">Total Efectivo</label><br/>
		    <input id="cash_total" name="cash_total" type="number"  onchange="javascript: sumEfcCheck();" /></p>
		    
		    <p><label for="check_total">Total Cheques</label><br/>
		    <input id="check_total" name="check_total" type="number" onchange="javascript: sumEfcCheck();" /></p>
		    
		    <p><label for="grant_total">Gran Total</label><br/>
			<input id="grant_total" name="grant_total" type="number" disabled="disabled"/>
		    <input id="grant_total_fn" name="grant_total_fn" type="hidden"/></p> 
		    </fieldset>
		</div>
		<div class="column_right">
		    <fieldset>
			<legend>Verificaci&oacute;n #2</legend>
		    <p><label for="ofrenda_total">Total Ofrendas</label><br/>
		    <input id="ofrenda_total" name="ofrenda_total" type="number"  onchange="javascript: ;" /></p>
		    
		    <p><label for="diezmos_total">Total Diezmos</label><br/>
		    <input id="diezmos_total" name="diezmos_total" type="number" disabled="disabled" value="0.00"/>
		    <input id="diezmos_total_fn" name="diezmos_total_fn" type="hidden"/></p>
		    
		    <p><label for="grant2_total">Gran Total</label><br/>
		    <input id="grant2_total" name="grant2_total" type="text" disabled="disabled" value="0.00"/>
		    <input id="grant_total_fn2" name="grant_total_fn2" type="hidden"/></p>
		    </fieldset>
		</div>
		<div class="clearfloat"></div>
	    </div>
	    
	    <h4>Desgloce de diezmos </h3>
	    <ol id="ddd_ol">
		<?php
		$count_mbr = "SELECT * FROM `miembros`;";
		$result_count_mbr = $con->query($count_mbr);	
		$row_count_mbr = 5;
		print '<input type="hidden" id="count" name="count" value="'.$row_count_mbr.'"/>';
		for($tp=1;$tp<=$row_count_mbr;$tp++)
		{
		    print '
		    <li class="ddd_li">
		    <select id="member_'.$tp.'" name="member[]" class="slt_1">
			<option value="none">Escoger miembro</option>';
			$ch_mbr = "SELECT * FROM `miembros`;";
			
			$result_mbr = $con->query($ch_mbr);
			
			while($inf_mb=mysqli_fetch_assoc($result_mbr))
			{
			    $nmlm = utf8_encode($inf_mb["name"].' '.$inf_mb["lst_name"]);
			    print '<option value="'.$inf_mb["ID"].'">'.$nmlm.'</option>';
			}
		    print '	
		    </select>
		    
		    <select id="tipo_pago_mb'.$tp.'" name="tipo_pago_mb[]" class="slt_1" onchange="javascript: typePay('.$tp.');">
			<option value="none">Tipo de Pago</option>';
			
			$ch_tp = "SELECT * FROM `tipo_pago`";
			$result_tp = $con->query($ch_tp);
			while($inf_tp=mysqli_fetch_assoc($result_tp))
			{
			    print '<option value="'.$inf_tp["ID"].'">'.$inf_tp["option"].'</option>';
			}
		    print '
		    </select>
		    
		    <span id="num_chq_mb_box'.$tp.'" style="display:none;"><label for="num_chq_mb'.$tp.'">Num. cheque: </label>
		    <input id="num_chq_mb'.$tp.'" class="slt_1" name="num_chq_mb[]" type="text"/></span>
		    
		    <label for="cant_din_mb'.$tp.'">Cantidad: </label>
		    <input id="cant_din_mb'.$tp.'" class="slt_1" name="cant_din_mb[]" type="text" onchange="javascript: sumDiezmos();"/>
		    <div class="clearfloat"></div>
		</li>
		    ';
		}
		?>
	    </ol>
	    <div class="row_one" style="font-weight: bold;">Contabilizado por:</div>
	    <div class="row_one">
		<div class="column_left">
		    <?php
			print '
			<label for="contable_1" class="slt_2">Testigo 1:</label>
			<select id="contable_1" name="contable_1" class="slt_2">
			<option value="none">Escoger miembro</option>';
			$ch_mbr = "SELECT * FROM `miembros`;";
			
			$result_mbr = $con->query($ch_mbr);
			
			while($inf_mb=mysqli_fetch_assoc($result_mbr))
			{
			    $nmlm = utf8_encode($inf_mb["name"].' '.$inf_mb["lst_name"]);
			    print '<option value="'.$inf_mb["ID"].'">'.$nmlm.'</option>';
			}
			print '
			</select>';
		    ?>
		</div>
		<div class="column_right">
		    <?php
			print '
			<label for="contable_2" class="slt_2">Testigo 2:</label>
			<select id="contable_2" name="contable_2" class="slt_2">
			<option value="none">Escoger miembro</option>';
			$ch_mbr = "SELECT * FROM `miembros`;";
			
			$result_mbr = $con->query($ch_mbr);
			
			while($inf_mb=mysqli_fetch_assoc($result_mbr))
			{
			    $nmlm = utf8_encode($inf_mb["name"].' '.$inf_mb["lst_name"]);
			    print '<option value="'.$inf_mb["ID"].'">'.$nmlm.'</option>';
			}
			print '
			</select>';
		    ?>
		</div>
		<div class="clearfloat"></div>
	    </div>
	    <div class="row_one sub_box">
		<input type="submit" class="sumbit_butt"/>
	    </div>
	</form>
    </div>
<?php mysqli_close($con); ?>
</body>
</html>
