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
    unset($_SESSION['id']);
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

    $replaced = str_replace($path.'d?=', '', $url);
    $access = true;
    if ($replaced == 'notfound' ) {
        $access = false;
    }
    else if (strlen($replaced) < 9) {
        $access = false;
    }
    if ($access == true) {
        $indexes = str_split($replaced, 8);
        $filesNameHashed = array();
        if ($indexes[0] != '') {
            $arrayOfFiles = array();
            $prepare = $pdo->prepare(
                'SELECT id FROM datafiles ORDER BY id DESC LIMIT 1'
            );
            $prepare->execute();
            $row = $prepare->fetch();
            $firstIdOfFiles = false;
            for ($w=0; $w <= $row->id; $w++) { 
                $prepare = $pdo->prepare(
                    'SELECT * FROM datafiles WHERE id = :id'
                );
                $prepare->bindValue('id', $w);
                $prepare->execute();
                $one = $prepare->fetch(PDO::FETCH_OBJ);
                if (isset($one->id)) {
                    if (hash('crc32b',$one->id) == $indexes[0]) {
                        $firstIdOfFiles = $w;
                    }
                }
            }
            for ($q=0; $q <= $indexes[1]; $q++) { 
                $prepare = $pdo->prepare(
                    'SELECT * FROM datafiles WHERE id = :id'
                );
                $thisId = $firstIdOfFiles + $q;
                $prepare->bindValue('id', $thisId);
                $prepare->execute();
                $each = $prepare->fetch();
                $thisFile = new File();
                $timeStamp = $each->firstFileName;
                $fileOriginalName = $each->secondFileName;
                $thisFile->size = $each->size;
                $thisFile->ext = $each->ext;
                $thisFile->originalName = encrypt_decrypt('decrypt',$fileOriginalName);
                $thisFile->nameForLink = encrypt_decrypt('decrypt', $timeStamp);
                foreach ($scanned_directory_0 as $value) {
                    if ($value == $thisFile->nameForLink.'.'.$thisFile->ext) {
                        $isFound = true;
                        $thisFile->thisOld = '24hrs';
                    }
                }
                foreach ($scanned_directory_1 as $value) {
                    if ($value == $thisFile->nameForLink.'.'.$thisFile->ext) {
                        $isFound = true;
                        $thisFile->thisOld = '2j';
                    }
                }
                foreach ($scanned_directory_2 as $value) {
                    if ($value == $thisFile->nameForLink.'.'.$thisFile->ext) {
                        $isFound = true;
                        $thisFile->thisOld = '1s';
                    }
                }
                foreach ($scanned_directory_3 as $value) {
                    if ($value == $thisFile->nameForLink.'.'.$thisFile->ext) {
                        $isFound = true;
                        $thisFile->thisOld = '2s';
                    }
                }
                $arrayOfFiles[] = $thisFile;
            }
            $arrayIsImg = array('jpeg', 'jpg', 'png', 'tif', 'gif', 'bmp', 'webp', 'eps', 'svg');
            $arrayIsVideo = array('mp4', 'webm');
            $arrayIsCode = array('html', 'css', 'js', 'php', 'scss', 'sass', 'sql');
            $arrayIsAdobe = array('psd', 'ai', 'psb');
        }
    }
