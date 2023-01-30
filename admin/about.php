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
    <title>ข้อมูลส่วนตัว</title>
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

    <div class="contact_section_2 layout_padding">
        <div class="container">
            <h1 class="contact_taital">ข้อมูลส่วนตัว</h1>
        </div>
        <div class="contact_section_2 layout_padding">
            <div class="container">
                <div class="mail_section">
                    <div class="row">

                        <input type="text" disabled class="input_text" value="<?php echo $resultRowUser->name ?>">
                        <input type="email" disabled class="input_text" value="<?php echo $resultRowUser->email_ad ?>">

                        <input type="password" disabled class="input_text" value="****************">

                        <div class="send_bt">
                            <div class="send_text "><a class="bg-warning" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter">แก้ไข</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about section end -->
        <!-- service section start -->
        <!-- Modal -->

        <script>
            const submitFm_ad = () => {
                $('#fm-ad-edit').submit(function() {
                    var $inputs = $("#fm-ad-edit :input");
                    var values = {};
                    $inputs.each(function() {
                        values[this.name] = $(this).val();
                    });
                    // console.log(values);

                    Swal.fire({
                        title: 'ต้องการแก้ไขข้อมูล',
                        text: "โปรตรวจสอบข้อมูลให้ถูกต้อง!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'ต้องการแก้ไขหรือไม่!',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "./controllers/about.php",
                                type: "POST",
                                data: {
                                    key: "edit-admin",
                                    data: values
                                },
                                success: function(result, textStatus, jqXHR) {
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
                                }

                            });
                        }
                    })

                })
            }
        </script>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="fm-ad-edit" method="post" action="javascript:void(0)">
                        <input type="hidden" name="id_ad" value="<?php echo $resultRowUser->id_ad ?>" required>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลส่วนตัว</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="text" class="input_text" name="name" value="<?php echo $resultRowUser->name ?>" required>
                            <input type="email" class="input_text" name="email_ad" value="<?php echo $resultRowUser->email_ad ?>" required>

                            <input type="password" class="input_text" name="pass_ad" value="<?php echo $resultRowUser->pass_ad ?>" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                            <button type="submit" onclick="submitFm_ad();" class="btn btn-primary">บันทึก</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>





        <?php include_once("./foot.php"); ?>
</body>

</html>