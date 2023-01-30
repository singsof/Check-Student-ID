<?php
require_once '../config/connectdb.php';

$key = $_POST["key"] !== "" ? $_POST["key"] : null;

$id_std = $_POST["id_std"] !== null ? $_POST["id_std"] : null;
if ($key === null || $key !== "model_card" || $id_std === null) {
    exit;
}
$row = DB::Query("SELECT * FROM `student` WHERE id_std = '$id_std' AND status_std != 0", PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

?>


<script>
    // const submitFormAdd = () => {
    $('.mGridEdit').submit(() => {
        var inputs = $(".mGridEdit  :input");
        var values = {};
        inputs.each(function() {
            values[this.name] = $(this).val();
        });
        console.log(values);
        $.ajax({
            url: "./controllers/add_std.php",
            type: "POST",
            data: {
                key: "edit_std",
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
                $('.mGridEdit').submit();
            }
            $next.focus().click();
        }



    });
</script>
<div style="padding: 20px;">
    <h2>แก้ไขข้อมูลนักเรียน</h2>
    <form class="mGridEdit" id="" method="post" action="javascript:void(0)">
        <input type="hidden" disabled name="id_std" value="<?php echo $row->id_std ?>">
        <div class="form-group">
            <label>รูปประจำตัว</label>
            <input id="img_std" type="hidden" name="img_stdEdit" value="<?php echo $row->img_std ?>">
            <input id="input_imageEdit" type="file" accept="image/*" class="form-control-file" onclick="ClickImg()">
        </div>
        <div class="form-group">
            <img id="img_showEdit" src="../images/<?php echo $row->img_std ?>" width="200px" height="200px">
        </div>
        <script>
            const ClickImg = () => {
                // get a reference to the file input
                const imageElementEdit = document.querySelector("img[id=img_showEdit]");
                let base64StringImg_showEdit = null;
                // get a reference to the file input
                const fileInputEdit = document.querySelector("input[id=input_imageEdit]");

                let canvasx;
                // listen for the change event so we can capture the file
                fileInputEdit.addEventListener("change", (e) => {
                    // get a reference to the file
                    const filex = e.target.files[0];

                    const readerx = new FileReader();
                    readerx.onloadend = (e) => {
                        let imgx = document.createElement("img");
                        imgx.onload = function(event) {
                            // Dynamically create a canvas element
                            let canvasx = document.createElement("canvas");
                            canvasx.width = 600;
                            canvasx.height = 600;
                            // let canvas = document.getElementById("canvas");
                            let ctxx = canvasx.getContext("2d");
                            // Actual resizing
                            ctxx.drawImage(imgx, 0, 0, canvasx.width, canvasx.height);

                            // Show resized image in preview element
                            let dataurlx = canvasx.toDataURL(filex.type);
                            // document.getElementById("preview").src = dataurl;
                            imageElementEdit.src = dataurlx;

                            // console.log(dataurl.replace(/^data:image\/(png|jpg);base64,/, ""));
                            const base64String_x = dataurlx
                                .replace("data:", "")
                                .replace(/^.+,/, "");
                            base64StringImg_showEdit = base64String_x;

                            $("#img_std").val(base64StringImg_showEdit);
                            console.log(base64StringImg_showEdit);
                        }
                        imgx.src = e.target.result;
                    };
                    readerx.readAsDataURL(filex);
                });
            }
        </script>
        <div class="form-group">
            <label for="">รหัสเรียน *</label>
            <input type="number" disabled value="<?php echo $row->code_std ?>" class="form-control" id="" name="code_std" aria-describedby="" placeholder="รหัสเรียน" autofocus="autofocus" tabIndex="1" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <div class="form-group">
            <label for="">ชื่อ - สกุล *</label>
            <input type="text" value="<?php echo $row->name_std ?>" class="form-control" id="" name="name_std" aria-describedby="" placeholder="ชื่อ - สกุล" tabIndex="2" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <div class="form-group">
            <label for="">เบอร์โทร *</label>
            <input type="tel" value="<?php echo $row->tel_std ?>" class="form-control" name="tel_std" id="" aria-describedby="" placeholder="เบอร์โทร" tabIndex="3" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <div class="form-group">
            <label for="">ระดับชั้น *</label>
            <input type="text" value="<?php echo $row->classroom_std ?>" class="form-control" name="classroom_std" id="" aria-describedby="" placeholder="ระดับชั้น" tabIndex="4" required>
            <small id="" class="form-text text-muted">กรองข้อมูลให้ถูกต้อง</small>
        </div>
        <button type="submit" class="btn btn-sm btn-success">แก้ไขข้อมูล</button>
    </form>
</div>

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