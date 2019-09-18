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
    $idFile = $_SESSION['id'] + $formatedIndex;
    
    $prepare = $pdo->prepare(
        'UPDATE datafiles SET secondFileName = :secondFileName WHERE id = :id'
    );
    $prepare->bindValue('secondFileName', $newNameEnc);
    $prepare->bindValue('id', $idFile);
    $prepare->execute();