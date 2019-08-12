<?php
  include './assets/config.php';
  $_SESSION['previous_location'] = 'homepage';
  if (isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0') {
      unset($_SESSION['error']);
  } else {
    $_SESSION['intern'] = $_SESSION['error'];
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Innocean File Sharing</title>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
      <link rel="stylesheet" href="style.css">
      <link rel="icon" type="image/png" href="favicon.png" />
  </head>
  <body>
    <div class="container__ct homepage">
        <?php require './assets/header.php' ?>
        <div class="blocks__ct" id="background">
            <div class="block block__upload">
                <div class="error__filesize">
                    <p>Le(s) fichier(s) que vous essayez de mettre en ligne est trop lourd</p>
                </div>
                <form action="./assets/post_file.php" class="upload__form" method="POST" enctype="multipart/form-data">
                    <input id="file" type="file" name="file[]" multiple="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="file__icon">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <polyline points="13 2 13 9 20 9"></polyline>
                    </svg>
                    <div class="select__container">
                        <select class="number__days" name="numberOfDays" size="4">
                            <option value="24hrs" selected="selected">1 jour</option>
                            <option value="2j">2 jours</option>
                            <option value="1s">7 jours</option>
                            <option value="2s">14 jours</option>
                        </select>
                    </div>
                    <div class="progress__container">
                        <span></span>
                        <div class="progress"></div>
                    </div>
                    <button type="submit" name="upload" onclick="uploadFile()">UPLOAD</button>
                    <div class="anim__on__file__drop"></div>
                </form>
                <div class="anim__on__file__drop"></div>
                <div class="exp__upload__right">
                    <p>
                        <mark>Partage de fichiers</mark> interne à
                        <mark>Innocean</mark>, et téléchargeable
                        <mark>pour tout le monde.</mark>
                    </p>
                    <span>Le liens de partage expirera après :</span>
                </div>
            </div>
            <div class="block block__links">
                <div class="link__list" data-simplebar data-simplebar-auto-hide="false">
                    <div class="simplebar-wrapper">
                        <div class="simplebar-height-auto-observer-wrapper">
                            <div class="simplebar-height-auto-observer"></div>
                        </div>
                        <div class="simplebar-mask">
                            <div class="simplebar-offset">
                                <div class="simplebar-content-wrapper">
                                    <div class="simplebar-content">
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
                <div class="link__list__exp">
                    <p>
                        Ici vous retrouverez tout les liens que vous avez créés avec
                        <mark>Innocean File Sharing</mark>, vous pouvez en supprimez certains et même tous les enlever si vous le désirez.
                    </p>
                    <button>Supprimez tout</button>
                </div>
            </div>
        </div>
        <div class="error__msg">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="file__icon">
                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                <polyline points="13 2 13 9 20 9"></polyline>
            </svg>
            <div class="text">
                <h5>Une erreur est survenue</h5>
                <span><?= $_SESSION['intern'] ?></span>
            </div>
            <button class="close__error" onclick="deleteError()"></button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="./assets/index.js"></script>
  </body>
</html>