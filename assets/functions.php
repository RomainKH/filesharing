<?php
  function delete_older_than($dir, $max_age) {
    $list = array();
    $limit = time() - $max_age;
    $dir = realpath($dir);
    if (!is_dir($dir)) {
      return;
    }
    $dh = opendir($dir);
    if ($dh === false) {
      return;
    }
    while (($file = readdir($dh)) !== false) {
      $file = $dir . '/' . $file;
      if (!is_file($file)) {
        continue;
      }
      if (filemtime($file) < $limit) {
        $list[] = $file;
        unlink($file);
      }
    }
    closedir($dh);
    return $list;
  }

  function checkFilesToDelete() {
    delete_older_than('../uploads/24hrs', 3600*24);
    delete_older_than('../uploads/2j', 3600*24*2);
    delete_older_than('../uploads/1s', 3600*24*7);
    delete_older_than('../uploads/2s', 3600*24*14);
  }

  function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "cast5-cbc";
    $secret_key = 'Thi@s#8is*my-sec%£9ret)k5§ey';
    $secret_iv = 'T%^$&mhis^mm^&03is39§mysecretiv';
    // hash
    $key = hash('crc32', $secret_key);
    // iv
    $iv = substr(hash('crc32', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
  }

  function reArrayFiles($file) {
    $array = array();
    $file_count = count($file['name']);
    $keys = array_keys($file);

    for ($i=0; $i < $file_count; $i++) { 
      foreach ($keys as $key) {
        $array[$i][$key] = $file[$key][$i];
      }
    }
    return $array;
  }
  
  function thumbGenerator($dir,$tmpName,$fileType){
    $saveFileType = ".png";
    $imagePath = $dir.$tmpName.".".$fileType;
    $image = new Imagick();
    $image->readimage($imagePath);
    if($fileType == "psd"){
        $image->setIteratorIndex(0);
    }
    $dimensions = $image->getImageGeometry();
    $width = $dimensions['width'];
    $height = $dimensions['height'];
    $maxWidth = 720;
    $maxHeight = 720;
    if($height > $width){
        //Portrait
        if($height > $maxHeight)
            $image->thumbnailImage(0, $maxHeight);
            $dimensions = $image->getImageGeometry();
            if($dimensions['width'] > $maxWidth){
                $image->thumbnailImage($maxWidth, 0);
            }
    }elseif($height < $width){
        //Landscape
        $image->thumbnailImage($maxWidth, 0);
    }else{
        //square
        $image->thumbnailImage($maxWidth, 0);
    }
    $image->writeImage($dir . $tmpName.$saveFileType);
  }