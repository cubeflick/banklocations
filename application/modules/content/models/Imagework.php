<?php

class User_Model_Imageworkss extends App_Model_BaseModel {

public $upload_dir;
public $upload_path;
public $large_image_name;
public $thumb_image_name;
public $max_file;
public $max_width;
public $thumb_width;
public $thumb_height;

public function _init(){
    $upload_dir = "upload_pic"; 				// The directory for the images to be saved in
    $upload_path = $upload_dir."/";				// The path to where the image will be saved
    $large_image_name = "resized_pic.jpg"; 		// New name of the large image
    $thumb_image_name = "thumbnail_pic.jpg"; 	// New name of the thumbnail image
    $max_file = "1148576"; 						// Approx 1MB
    $max_width = "500";							// Max width allowed for the large image
    $thumb_width = "100";						// Width of thumbnail image
    $thumb_height = "100";
}

    public function resizeImage($image, $width, $height, $scale) {
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        $source = imagecreatefromjpeg($image);
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);
        imagejpeg($newImage, $image, 90);
        chmod($image, 0777);
        return $image;
    }
}

?>
