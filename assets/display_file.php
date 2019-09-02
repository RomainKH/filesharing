<?php
    // include functions
    include 'setup.php';
    include 'config.php';
    include 'functions.php';
    unset($_SESSION['access']);
    unset($_SESSION['name']);
    unset($_SESSION['error']);
    unset($_SESSION['old']);
    unset($_SESSION['ext']);
    unset($_SESSION['fileSize']);
    session_destroy();

    // setup template obj files
    class File
    {
        public $thisOld;
        public $originalName;
        public $ext;
        public $nameForLink;
        public $size;
    }

    $url = $_SERVER['REQUEST_URI'];
    $isFound = false;
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

    $directory = './uploads/24hrs';
    $scanned_directory_0 = array_diff(scandir($directory), array('..', '.'));
    $directory = './uploads/2j';
    $scanned_directory_1 = array_diff(scandir($directory), array('..', '.'));
    $directory = './uploads/1s';
    $scanned_directory_2 = array_diff(scandir($directory), array('..', '.'));
    $directory = './uploads/2s';
    $scanned_directory_3= array_diff(scandir($directory), array('..', '.'));

    $replaced = str_replace($path.'page?=', '', $url);
    $access = true;
    if ($replaced == 'notfound') {
        $access = false;
    }
    if ($access == true) {
        $fileNameToDownload = encrypt_decrypt('decrypt', $replaced);
        $indexes = explode('&', $fileNameToDownload);
        $multipleFilesName = array();
        $filesNameHashed = array();
        if ($indexes[0] != '') {
            if ($indexes[1] > 0) {
                for ($y=0; $y <= $indexes[1]; $y++) { 
                    $multipleFilesName[$y] = $indexes[0].'__'.$y;
                }
            }
            else {
                $multipleFilesName[0] = $indexes[0].'__'.$indexes[1];
            }
            $arrayOfFiles = array();
            foreach ($multipleFilesName as $file) {
                $fileNameToDownloadHashed = hash('ripemd160', $file);
                $thisFile = new File(); 
                $prepare = $pdo->prepare(
                    'SELECT * FROM datafiles WHERE firstFileName = :firstFileName'
                );
                $prepare->bindValue('firstFileName', $fileNameToDownloadHashed);
                $prepare->execute();
                $row = $prepare->fetch();
                $fileOriginalName = $row->secondFileName;
                $thisFile->size = $row->size;
                $thisFile->ext = $row->ext;
                $thisFile->originalName = encrypt_decrypt('decrypt',$fileOriginalName);
            
                $thisFile->nameForLink = $file.'.'.$thisFile->ext;
                foreach ($scanned_directory_0 as $value) {
                    if ($value == $thisFile->nameForLink) {
                        $isFound = true;
                        $thisFile->thisOld = '24hrs';
                    }
                }
                foreach ($scanned_directory_1 as $value) {
                    if ($value == $thisFile->nameForLink) {
                        $isFound = true;
                        $thisFile->thisOld = '2j';
                    }
                }
                foreach ($scanned_directory_2 as $value) {
                    if ($value == $thisFile->nameForLink) {
                        $isFound = true;
                        $thisFile->thisOld = '1s';
                    }
                }
                foreach ($scanned_directory_3 as $value) {
                    if ($value == $thisFile->nameForLink) {
                        $isFound = true;
                        $thisFile->thisOld = '2s';
                    }
                }
                $arrayOfFiles[] = $thisFile;
            }
            $arrayIsImg = array('jpeg', 'jpg', 'png', 'tif', 'gif', 'bmp', 'webp', 'eps', 'svg');
            $arrayIsVideo = array('mp4', 'webm');   
        }
    }