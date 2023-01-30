<?php
require_once '../config/connectdb.php';

$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key === null || $key !== "model_card") {
    exit;

}
$code_std = $_POST["code_std"] !== null ? $_POST["code_std"] : null;

$row = DB::Query("SELECT * FROM `student` WHERE code_std = '$code_std' AND status_std != 0", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

if (isset($row) && $row != null) :

?>

<img class="card-img-top rounded mx-auto d-block card-imgx"  src="../images/<?php echo $row->img_std?>">
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
</div>

<?php else:?>
<img class="card-img-top rounded mx-auto d-block card-imgx"  src="../images/client-img.png">
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