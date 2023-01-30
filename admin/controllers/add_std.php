<?php

require_once '../../config/connectdb.php';

$result = new stdClass();
$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key !== null && $key === "add_std") {
    $value = $_POST["data"];

    $img_std = strlen($value["img_std"]) > 12 ? $value["img_std"] : null;
    $code_std = $value['code_std'];
    $name_std = $value['name_std'];
    $tel_std = $value['tel_std'];
    $classroom_std = $value['classroom_std'];
    if ($code_std === '' || $name_std === '' || $tel_std === '' || $classroom_std === '') {
        $result->msg = 'error';
        $result->msg_text = "กรุณาตรวจสอบข้อมูล";
        getOutputJson($result);
        return;
    }



    try {
        foreach (DB::query("SELECT * FROM `student` WHERE code_std ='$code_std' AND status_std != 0 ", PDO::FETCH_OBJ) as $row) {
            if ($row->code_std === $code_std) {
                $result->msg = 'error';
                $result->msg_text = 'มีข้อมูลนักเรียนในระบบแล้ว';
                getOutputJson($result);
                return;
            }
        }
    } catch (Exception $e) {
        $result->msg = 'error';
        $result->msg_text = $e->getMessage();
        getOutputJson($result);
        return;
    }

    if ($img_std === null) {
        $img_std = 'phoxix.png';
    } else {
        // set path to image folder
        $dataImage = new stdClass();
        $dataImage->path = "../../images/";
        $dataImage->base64_code = $img_std;

        $newDataImage = uploadeImageBase64($dataImage); //return stdClass msg,msg_text
        if ($newDataImage->msg === 'success') {
            $img_std = $newDataImage->nameImge;
        } else {
            getOutputJson($result);
            return;
        }
    }

    // echo $newDataImage->msg_text;
    try {
        $sqlText = "INSERT INTO `student` (`id_std`, `code_std`, `name_std`, `tel_std`, `classroom_std`, `status_std`, `date_std`, `img_std`) 
                VALUES (NULL, '$code_std', '$name_std', '$tel_std', '$classroom_std', '1', current_timestamp(), '$img_std');";
        if (DB::query($sqlText)) {
            $result->msg = 'success';
            $result->msg_text = 'เพิ่มข้อมูลสำเร็จ';
        } else {
            $result->msg = 'error';
            $result->msg_text = 'เกิดข้อผิดพลาดเกียวกับข้อมูล';
            getOutputJson($result);
            return;
        }
    } catch (Exception $e) {
        $result->msg = 'error';
        $result->msg_text = $e->getMessage();
        getOutputJson($result);
        return;
    }
}

if ($key !== null && $key === "delete_std") {

    $id_std = $_POST['id_std'];

    $sql =  "UPDATE `student` SET `status_std` = '0' WHERE `student`.`id_std` = $id_std";
    if (DB::query($sql)) {
        $result->msg = 'success';
        $result->msg_text = 'ลบข้อมูลสำเร็จ';
    } else {
        $result->msg = 'error';
        $result->msg_text = 'ลบข้อมูลไม่สำเร็จ';
        getOutputJson($result);
        return;
    }
}

if ($key !== null && $key === "edit_std") {
    $value = $_POST["data"];

    $id_std = $value["id_std"];
    $img_std = $value['img_stdEdit'];
    $code_std = $value['code_std'];
    $name_std = $value['name_std'];
    $tel_std = $value['tel_std'];
    $classroom_std = $value['classroom_std'];
    if ($code_std === '' || $name_std === '' || $tel_std === '' || $classroom_std === '') {
        $result->msg = 'error';
        $result->msg_text = "กรุณาตรวจสอบข้อมูล";
        getOutputJson($result);
        return;
    }
    $resulteSqlSearchCUS = DB::query("SELECT * FROM `student` where id_std =  '$id_std'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
    // SELECT * FROM `student` where id_std = 

    if ($img_std !== $resulteSqlSearchCUS->img_std) {
        // set path to image folder
        @unlink("../../images/" . $resulteSqlSearchCUS->img_std);
        $dataImage = new stdClass();
        $dataImage->path = "../../images/";
        $dataImage->base64_code = $img_std;

        $newDataImage = uploadeImageBase64($dataImage); //return stdClass msg,msg_text
        if ($newDataImage->msg === 'success') {
            $img_std = $newDataImage->nameImge;
        } else {
            getOutputJson($result);
            return;
        }
    }else{
        $img_std = $resulteSqlSearchCUS->img_std;
    }


    try {
        $sqlText = "UPDATE `student` SET `code_std` = '$code_std', 
        `name_std` = '$name_std', 
        `tel_std` = '$tel_std', 
        `classroom_std` = '$classroom_std', 
        `img_std` = '$img_std'  
        WHERE `student`.`id_std` = $id_std;";
        if (DB::query($sqlText)) {
            $result->msg = 'success';
            $result->msg_text = 'แก้ไขข้อมูลสำเร็จ';
        } else {
            $result->msg = 'error';
            $result->msg_text = 'เกิดข้อผิดพลาดเกี่ยวกับข้อมูล';
            getOutputJson($result);
            return;
        }
    } catch (Exception $e) {
        $result->msg = 'error';
        $result->msg_text = $e->getMessage();
        getOutputJson($result);
        return;
    }
}
getOutputJson($result);
