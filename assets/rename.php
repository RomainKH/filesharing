<?php
    include 'config.php';
    include 'functions.php';

    $uniqName = $_POST['name'];
    $newName = $_POST['newNameFile'];
    $index = $_POST['index'];
    $old = $_SESSION['old'];
    $formatedIndex = str_replace('__', '', $index);
    $_SESSION['name'][$formatedIndex] = $newName;
    echo $newName;
    $newNameEnc = encrypt_decrypt('encrypt',$newName);
    $uniqEnc = hash('ripemd160',$uniqName.$index);
    
    $prepare = $pdo->prepare(
        'UPDATE datafiles SET secondFileName = :secondFileName WHERE firstFileName = :firstFileName'
    );
    $prepare->bindValue('secondFileName', $newNameEnc);
    $prepare->bindValue('firstFileName', $uniqEnc);
    $prepare->execute();
    $everyFilesName = array();
    $realNames = array();
    $uniqId = $_SESSION['access'][0];
    for ($i=0; $i < count($_SESSION['name']); $i++) { 
        $destination = '../uploads/'.$old;
        array_push($everyFilesName, '../uploads/'.$old.'/'.$_SESSION['access'][0].'__'.$i.'.'.$_SESSION['ext'][$i]);
        array_push($realNames, $_SESSION['name'][$i].'.'.$_SESSION['ext'][$i]);
    }
    
    if (count($everyFilesName) > 1) {
        zipMultiFile($everyFilesName,$uniqId,$destination,$realNames);
        $deleteZip = '../uploads/'.$old.'/'.$_SESSION['access'][0].'.zip';
        unlink($deleteZip);
        zipMultiFile($everyFilesName,$uniqId,$destination,$realNames);
    }