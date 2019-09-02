<?php
// include functions
include 'config.php';
include 'functions.php';
$_SESSION['previous_location'] = 'post';
$error = '';
// files & db to delete
checkFilesToDelete();
$prepare = $pdo->prepare(
  " DELETE FROM datafiles WHERE createdAt < NOW() - INTERVAL 1.5 DAY AND expiration = '24hrs' "
);
$prepare->execute();
$prepare = $pdo->prepare(
  " DELETE FROM datafiles WHERE createdAt < NOW() - INTERVAL 2.5 DAY AND expiration = '2j' "
);
$prepare->execute();
$prepare = $pdo->prepare(
  " DELETE FROM datafiles WHERE createdAt < NOW() - INTERVAL 7.5 DAY AND expiration = '1s' "
);
$prepare->execute();
$prepare = $pdo->prepare(
  " DELETE FROM datafiles WHERE createdAt < NOW() - INTERVAL 14.5 DAY AND expiration = '2s' "
);
$prepare->execute();

$fileNameForLink = 'notset';
if(isset($_POST['upload'])) {
  $_SESSION['ext'] = array();
  $file = $_FILES['file'];
  $numberOfDays = $_POST['numberOfDays'];
  
  $_SESSION['old'] = $numberOfDays;
  $arrayFiles = reArrayFiles($file);
  $_SESSION['access'] = array();
  $_SESSION['name'] = array();
  $_SESSION['fileSize'] = array();
  $filesEnc = array();
  $filesOriginalNames = array();
  $filesActualExts = array();
  $fileNameForLink = uniqid('', true);
  $uniqId = $fileNameForLink;
  $everyFilesName = array();
  $realNames = array();
  for ($i=0; $i < count($arrayFiles); $i++) { 
    $fileName = $arrayFiles[$i]['name'];
    $fileTmpName = $arrayFiles[$i]['tmp_name'];
    $fileSize = $arrayFiles[$i]['size'];
    $fileError = $arrayFiles[$i]['error'];
    $fileType = $arrayFiles[$i]['type'];
    
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('bat', 'exe', 'pkg');
    $fileNameNoExt = str_replace ( '.'.$fileActualExt, '',$fileName);
    if (!in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 1000000000) {
          $fileNameForLinkMultiple = $fileNameForLink.'__'.$i;
          $fileNameNew = $fileNameForLinkMultiple.'.'.$fileActualExt;
          $fileDestination = '../uploads/'.$numberOfDays.'/'.$fileNameNew;
          $fileNameOriginal = encrypt_decrypt('encrypt',$fileNameNoExt);
          $fileEnc = encrypt_decrypt('encrypt',$fileNameForLinkMultiple);
          move_uploaded_file($fileTmpName, $fileDestination);
          /** insert every infos in session & db */
          $_SESSION['fileSize'][] = $fileSize;
          $_SESSION['access'][] = $fileNameForLink;
          $_SESSION['name'][] = $fileNameNoExt;
          $_SESSION['ext'][] = $fileActualExt;
          array_push($everyFilesName, $fileDestination);
          array_push($realNames, $fileName);
          array_push($filesEnc, $fileEnc);
          array_push($filesOriginalNames, $fileNameOriginal);
          array_push($filesActualExts, $fileActualExt);
          if ($i == count($arrayFiles)-1) {
            for ($j=0; $j < count($arrayFiles); $j++) { 
              $prepare = $pdo->prepare(
                'INSERT INTO datafiles (firstFileName, secondFileName, ext, createdAt, expiration, size) VALUES (:firstFileName, :secondFileName, :ext, CURRENT_DATE(), :expiration, :size)'
              );
              $prepare->bindValue('firstFileName', $filesEnc[$j]);
              $prepare->bindValue('secondFileName', $filesOriginalNames[$j]);
              $prepare->bindValue('ext', $filesActualExts[$j]);
              $prepare->bindValue('expiration', $numberOfDays);
              $prepare->bindValue('size', $_SESSION['fileSize'][$j]);
              $prepare->execute();
              if ($j > 0 && $j == count($arrayFiles)-1) {
                $destination = '../uploads/'.$numberOfDays;
                zipMultiFile($everyFilesName,$uniqId,$destination,$realNames);
              }
              $_SESSION['access'][$j] = $uniqId;
            }
            $prepare = $pdo->prepare(
              'SELECT id FROM datafiles WHERE firstFileName = :firstFileName'
            );
            $prepare->bindValue('firstFileName', $filesEnc[0]);
            $prepare->execute();
            $row = $prepare->fetch();
            $_SESSION['id'] = $row->id;
            header('location: ../success');
            exit;
          }
        }
        else {
          $_SESSION['error'] = 'Votre fichier est trop gros !';
          header('location: ../');
          exit;
        }
      }
      else {
        $_SESSION['error'] = 'Vous essayer de mettre en ligne un fichier vide';
        header('location: ../');
        exit;
      }
    }
    else {
      $_SESSION['error'] = `L'extension du fichier est interdite car dangereuse`;
      header('location: ../');
      exit;
    }
  }
} else {
  $_SESSION['error'] = `Erreur interne appelez le 911 ou Romain en cas d'urgence`;
  header('location: ../');
  exit;
}