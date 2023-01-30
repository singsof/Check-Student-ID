<?php


require_once '../../config/connectdb.php';

$result = new stdClass();
$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key !== null && $key === "edit-admin") {
    $value = $_POST["data"];

    $id_ad = $value['id_ad'];
    $name = $value['name'];
    $email_ad = $value['email_ad'];
    $pass_ad = $value['pass_ad'];

    $result->msg = 'error';
    $result->msg_text = 'เกิดข้อผิดพลาดเกียวกับข้อมูล';
    // UPDATE `admin` SET `name` = 'admi', `email_ad` = 'admin@admin.co', `pass_ad` = 'admin123' WHERE `admin`.`id_ad` = 1;
    if (DB::query("UPDATE `admin` SET `name` = '$name', `email_ad` = '$email_ad', `pass_ad` = '$pass_ad' WHERE `admin`.`id_ad` = $id_ad;")) {
        $result->msg = 'success';
        $result->msg_text = 'แก้ไขข้อมูลสำเร็จ';
    } else {
        $result->msg = 'error';
        $result->msg_text = 'แก้ไขข้อมูลสำเร็จไม่สำเร็จ';
    }
}
getOutputJson($result);
