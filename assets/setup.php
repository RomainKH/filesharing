<?php


    // Here you can write your domain name so it updates everywehre in the files and don't cause bug 

    $path = '/filesharing/';
    $domain = "http://".$_SERVER['HTTP_HOST'].$path;

    // Maximum size to display files, if superior to this, doesn't display

    $totalLimitUpload = 2000000000; // limit set to the maximum size that can be upload
    $maxSizeDisplayFile = 1000000000; // but it can display up to 1gb file (img, code...)
    // 1000000 = 1mb
    // you also need to change the warning limit in index.js in order not to show the "file is too big"