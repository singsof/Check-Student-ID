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
    <title>เข้า-ออกห้องระบบปฏิบัติการ ICT</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" /> -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="./css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="./images/phoxix.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="./css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesoeet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <script src="/js/jquery.min.js"></script>

    <link rel="stylesheet" href="/js/dataTable/datatables.min.css">
    <script type="text/javascript" charset="utf8" src="/js/dataTable/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/dataTable/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="/js/dataTable/datatables.min.js"></script>

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="">

        </div>
    </div>
    <!-- header section end -->
    <!-- project section start -->
    <div class="project_section">
        <div class="container" style="padding-top: 15px;">
            <h1 class="project_taital">เข้า-ออกห้องระบบปฏิบัติการ ICT</h1>
        </div>
        <div class="project_section " style="padding-bottom: 70px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-8">
                        <form id="form-record" class="form-horizontal" role="form" action="javascript::void(0)" method="post">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" autofocus="autofocus" placeholder="กรอกรหัสนักเรียน" aria-label="กรอกรหัสนักเรียน" name="std-id" aria-describedby="button-addon2" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">เข้าห้อง</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            $("#form-record").submit(function() {
                                let stdID = $("input[name='std-id']").val();

                                $.ajax({
                                    url: "./controllers/record.php",
                                    type: "POST",
                                    data: {
                                        key: "form-record",
                                        std_ID: stdID
                                    },
                                    success(results) {
                                        console.log(results);
                                        // console.log(result);
                                        const obj = JSON.parse(results);
                                        if (obj.msg === "success-out") {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: obj.msg_text,
                                                showConfirmButton: false,
                                                timer: 700
                                            })
                                        } else if (obj.msg === "success-in") {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: obj.msg_text,
                                                showConfirmButton: false,
                                                timer: 700
                                            })
                                            // alert(obj.msg_text);
                                        } else if (obj.msg === "error") {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'error',
                                                title: obj.msg_text,
                                                showConfirmButton: false,
                                                timer: 700
                                            })
                                        } else {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'error',
                                                title: 'obj.msg_text',
                                                showConfirmButton: false,
                                                timer: 700
                                            })
                                        }
                                        updateTable();
                                        updateCard(stdID)
                                    },
                                    error() {

                                    }
                                });
                                $("#form-record").trigger('reset');

                            });
                        </script>
                        <div id="stdHiTabableDiv">

                        </div>



                    </div>
                    <div class="col-sm-4" style="margin-top: 60px;">
                        <div id="cardex" class="card" style="display: block; height: 700px;">


                        </div>

                        <script>
                            const updateCard = (code_std) => {
                                $.ajax({
                                    url: "./model_card.php",
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
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* footer {
            position: fixed;
            height: 100px;
            bottom: 0;
            width: 100%;
        } */
    </style>
    <footer class="fixed-bottom">
        <div class="copyright_section">
            <div class="container">
                <p class="copyright_text" style="margin: 2px;">Copyright 2019 All Right Reserved By.<a href="./admin/auth/">
                        for admin</p>
            </div>
        </div>
    </footer>

    <script>
        // $(document).ready(function () {
        // alert("test")
        const updateTablex = () => {
            $('#stdHiTabable').DataTable({
                "dom": 'Bfrtip',
                "paging": true,
                "ordering": false,
                "info": true,
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
                buttons: [],
                // autoFill: true,
                // retrieve: true,
            });
        }
        updateTablex();
        // });
    </script>
    <script>
        const updateTable = () => {
            $.ajax({
                url: "./model_tbody.php",
                type: "POST",
                data: {
                    key: "model_tbody"
                },
                success(results) {
                    $("#stdHiTabableDiv").html(results);
                    updateTablex();
                },
                error() {

                }
            });

        }
        updateTable();
    </script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery-3.0.0.min.js"></script>
    <script src="./js/plugin.js"></script>
    <!-- sidebar -->
    <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="./js/custom.js"></script>
    <!-- javascript -->
    <script src="./js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>