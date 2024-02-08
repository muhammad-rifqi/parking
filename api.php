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

?>