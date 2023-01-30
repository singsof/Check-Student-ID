<?php
require_once "../../../config/connectdb.php";

$result = new stdClass();

$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key !== null && $key === "login-admin") {
    $value = $_POST["data"];

    $email_ad = $value["email"];
    $pass_ad = $value['pass'];
    // $pass_ad = password_hash($value["pass_ad"], PASSWORD_DEFAULT);


    try {
        $row = DB::query("SELECT * FROM `admin` WHERE email_ad='$email_ad'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
        if (isset($row) && $row != null) {
            // foreach ($row as $row) {
            if ((isset($row->email_ad) && $row->email_ad === $email_ad) && (isset($row->pass_ad) && $pass_ad === $row->pass_ad)) {
                // $result->id_admin   = $row->id_admin  ;
                $_SESSION["auth"] = true;
                $_SESSION["key"] = "admin";
                $_SESSION["id"] = $row->id_ad;
                $result->msg = "success";
                $result->msg_text = "ยินดีตอนรับเข้าสู่ระบบ";
                // break;
            } else {
                $result->msg = "error";
                $result->msg_text = "กรุณาตรวจสอบอีเมลหรือรหัสผ่านใหม่อีกครั้ง!!!!!!!!";
            }
            // }
        } else {
            $result->msg = "error";
            $result->msg_text = "กรุณาตรวจสอบอีเมลหรือรหัสผ่านใหม่อีกครั้ง!!!!!!!!";
        }
    } catch (Exception $e) {
        $result->msg = 'error';
        $result->msg_text = $e->getMessage();
    }

    getOutputJson($result);
}
