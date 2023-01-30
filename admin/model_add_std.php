<?php
require_once '../config/connectdb.php';

$key = $_POST["key"] !== "" ? $_POST["key"] : null;
if ($key === null || $key !== "model_card") {
    exit;
}
?>

<script>
    // const submitFormAdd = () => {
    $('.mGrid').submit(() => {
        var inputs = $(".mGrid  :input");
        var values = {};
        inputs.each(function() {
            values[this.name] = $(this).val();
        });
        console.log(values);
        $.ajax({
            url: "./controllers/add_std.php",
            type: "POST",
            data: {
                key: "add_std",
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
                    setTimeout(function(){location.reload()}, 1200);
                } else if (obj.msg === "error") {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 1000
                    })
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: obj.msg_text,
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {

            }

        });
    });
    // }
    $(document).on('keypress', 'input,select', function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
            console.log($next.length);
            if (!$next.length) {
                // $next = $('[tabIndex=1]');
                // alert("subb")
                $('.mGrid').submit();
            }
            $next.focus().click();
        }



    });
</script>
<div style="padding: 20px;">
    <h2>เพิ่มข้อมูลนักเรียน</h2>
    <form class="mGrid" id="" method="post" action="javascript:void(0)">

        <div class="form-group">
            <label>รูปประจำตัว</label>
            <input id="img_std" type="hidden" name="img_std" value="">
            <input id="input_image" type="file" accept="image/*" class="form-control-file" onclick="ClickImgAdd()">
        </div>
        <div class="form-group">
            <img id="img_show" src="../images/phoxix.png" width="200px" height="200px">
        </div>
        <script>
            const ClickImgAdd = () => {// get a reference to the file input
            const imageElement = document.querySelector("img[id=img_show]");
            var base64StringImg_show = null;
            // get a reference to the file input
            const fileInput = document.querySelector("input[id=input_image]");

            var canvas;
            // listen for the change event so we can capture the file
            fileInput.addEventListener("change", (e) => {
                // get a reference to the file
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.onloadend = (e) => {
                    var img = document.createElement("img");
                    img.onload = function(event) {
                        // Dynamically create a canvas element
                        var canvas = document.createElement("canvas");
                        canvas.width = 600;
                        canvas.height = 600;
                        // var canvas = document.getElementById("canvas");
                        var ctx = canvas.getContext("2d");
                        // Actual resizing
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

                        // Show resized image in preview element
                        var dataurl = canvas.toDataURL(file.type);
                        // document.getElementById("preview").src = dataurl;
                        imageElement.src = dataurl;

                        // console.log(dataurl.replace(/^data:image\/(png|jpg);base64,/, ""));
                        const base64String_ = dataurl
                            .replace("data:", "")
                            .replace(/^.+,/, "");
                        base64StringImg_show = base64String_;

                        $("#img_std").val(base64StringImg_show);
                        console.log(base64StringImg_show);
                    }
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            });}
        </script>
        <div class="form-group">
            <label for="">รหัสเรียน *</label>
            <input type="number" class="form-control" id="" name="code_std" aria-describedby="" placeholder="รหัสเรียน" autofocus="autofocus" tabIndex="1" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <div class="form-group">
            <label for="">ชื่อ - สกุล *</label>
            <input type="text" class="form-control" id="" name="name_std" aria-describedby="" placeholder="ชื่อ - สกุล" tabIndex="2" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <div class="form-group">
            <label for="">เบอร์โทร *</label>
            <input type="tel" class="form-control" name="tel_std" id="" aria-describedby="" placeholder="เบอร์โทร" tabIndex="3" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <div class="form-group">
            <label for="">ระดับชั้น *</label>
            <input type="text" class="form-control" name="classroom_std" id="" aria-describedby="" placeholder="ระดับชั้น" tabIndex="4" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <button type="submit" class="btn btn-sm btn-success">เพิ่มข้อมูล</button>
        <button type="reset" class="btn btn-sm btn-warning">ล้างข้อมูล</button>
    </form>
</div>

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>