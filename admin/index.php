<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>ประวัติการ เข้า - ออก ห้องระบบปฏิบัติการ ICT</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include_once("./link.php");



    ?>

</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="">
            <?php include_once("./nav.php"); ?>
        </div>
    </div>

    <div class="project_section layout_padding">
        <div class="container">
            <h1 class="project_taital">ประวัติการ เข้า - ออก ห้องระบบปฏิบัติการ ICT</h1>
        </div>
        <div class="project_section layout_padding" style="padding-bottom: 70px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="d-flex justify-content-between" style="margin-bottom: 20px;">
                            <div class="">
                                <?php

                                $date_Start = isset($_GET["Start"]) ? $_GET["Start"] : date("Y-m-d", strtotime("-90 days"));
                                $date_End = isset($_GET["End"]) ? $_GET["End"] : date("Y-m-d", strtotime("now"));

                                $sqlTxt = "SELECT * FROM `record` as re INNER JOIN student as std ON std.id_std = re.id_std WHERE  re.tin_hi between '$date_Start 00:00:00' AND '$date_End 23:59:00' AND status_std != 0 ORDER BY re.tin_hi DESC Limit 500;";

                                ?>
                                <form id="form-hi" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">ค้นหาช่วงเวลา</span>
                                        </div>
                                        <input id="Start" type="date" class="form-control" name="Start" required value="<?php echo $date_Start; ?>">
                                        <div style="font-size: 1.3em; margin-left: 5px; margin-right: 5px;"> To </div>
                                        <input id="End" type="date" class="form-control" name="End" required value="<?php echo $date_End;  ?>">
                                        <div class="input-group-prepend">
                                            <button type="submit" class="btn btn-primary">ค้นหา</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="">
                                <button type="button" onclick="nextDate('1')" class="btn btn-lg btn-outline-warning">รายสัปดาห์</button>&nbsp;&nbsp;&nbsp;
                                <button type="button" onclick="nextDate('2')" class="btn btn-lg btn-outline-info">รายเดือน</button>&nbsp;&nbsp;&nbsp;
                                <button type="button" onclick="nextDate('3')" class="btn btn-lg btn-outline-danger">รายภาคเรียน</button>&nbsp;&nbsp;&nbsp;
                            </div>
                        </div>

                        <script>
                            const nextDate = (key) => {
                                // var new Date() = new Date();
                                let date_now = formatDate(new Date());

                                switch (key) {
                                    case '1':
                                        let dw = new Date(); // วันนี้
                                        dw.setDate(dw.getDate() - 7); // วันก่อนหน้า
                                        $("#Start").val(formatDate(dw));
                                        break;
                                    case '2':
                                        let dm = new Date(); // วันนี้
                                        dm.setMonth(dm.getMonth() - 1); // สำหรับเดือน
                                        $("#Start").val(formatDate(dm));
                                        break;
                                    case '3':
                                        let dy = new Date(); // วันนี้
                                        dy.setFullYear(dy.getFullYear() - 1); // สำหรับปี
                                        $("#Start").val(formatDate(dy));
                                        break;
                                }

                                $("#End").val(date_now);
                                $("#form-hi").submit();

                            }
                        </script>

                        <div id="showData" class="table-responsive">
                            <table id="stdHiTabable" class="table table-striped table-borderless table-hover ">
                                <thead  class="thead-dark">
                                    <tr>
                                        <th scope="col">ลำดับ</th>
                                        <th scope="col">รหัสเรียน</th>
                                        <th scope="col">ชื่อ - สกุล</th>
                                        <th scope="col">เข้า</th>
                                        <th scope="col">ออก</th>
                                        <th scope="col">รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach (DB::Query($sqlTxt, PDO::FETCH_OBJ) as $rowT) :
                                    ?>
                                        <tr>
                                            <td scope="row"><?php echo $i++ ?></td>
                                            <td><?php echo  $rowT->code_std ?> </td>
                                            <td><?php echo  $rowT->name_std ?></td>
                                            <td>
                                                <?php
                                                echo thaidate('D j M y  G:i น.', $rowT->tin_hi);

                                                ?></td>
                                            <td><?php
                                                echo  $rowT->tout_hi === null ? " - " : thaidate('D j M y  G:i น.', $rowT->tout_hi) ?></td>

                                            <td><button onclick="updateCard('<?php echo $rowT->code_std ?>',<?php echo $rowT->id_hi ?>)" type="button" class="btn btn-outline-primary btn-sm">รายละเอียด</button>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <script>
                            const updateCard = (code_std, id_hi) => {
                                $.ajax({
                                    url: "./model_card.php",
                                    type: "POST",
                                    data: {
                                        key: "model_card",
                                        code_std: code_std,
                                        id_hi: id_hi
                                    },
                                    success(results) {
                                        $("#cardex").html(results);
                                    },
                                    error() {

                                    }
                                });
                            }
                        </script>
                    </div>
                    <style>
                        .card-imgx {
                            width: 200px;
                            height: 200px;
                            margin-top: 50px;

                        }
                    </style>
                    <div class="col-sm-4" style="margin-top: 60px;">
                        <div id="cardex" class="card" style="display: block; height: 700px;">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about section end -->
    <!-- service section start -->
    <script>
        $(document).ready(function() {
            // alert("test")
            $('#stdHiTabable').DataTable({
                "dom": 'IBfrtip',
                // lBfrtip
                lengthMenu: [
                    [10, 25, 50, 60, -1],
                    [10, 25, 50, 60, "All"]
                ],
                language: {
                    sProcessing: " กำลังดำเนินการ...",
                    sLengthMenu: " แสดง  _MENU_  แถว ",
                    sZeroRecords: " ไม่พบข้อมูล ",
                    sInfo: " แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว ",
                    sInfoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
                    sInfoFiltered: "( กรองข้อมูล  _MAX_  ทุกแถว )",
                    sInfoPostFix: "",
                    sSearch: "ค้นหา:",
                    sUrl: "",
                    oPaginate: {
                        "sFirst": " เริ่มต้น ",
                        "sPrevious": " ก่อนหน้า ",
                        "sNext": " ถัดไป ",
                        "sLast": " สุดท้าย "
                    }
                }, // sInfoEmpty: "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                processing: true,
                buttons: [{
                    extend: 'excel',
                    text: 'ส่งออก EXCEL',
                    messageTop: '',
                    filename: function() {
                        return "ประวัติการ เข้า - ออก ห้องระบบปฏิบัติการ ICT";
                    },
                }, {
                    extend: 'print',
                    text: 'พิมพ์',
                }],
                retrieve: true,

            });
        });
    </script>




    <?php include_once("./foot.php"); ?>
</body>

</html>