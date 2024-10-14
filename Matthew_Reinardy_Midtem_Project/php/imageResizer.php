<?php
/*This was a challenge getting to work, but I learned a lot trying to resize! I first ran into issues
with the file extension not being right. Then, I had to change some permissions on my laptop because I was saying that
permissions were denied when I was trying to change the filepath of the image. I used a very similar approach to how 
the example you showed us. I also looked into using the ImageMagic extension in the book as that seemed a lot easier, but this approach
allows for everyone to view it without it installed*/
function resize_image_gd($orig_path, $new_path, $max_width, $max_height)
{
    $image_data = getimagesize($orig_path);
    if (!$image_data) {
        die('Error: Unable to determine the image size or type.');
    }

    $orig_width = $image_data[0];
    $orig_height = $image_data[1];
    $media_type = $image_data['mime'];

    /*I was running into issues with the files being "WebP" extension even though it had the .jpeg extension. Who knew that doesn't
    necessarily change the file type, that has to be done by exporting the image*/
    //var_dump($media_type);

    // Calculate new size
    $ratio = $orig_width / $orig_height;
    if ($orig_width > $orig_height) {
        $new_height = $max_height;
        $new_width = $max_height * $ratio;
    } else {
        $new_width = $max_width;
        $new_height = $max_width / $ratio;
    }

    // Load image
    switch ($media_type) {
        case 'image/gif':
            $orig = imagecreatefromgif($orig_path);
            break;
        case 'image/jpeg':
            $orig = imagecreatefromjpeg($orig_path);
            break;
        case 'image/png':
            $orig = imagecreatefrompng($orig_path);
            break;
        default:
            die('Error: Unsupported image format: ' . $media_type);
    }

    if (!$orig) {
        die('Error: Failed to load the original image.');
    }

    // Create new blank image
    $new = imagecreatetruecolor($new_width, $new_height);

    // Resize the original image and copy it into the new image
    imagecopyresampled($new, $orig, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);

    // Save resized image in the destination path
    switch ($media_type) {
        case 'image/gif':
            imagegif($new, $new_path);
            break;
        case 'image/jpeg':
            imagejpeg($new, $new_path);
            break;
        case 'image/png':
            imagepng($new, $new_path);
            break;
        default:
            die('Error: Unsupported image format.');
    }
    return $new_path;
}
