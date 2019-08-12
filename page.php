<?php
    include './assets/display_file.php';
    //class File
    //{
    //    public $thisOld;
    //    public $originalName;
    //    public $ext;
    //    public $nameForLink;
    //}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.5.6/plyr.css">
    <link rel="icon" type="image/png" href="favicon.png" />
</head>
<body>
    <div class="background">
        <div>
            <div class="container__content">
            <?php if ($isFound == true) { ?>
                <?php for ($i=0; $i <= $indexes[1]; $i++) { 
                        if ($arrayOfFiles[$i]->originalName != null) {      
                ?>
                <div class="content__to__download">
                    <span class="downloadpage"><?= $arrayOfFiles[$i]->originalName ?></span>
                    <?php if (in_array($arrayOfFiles[$i]->ext,$arrayIsImg)) { ?>
                    <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
                    <img src="<?= '/innocean_file_sharing/uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink ?>" alt="img">
                    <?php } else if (in_array($arrayOfFiles[$i]->ext, $arrayIsVideo)) { ?>
                    <div class="video__container">
                        <video id="player" playsinline controls>
                        <?php if ($arrayOfFiles[$i]->ext == 'mp4') { ?>
                            <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
                            <source src="<?= '/innocean_file_sharing/uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink ?>" type="video/mp4" />
                        <?php } else { ?>
                            <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
                            <source src="<?= '/innocean_file_sharing/uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink ?>" type="video/webm" />
                        <?php } ?>
                        </video>
                    </div>
                    <?php } else if ($arrayOfFiles[$i]->ext == 'pdf') { ?>
                    <div class=" embed">
                      <embed src="<?= '/innocean_file_sharing/uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink ?>" width=250 height=250 type='application/pdf'/>
                    </div>
                    <?php } else { ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                    <?php } ?>
                    <a class="basic__btn single__link__dl" href="<?= '/innocean_file_sharing/uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink ?>" download="<?= $arrayOfFiles[$i]->originalName.'.'.$arrayOfFiles[$i]->ext ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud"><polyline points="8 17 12 21 16 17"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"></path></svg>
                    </a>
                </div>
                <?php } } ?>
                <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
                <?php if ($indexes[1] != 0) { ?>
                    <a class="basic__btn download__link__page" href="<?= '/innocean_file_sharing/uploads/'.$arrayOfFiles[0]->thisOld.'/'.$indexes[0].'.zip' ?>" download="archive.zip">DOWNLOAD ALL FILES</a>
                <?php } ?>
            <?php } else { ?>
                <h2 class="downloadpage">File doesn't exist anymore or link is unvalid</h2>
                <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
                <a class="basic__btn return__home" href="<?='/innocean_file_sharing/'?>">Return Home</a>
            <?php } ?>
            </div>
        </div>
    </div>
    <script src="./assets/jquery.min.js"></script>
    <script src="./assets/plyr.js"></script>
    <script>
      const player = new Plyr('#player')
      window.player = player
    </script>
</body>
</html>