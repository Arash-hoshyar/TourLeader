<?php

namespace Admin\Services\invokables;

class ImageService
{

    public function getImg(string $target_dir): string
    {
        $target_file = $target_dir . md5(time() . basename($_FILES["image"]["name"])) . $_FILES["image"]["name"];

        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "gif") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return $error;
        }

        if ($_FILES["image"]["size"] > 500000) {
            $error = "Sorry, your file is too large.";

            return $error;
        }

        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $logo = md5(time() . basename($_FILES["image"]["name"])) . $_FILES["image"]["name"];

        return $logo;
    }


}