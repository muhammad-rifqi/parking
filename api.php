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




if($_GET['act'] == 'insert_owner_csv'){
    $lokasi_file = $_FILES['filecsv']['tmp_name'];
    if (!empty($lokasi_file)) {
        $csvFile = fopen($_FILES['filecsv']['tmp_name'], 'r');
        // skip baris pertama
        fgetcsv($csvFile);
            while (($getData = fgetcsv($csvFile, 1000, ",")) !== FALSE)
                {
                    $id = $getData[0];
                    $kode_owner = $getData[1];            
                    $nama = $getData[2];  
                    $jenis_kelamin = $getData[3];           
                    $alamat = $getData[4];
                    $telpon = $getData[5];
                    $email = $getData[6];
                    $kelurahan = $getData[7];
                    $kecamatan = $getData[8];
                    $kota = $getData[9];
                    $provinsi = $getData[10];
                    $status = $getData[11];
                    $id_pet = $getData[12];
                    $no_wa = $getData[13];

                    $check = mysqli_query($koneksi, "select id, kode_owner from tbl_owner where kode_owner = '" .$kode_owner. "'");

                    if (mysqli_num_rows($check) > 0){
                       $update =  mysqli_query($koneksi, "update tbl_owner set kode_owner='" .$kode_owner. "',nama='" . $nama . "', jenis_kelamin='" . $jenis_kelamin . "', alamat='" . $alamat . "',telpon='" . $telpon . "', email = '" . $email . "', kelurahan = '" . $kelurahan . "' , kecamatan = '" . $kecamatan . "' ,  kota = '" . $kota . "', provinsi = '" . $provinsi . "', status = '" . $status . "' , id_pet = '" . $id_pet . "', no_wa = '" . $no_wa . "' where kode_owner = '" . $kode_owner . "'");  
                            if($update){
                                $response = ["message" => "success updated"];
                            }else{
                                $response = ["message" => "update data failed"];
                            }
                    }else{
                        $insert =  mysqli_query($koneksi, "insert into tbl_owner (kode_owner,nama, jenis_kelamin, alamat, telpon, email, kelurahan, kecamatan, kota, provinsi, status, id_pet, no_wa) VALUES ('" .$kode_owner. "', '" . $nama . "', '" .$jenis_kelamin. "', '" .$alamat. "', '" .$telpon. "', '" .$email. "', '" .$kelurahan. "', '" .$kecamatan. "', '" .$kota. "', '" .$provinsi. "', '" .$status. "' ,'" .$id_pet. "','" .$no_wa. "')");  
                            if($insert){
                                $response = ["message" => "success inserted"];
                            }else{
                                $response = ["message" => "insert data failed"];
                            }
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