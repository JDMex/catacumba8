<?php
include("includes/config.php");
print_r($_POST);


//
//
//[count]
//[member] => Array ( [0] => none )
//[tipo_pago_mb] => Array ( [0] => none )
//[num_chq_mb] => Array ( [0] => )
//[cant_din_mb] => Array ( [0] => ) )

$ip = $_SERVER["REMOTE_ADDR"];

$insert_report = "INSERT INTO `ofr_diezm_report` (`ID`, `month`, `day`, `year`, `cash_total`, `check_total`, `gran_total`, `ofrenda_total`, `diezmo_total`, `gran_total2`, `prs_contabilidad_1`, `prs_contabilidad_2`, `user_ip`, `date_reg`, `date_upd`, `admin_id`) VALUES (NULL, '".$_POST['month']."', '".$_POST['day']."', '".$_POST['year']."', '".$_POST['cash_total']."', '".$_POST['check_total']."', '".$_POST['grant_total_fn']."' ,'".$_POST['ofrenda_total']."', '".$_POST['diezmos_total_fn']."', '".$_POST['grant_total_fn2']."', '', '', '".$ip."', NOW( ), NOW( ), '');";
//$result_insert_report = $con->query($insert_report);


if (!$con->query($insert_report)) {
    echo "INSERT failed: (" . $con->errno . ") " . $con->error;
}    
echo "Newest user id = ",$con->insert_id;


mysqli_close($con);

?>