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
    <title>เข้าสู้ระบบ</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="../../css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../../images/phoxix.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../../css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="../../css/owl.carousel.min.css">
    <link rel="stylesoeet" href="../../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/scriptpage.js"></script>
    <script src="../../js/jquery-3.0.0.min.js"></script>


</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="">
            <nav class="navbar navbar-expand-lg navbar-light bg-com">
                <a class="logo" href="./index.php"><img src="../../images/logo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="./">หน้าหลัก</a>
                        </li>
                    </ul>

                </div>
            </nav>
        </div>
    </div>
    <!-- header section end -->
    <!-- contact section start -->
    <div class="contact_section layout_padding">
        <div class="container">
            <h1 class="contact_taital">สำหรับผู้ดูแลระบบ</h1>
        </div>
        <div class="contact_section_2 layout_padding">
            <div class="container">
                <form id="form-login-admin" action="javascript:void(0)" method="post">
                    <div class="mail_section">
                        <input type="email" class="input_text" placeholder="E-mail" name="email">
                        <input type="password" class="input_text" placeholder="Password" name="pass">
                        <div class="send_bt">
                            <div class="send_text"><button type="submit" class="btn btn-sm">เข้าสู้ระบบ</button></div>
                        </div>
                    </div>
                </form>

            </div>

            <script>
                $("#form-login-admin").submit(function() {
                    // alert("Login successful!");

                    var $inputs = $("#form-login-admin :input");
                    var values = {};
                    $inputs.each(function() {
                        values[this.name] = $(this).val();
                    });
                    // console.log(values);
                    $.ajax({
                        url: "./controllers/auth.php",
                        type: "POST",
                        data: {
                            key: "login-admin",
                            data: values
                        },
                        success: function(result, textStatus, jqXHR) {
                            console.log(result);
                            const obj = JSON.parse(result);
                            if (obj.msg === "success") {
                                alert("ยินดีตอนรับเข้าสู่ระบบ");
                                location.assign("../")
                            } else if (obj.msg === "error") {
                                alert(obj.msg_text);
                            } else {
                                alert(obj.msg_text);
                            }
                        }

                    });
                })
            </script>
        </div>
    </div>
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">Copyright 2019 All Right Reserved By.<a href="../../">เข้าห้อง</p>
        </div>
    </div>

    <script src="../../js/popper.min.js"></script>
    <script src="../../js/bootstrap.bundle.min.js"></script>
    <script src="../../js/plugin.js"></script>
    <!-- sidebar -->
    <script src="../../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../../js/custom.js"></script>
    <!-- javascript -->
    <script src="../../js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>