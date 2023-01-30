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
    <title>ข้อมูลนักเรียน</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">


    <?php include_once("./link.php"); ?>

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
            <h1 class="project_taital">ข้อมูลนักเรียน</h1>
        </div>
        <div class="project_section layout_padding" style="padding-bottom: 70px;">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="d-flex justify-content-between" style="margin-bottom: 20px;">
                            <div class="">


                            </div>
                            <div class="">
                                <button type="button" onclick="addStdCard()" class="btn btn-sm btn-outline-warning">เพิ่มข้อมูลนักเรียน</button>
                            </div>
                        </div>


                        <table id="stdHiTabable" class="table table-striped table-borderless ">
                            <thead  class="thead-dark">
                                <tr>
                                    <th scope="col">ลำดับ</th>
                                    <th scope="col">รหัสเรียน</th>
                                    <th scope="col">ชื่อ - สกุล</th>
                                    <th scope="col">ชั้น</th>
                                    <th scope="col">เบอร์</th>
                                    <th scope="col">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $inm = 1;

                                foreach ($row = DB::Query("SELECT * FROM `student` WHERE status_std != 0 ORDER BY code_std ASC ", PDO::FETCH_OBJ) as $student) :

                                ?>
                                    <tr>
                                        <td scope="row"><?php echo $inm++; ?></td>
                                        <td><?php echo $student->code_std ?></td>
                                        <td><?php echo $student->name_std ?></td>
                                        <td><?php echo $student->classroom_std ?></td>
                                        <td><?php echo $student->tel_std ?></td>
                                        <td><button onclick="updateCard('<?php echo $student->code_std ?>')" type="button" class="btn btn-outline-primary btn-sm">วิว</button>
                                            <button onclick="EditStdCard('<?php echo $student->id_std ?>')" type="button" class="btn btn-outline-warning btn-sm">แก้ไข</button>
                                            <button onclick="DeleteStdCard('<?php echo $student->id_std ?>')" type="button" class="btn btn-danger btn-sm">ลบ</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <div id="cardex" class="card" style="display: block; height: 700px;">


                        </div>

                        <script>
                            const updateCard = (code_std) => {
                                $.ajax({
                                    url: "./model_card_std.php",
                                    type: "POST",
                                    data: {
                                        key: "model_card",
                                        code_std: code_std
                                    },
                                    success(results) {
                                        $("#cardex").html(results);

                                    },
                                    error() {

                                    }
                                });
                            }
                            const addStdCard = () => {
                                $.ajax({
                                    url: "./model_add_std.php",
                                    type: "POST",
                                    data: {
                                        key: "model_card",
                                    },
                                    success(results) {
                                        $("#cardex").html(results);

                                    },
                                    error() {

                                    }
                                });
                            }
                            const EditStdCard = (id) => {
                                $("#cardex").empty();
                                $("#cardex").html('');
                                $.ajax({
                                    url: "./model_edit_std.php",
                                    type: "POST",
                                    data: {
                                        key: "model_card",
                                        id_std: id
                                    },
                                    success(results) {
                                        $("#cardex").html(results);

                                    },
                                    error() {

                                    }
                                });
                            }
                            const DeleteStdCard = (id) => {



                                Swal.fire({
                                    title: 'ต้องการลบข้อมูล',
                                    text: "คุณจะเปลี่ยนกลับไม่ได้!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'ใช้ต้องการลบ!',
                                    cancelButtonText: 'ยกเลิก'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: "./controllers/add_std.php",
                                            type: "POST",
                                            data: {
                                                key: "delete_std",
                                                id_std: id
                                            },
                                            success(result) {
                                                console.log(result);
                                                const obj = JSON.parse(result);
                                                if (obj.msg === "success") {
                                                    Swal.fire({
                                                        position: 'center',
                                                        icon: 'success',
                                                        title: obj.msg_text,
                                                        showConfirmButton: false,
                                                        timer: 1000
                                                    });
                                                    setTimeout(function() {
                                                        location.reload()
                                                    }, 1200);
                                                } else if (obj.msg === "error") {
                                                    Swal.fire({
                                                        position: 'center',
                                                        icon: 'error',
                                                        title: obj.msg_text,
                                                        showConfirmButton: false,
                                                        timer: 1000
                                                    })
                                                    setTimeout(function() {
                                                        location.reload()
                                                    }, 1200);
                                                } else {
                                                    Swal.fire({
                                                        position: 'center',
                                                        icon: 'error',
                                                        title: obj.msg_text,
                                                        showConfirmButton: false,
                                                        timer: 1000
                                                    })
                                                    setTimeout(function() {
                                                        location.reload()
                                                    }, 1200);
                                                }

                                            },
                                            error() {

                                            }
                                        });
                                    }
                                })

                            }
                            addStdCard();
                        </script>
                        <!-- </div> -->

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
                "dom": 'Bfrtip',
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
                        return "ข้อมูลนักเรียน";
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