<?php

function convert_tanggal($tanggal){

    $now = explode(" ", $tanggal);
    $jml = count($now);
    if($jml <= 2){
        $ppp = explode("/", $now[0]);
        $tanggal = "20".$ppp[2]."-".$ppp[1]."-".$ppp[0];

        $jjj = explode(":", $now[1]);
        $jam = $jjj[0].":".$jjj[1].":00";
        
        $all_date = $tanggal." ".$jam;
    }else{
        $all_date = new DateTime();
    }

    return $all_date;

}