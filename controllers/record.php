<?php
require_once '../config/connectdb.php';
date_default_timezone_set('asia/bangkok');
// $result = [
//     'status' => 200,
//     'msg' => 'success',
//     'msg_text' => 'text detel',
//     'comment' => 'comment'
// ];

$result = new stdClass(); 

$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key !== null && $key === "form-record") {
    $code_std = $_POST["std_ID"];
    try {

        $row = DB::Query("SELECT * FROM student WHERE code_std = $code_std AND status_std != 0", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
        if (isset($row) && $row != null) {
            $id_std = $row->id_std;
            $rowRecord = DB::Query("SELECT * FROM `record` WHERE id_std = '$id_std' AND tout_hi IS NULL AND status_hi = 1", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
            if (isset($rowRecord) && $rowRecord != null) {
                // ออกจากห้อง
                // UPDATE `record` SET `tout_hi` = '2023-01-05 13:27:47' WHERE `record`.`id_hi` = 9;
                if (DB::query("UPDATE `record` SET `tout_hi` = current_timestamp() ,`status_hi` = '0'  WHERE `record`.`id_hi` = $rowRecord->id_hi;")) {
                    $result->msg = "success-out";
                    $result->msg_text = "ออกจากห้องสำเร็จ";
                } else {
                    $result->msg = "error-out";
                    $result->msg_text = "บันทึกออกห้องไม่สำเร็จ!!!!!!!!";
                }
            } else {
                // เข้าห้อง
                if (DB::query("INSERT INTO `record` (`id_hi`, `id_std`, `tin_hi`, `tout_hi`, `status_hi`) VALUES (NULL, $id_std, current_timestamp(), NULL, '1');")) {

                    $result->msg = "success-in";
                    $result->msg_text = "บันทึกเข้าห้อง";
                } else {
                    $result->msg = "error-in";
                    $result->msg_text = "บันทึกไม่สำเร็จ!!!!!!!!";
                }
            }
        } else {
            $result->msg = "error";
            $result->msg_text = "เกิดข้อผิดพลาดการค้นหา";
        }
    } catch (Exception $e) {
        $result->msg = 'error';
        $result->msg_text = $e->getMessage();
    }

    getOutputJson($result);
}
