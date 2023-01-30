<?php
require_once '../config/connectdb.php';
include_once(__DIR__ . "/../thaidate/function.php");
include_once(__DIR__ . "/../thaidate/Thaidate.php");
$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key === null || $key !== "model_card") {
    exit;

}
$code_std = $_POST["code_std"] !== null ? $_POST["code_std"] : null;
$id_hi = $_POST["id_hi"] !== null ? $_POST["id_hi"] : null;

$row = DB::Query("SELECT * FROM `student` WHERE code_std = '$code_std'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
$rowHi = DB::Query("SELECT * FROM `record` WHERE id_hi = '$id_hi'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

if (isset($row) && $row != null) :

?>

<img class="card-img-top rounded mx-auto d-block card-imgx" src="../images/<?php echo $row->img_std?>">
<div class="card-body">
    <h6 class="card-title">ข้อมูลนักเรียน</h6>
    <div class="row">
        <div class="col-4 text-right">
            <h6>รหัสเรียน : </h6>
        </div>
        <div class="col-8 ">
            <h5><?php echo $row->code_std ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>ชื่อ - สกุล : </h6>
        </div>
        <div class="col-8 ">
            <h5><?php echo $row->name_std ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>ชั้น : </h6>
        </div>
        <div class="col-8 ">
            <h5><?php echo $row->classroom_std ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>เบอร์ : </h6>
        </div>
        <div class="col-8 ">
            <h5><?php echo $row->tel_std ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>เวลาเข้า : </h6>
        </div>
        <div class="col-8 ">
            <h5><?php echo thaidate('D j M y G:i น.', $rowHi->tin_hi); ?></h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>เวลาออก : </h6>
        </div>
        <div class="col-8 ">
            <h5><?php echo  $rowHi->tout_hi === null ? " - " : thaidate('D j M y  G:i น.', $rowHi->tout_hi) ?></h5>
        </div>
    </div>
</div>

<?php else:?>
<img class="card-img-top rounded mx-auto d-block card-imgx" src="../images/phoxix.png">
<div class="card-body">
    <h6 class="card-title">ข้อมูลนักเรียน</h6>
    <div class="row">
        <div class="col-4 text-right">
            <h6>รหัสเรียน : </h6>
        </div>
        <div class="col-8 ">
            <h5>ไม่พบข้อมูล</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>ชื่อ - สกุล : </h6>
        </div>
        <div class="col-8 ">
            <h5>ไม่พบข้อมูล</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>ชั้น : </h6>
        </div>
        <div class="col-8 ">
            <h5>ไม่พบข้อมูล</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4 text-right">
            <h6>เบอร์ : </h6>
        </div>
        <div class="col-8 ">
            <h5>ไม่พบข้อมูล</h5>
        </div>
    </div>
</div>

<?php endif;?>

<style>
    .card-imgx {
        width: 200px;
        height: 200px;
        margin-top: 50px;

    }
</style>