<?php
error_reporting(0);

include "php/config.php";

if ($_GET['act'] == 'login') {

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Credentials: true");

        $username = $_POST['usernames'];
        $password = md5($_POST['passwords']);
        $sql = mysqli_query($koneksi, "select * from tbl_users where username = '" . $username . "' and password  ='" . $password . "'");
        $data = mysqli_fetch_assoc($sql);
        $cek = mysqli_num_rows($sql);
        if ($cek > 0) {           
            $response = array("status" => "success" , "list" => $data);
        } else {
            $response = array("status" => "failed");
        }
        echo json_encode($response);
    
}


if ($_GET['act'] == 'profile') {

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    $username = strtolower(str_replace(" ", "",$_GET['un']));
    $sql = mysqli_query($koneksi, "select * from tbl_users where username = '" . $username . "'");
    $data = mysqli_fetch_assoc($sql);
    echo json_encode($data);

}




if($_GET['act'] == 'insert_csv'){
    $lokasi_file = $_FILES['filecsv']['tmp_name'];
    if (!empty($lokasi_file)) {
        $csvFile = fopen($_FILES['filecsv']['tmp_name'], 'r');
        // skip baris pertama
        fgetcsv($csvFile);
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
                {
                    $id_site = $getData[0];
                    $user_group = $getData[1];            
                    $entry_start = $getData[2];  
                    $entry_stop = $getData[3];           
                    $duration = $getData[4];
                    $gross = $getData[5];
                    $fee = $getData[6];
                    $net_rate = $getData[7];
                    $number_plate = $getData[8];
                    $receipt = $getData[9];
                    $reference = $getData[10];

                    $insert =  mysqli_query($koneksi, "insert into tbl_transaction (id_site,user_group, entry_start, entry_stop, duration, gross, fee, net_rate, number_plate, receipt, reference) VALUES ('" .$id_site. "', '" . $user_group . "', '" .$entry_start. "', '" .$entry_stop. "', '" .$duration. "', '" .$gross. "', '" .$fee. "', '" .$net_rate. "', '" .$number_plate. "', '" .$receipt. "' ,'" .$reference. "')");  
                        if($insert){
                            $response = ["message" => "success inserted"];
                        }else{
                            $response = ["message" => "insert data failed"];
                        }
                }
    } else {
        $response = ["message" => "failed_uploaded"];   
    }
    echo json_encode($response);
}




// $amount = '12345.67';

// $formatter = new NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
// echo 'UK: ', $formatter->formatCurrency($amount, 'EUR'), PHP_EOL;

// $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
// echo 'DE: ', $formatter->formatCurrency($amount, 'EUR'), PHP_EOL;
?>