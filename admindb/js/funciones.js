

function sumEfcCheck()
{
    var cash = $("#cash_total").val();
    var check = $("#check_total").val();
    
    
    if(cash != "" && check != "")
    {
        var sumCachMasCheck = Number(cash) + Number(check);
        $("#grant_total").val(sumCachMasCheck.toFixed(2));
        $("#grant_total_fn").val(sumCachMasCheck.toFixed(2));
    }
    else
    {
        $("#grant_total").val("0.00");
        $("#grant_total_fn").val("0.00");
    }
}
function sumDiezmos() {
    var count = $("#count").val();
    $("#diezmos_total").val("0.00");
    $("#diezmos_total_fn").val("0.00");
    for (dz=1;dz<=count;dz++) {
        var chkin = $("#cant_din_mb"+dz).val();
        if (chkin != "") {
            var sumaDetodosDiezmos = Number($("#cant_din_mb"+dz).val()) + Number($("#diezmos_total").val());
            $("#diezmos_total").val(sumaDetodosDiezmos.toFixed(2));
            $("#diezmos_total_fn").val(sumaDetodosDiezmos.toFixed(2));
        }  
    }
}

function typePay(numRow) {
    var ty_pay = $("#tipo_pago_mb"+numRow).val();
    if (ty_pay == "2") {
        $("#num_chq_mb_box"+numRow).fadeIn();
    }
    else  if (ty_pay == "none" || ty_pay == "1") {
        $("#num_chq_mb_box"+numRow).fadeOut();
    }
}