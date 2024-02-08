<?php
error_reporting(0);

include "php/config.php";
include "php/function.php";

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

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");

    $lokasi_file = $_FILES['filecsv']['tmp_name'];
    if (!empty($lokasi_file)) {
        $csvFile = fopen($_FILES['filecsv']['tmp_name'], 'r');
        // skip baris pertama
        //str_replace(array('$','.'), array('',''),$gross)
        fgetcsv($csvFile);
            while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
                {
                    $id_site = $getData[0];
                    $user_group = $getData[1];            
                    $entry_start = convert_tanggal($getData[2]);  
                    $entry_stop = convert_tanggal($getData[3]);           
                    $duration = $getData[4];
                    $gross = $getData[5];
                    $fee = $getData[6];
                    $net_rate = $getData[7];
                    $number_plate = $getData[9];
                    $receipt = $getData[10];
                    $reference = $getData[11];

                    $insert =  mysqli_query($koneksi, "insert into tbl_transaction (id_site,user_group, entry_start, entry_stop, duration, gross, fee, net_rate, number_plate, receipt, reference) VALUES ('" .$id_site. "', '" . $user_group . "', '" .$entry_start. "', '" .$entry_stop. "', '" .$duration. "', '" .str_replace('$','',$gross). "', '" .str_replace('$','',$fee). "', '" .str_replace('$','',$net_rate). "', '" .$number_plate. "', '" .$receipt. "' ,'" .$reference. "')");  
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

if($_GET['act'] == 'site'){

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");

    $rows = array();
    $sql = mysqli_query($koneksi, "select * from tbl_site");
    while($data = mysqli_fetch_assoc($sql)){
        $rows[] = $data;
    }
    echo json_encode($rows);

}

if($_GET['act'] == 'detail_site'){

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");

    $rows = array();
    $sql = mysqli_query($koneksi, "select * from tbl_transaction where id_site = '".$_GET['id']."'");
    while($data = mysqli_fetch_assoc($sql)){
        $formatter = new NumberFormatter('en_US',  NumberFormatter::CURRENCY);
        $rows[] = array(
            "id"=> $data['id'],
            "id_site"=> $data['id_site'],
            "user_group"=> $data['user_group'],
            "entry_start"=> $data['entry_start'],
            "entry_stop"=> $data['entry_stop'],
            "duration"=> $data['duration'],
            "gross"=> $formatter->formatCurrency($data['gross'], 'USD'),
            "fee"=> $formatter->formatCurrency($data['fee'], 'USD'),
            "net_rate"=> $formatter->formatCurrency($data['net_rate'], 'USD'),
            "default_value"=> $data['default_value'],
            "number_plate"=> $data['number_plate'],
            "receipt"=> $data['receipt'],
            "reference"=> $data['reference'],
        );
    }
    echo json_encode($rows);

}

?>