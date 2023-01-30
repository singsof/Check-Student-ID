<?php


require_once '../config/connectdb.php';
include_once(__DIR__ . "/../thaidate/function.php");
include_once(__DIR__ . "/../thaidate/Thaidate.php");
// require_once __DIR__.'../thaidate/Thaidate.php';
// require_once __DIR__.'../thaidate/function.php';

// $_SESSION["auth"] = true;
// $_SESSION["key"] = "admin";
// $_SESSION["id"] = $row->id_ad;
if ((!isset($_SESSION["auth"])) || isset($_SESSION["key"]) && $_SESSION["key"] !== 'admin') {

    $result = new stdClass();
    $result->msg = 'error';
    $result->msg_text = 'เกิดข้อผิดพลาดจัดการสิทธิ์';
    // getOutputJson($result);
    echo "<script>window.history.back(-1);</script>";

    exit;
}

$ID_USER = isset($_SESSION["id"]) ? $_SESSION["id"] : null;
$resultRowUser = DB::query("SELECT * FROM `admin` WHERE id_ad = '$ID_USER'", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);


// $key = $_POST["key"] !== "" ? $_POST["key"] : null;
// if ($key === null || $key !== "model_tbody") {
//     exit;

// }


?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.css" /> -->

<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

<!-- style css -->
<link rel="stylesheet" type="text/css" href="../css/style.css">
<!-- Responsive-->
<link rel="stylesheet" href="../css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="../images/phoxix.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
<!-- owl stylesheets -->
<link rel="stylesheet" href="../css/owl.carousel.min.css">
<link rel="stylesoeet" href="../css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="../js/jquery-3.0.0.min.js"></script>
<script src="../js/jquery.min.js"></script>


<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.js"></script> -->


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

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<style>
    .card-imgx {
        width: 200px;
        height: 200px;
    }
</style>

<script>
    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
    }

    function formatDate(date) {
        return [
            date.getFullYear(),
            padTo2Digits(date.getMonth() + 1),
            padTo2Digits(date.getDate())
        ].join('-');
    }
</script>