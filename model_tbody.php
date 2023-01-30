<?php
require_once './config/connectdb.php';

include_once(__DIR__ . "/thaidate/function.php");
include_once(__DIR__ . "/thaidate/Thaidate.php");

$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key === null || $key !== "model_tbody") {
    exit;
}

?>
<div class="">
    <table id="stdHiTabable" class="table table-striped table-borderless ">
        <thead  class="thead-dark">
            <tr>
                <th scope="col">ลำดับ</th>
                <th scope="col">รหัสเรียน</th>
                <th scope="col">ชื่อ - สกุล</th>
                <th scope="col">เข้า</th>
                <th scope="col">ออก</th>
                <th scope="col">หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach (DB::Query("SELECT * FROM `record` as re INNER JOIN student as std ON std.id_std = re.id_std ORDER BY re.tin_hi DESC Limit 50;", PDO::FETCH_OBJ) as $rowT) :
            ?>
                <tr>
                    <td><?php echo $i++ ?></td>
                    <td><?php echo  $rowT->code_std ?> </td>
                    <td><?php echo  $rowT->name_std ?></td>
                    <td><?php echo  thaidate('D j M y  G:i น.', $rowT->tin_hi) ?></td>
                    <td><?php echo  $rowT->tout_hi === null ? " - " : thaidate('D j M y  G:i น.', $rowT->tout_hi )?></td>
                    <td><?php echo  $rowT->tout_hi === null ? "อยู่ในห้อง" : "ออกแล้ว" ?></td>
                </tr>
            <?php
            endforeach;
            ?>

        </tbody>
    </table>
</div>