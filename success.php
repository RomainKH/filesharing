<?php
  include './assets/config.php';
  include './assets/functions.php';
  $fileNameForLink = $_SESSION['access'][0];
  $fileNameNoExt = $_SESSION['name'];
  if ($fileNameForLink == null) {
    unset($_SESSION['previous_location']);
    $_SESSION['error'] = "La session a expiré";
    header('location: ./');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Fichiers en ligne</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/png" href="favicon.png" />
</head>
<body class="success">
<div class="background">
  <?php require './assets/header.php' ?>
  <div class="success__blocks">
    <div class="flex__multiples" data-simplebar data-simplebar-auto-hide="false">
        <div class="simplebar-wrapper">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset">
                    <div class="simplebar-content-wrapper">
                        <div class="simplebar-content">
                        <?php $howMuchFiles = -1; ?>
                          <?php for ($i=0; $i < count($_SESSION['access']); $i++) {  ?>
                          <?php $howMuchFiles += 1; ?>
                          <div class="block__file" id="__<?=$i?>">
                            <div>
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="file__icon"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                              <div>
                                <input onClick="this.setSelectionRange(0, this.value.length)" type="text" class="file__name" name="file__name" placeholder="<?= $fileNameNoExt[$i] ?>" value="<?= $fileNameNoExt[$i] ?>" />
                                <small>
                                  <?php
                                  $num = $_SESSION['fileSize'][$i];
                                  $numlength = strlen((string)$num);
                                  if ($numlength <= 6) {
                                    echo round($_SESSION['fileSize'][$i]/1000).' Kb';
                                  } else if ($numlength >= 7) {
                                    echo round($_SESSION['fileSize'][$i]/1000000).' Mb';
                                  }
                                  ?>
                                </small>
                              </div>
                            </div>
                            <div class="rename__file">
                              <button id="button<?=$i?>" type="button">Renommer</button>
                            </div>
                          </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder">
            </div>
        </div>
        <div class="simplebar-track simplebar-vertical">
            <div class="simplebar-scrollbar simplebar-visible"></div>
        </div>
    </div>
    <script>
      let localData = localStorage.getItem('theLinksCreated')
      if (localData != undefined || localData != null) {
        localData = JSON.parse(localData)
        let doubloon = false
        for (let i = 0; i < localData.length; i++) {
          if(localData[i].link == 'http://localhost:8888/innocean_file_sharing/page?=<?=encrypt_decrypt('encrypt',$fileNameForLink.'&'.$howMuchFiles)?>') {
            doubloon = true
            localData[i].name = '<?= $fileNameNoExt[0] ?>'
          }
        }
        if (doubloon == false) {
          let objLink = {link : 'http://localhost:8888/innocean_file_sharing/page?=<?=encrypt_decrypt('encrypt',$fileNameForLink.'&'.$howMuchFiles)?>', name : '<?= $fileNameNoExt[0] ?>' }
          localData.push(objLink)
          localStorage.setItem('theLinksCreated', JSON.stringify(localData))
        }
      } else {
        localData = new Array()
        let objLink = {link : 'http://localhost:8888/innocean_file_sharing/page?=<?=encrypt_decrypt('encrypt',$fileNameForLink.'&'.$howMuchFiles)?>', name : '<?= $fileNameNoExt[0] ?>' }
        localData.push(objLink)
        localStorage.setItem('theLinksCreated', JSON.stringify(localData))
      }
    </script>
    <div class="access__file">
      <h3>Partagez le(s) fichier(s) :</h3>
      <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
      <div class="buttons">
        <div class="cta__links">
          <a id="<?=$fileNameForLink?>" class="link__download  white__btn" href="page?=<?=encrypt_decrypt('encrypt',$fileNameForLink.'&'.$howMuchFiles)?>">Accès au téléchargement</a>
          <button class="white__btn">Envoyer le lien par mail</button>
        </div>
        <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
        <div class="cta__link">
          <input type="text" value="http://localhost:8888/innocean_file_sharing/page?=<?=encrypt_decrypt('encrypt',$fileNameForLink.'&'.$howMuchFiles)?>" id="linkShare">
          <button class="blue__btn" onclick="copyLink()">Copier le lien de téléchargement</button> 
          <div>
            <input id="checkdl" type="checkbox">
            <label for="checkdl"></label>
            <p>téléchargement instantané</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
<script src="./assets/jquery.min.js"></script>
<script src="./assets/success.js"></script>
</body>
</html>