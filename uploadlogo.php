<?php
function Upload_Logo($logo_image)
{
    global $errors;
    $target_dir = "assets/images/logo/";
    $target_file = $target_dir.uniqid().time().basename($_FILES[$logo_image]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$logo_image]["tmp_name"]);
        if ($check !== false) {
            array_push($errors, "File is an image - " . $check["mime"] . ".");
            $uploadOk = 1;
        } else {
            array_push($errors, "فایل شما تصویر نیست");
            $uploadOk = 0;
        }
    }

// Check if file already exists
    if (file_exists($target_file)) {
        array_push($errors, "فایل انتخابی شما در سیستم موجود می باشد دوباره امتحان کنید");
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES[$logo_image]["size"] >  1048576) {
        array_push($errors, "حجم فایل شما نهایت باید یک مگابایت باشد");
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "svg") {
        array_push($errors, "فرمت فایل باید یکی از حالت های (svg png jpg gif jpeg) باشد ");
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        array_push($errors, "متاسفیم فایل شما اپلود نشد");
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES[$logo_image]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            array_push($errors, "در اپلود شما مشکلی رخ داد دوباره امتحان کنید");
        }
    }
}

?>

