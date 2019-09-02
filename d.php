<?php
    include './assets/setup.php';
    include './assets/display_file.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Download</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.5.6/plyr.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="favicon.png" />
</head>
<body>
    <div class="background">
        <?php if ($isFound == true) { 
              $imgNbIncr = -1;
        ?>
        <div class="container__content" data-simplebar data-simplebar-auto-hide="false">
            <div class="simplebar-wrapper">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset">
                        <div class="simplebar-content-wrapper">
                            <div class="simplebar-content">
                                <?php for ($i=0; $i <= $indexes[1]; $i++) { 
                                        if ($arrayOfFiles[$i]->originalName != null) {      
                                ?>
                                <div class="content__to__download <?php if($indexes[1] == 0) { echo 'only__block';} ?>">
                                    <span class="size__file" >
                                    <?php
                                        $num = $arrayOfFiles[$i]->size;
                                        $numlength = strlen((string)$num);
                                        if ($numlength < 4) {
                                          echo '0,'.$num.' Kb';
                                        } else if ($numlength <= 6) {
                                          echo round($num/1000).' Kb';
                                        } else if ($numlength >= 7) {
                                          echo round($num/1000000).' Mb';
                                        }
                                    ?>
                                    </span>
                                    <span class="downloadpage"><?= $arrayOfFiles[$i]->originalName.'.'.$arrayOfFiles[$i]->ext ?></span>
                                    
                                    <?php if (in_array($arrayOfFiles[$i]->ext,$arrayIsImg) && $arrayOfFiles[$i]->size < $maxSizeDisplayFile) { 
                                        $imgNbIncr += 1;
                                    ?>
                                    <button>
                                        <img class="img__display__<?= $imgNbIncr ?>" src="<?= $path.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext ?>" alt="image">
                                    </button>
                                    <?php } else if (in_array($arrayOfFiles[$i]->ext, $arrayIsVideo) && $arrayOfFiles[$i]->size < $maxSizeDisplayFile) { ?>
                                    <div class="video__container">
                                        <video id="player" playsinline controls>
                                        <?php if ($arrayOfFiles[$i]->ext == 'mp4') { ?>
                                            <source src="<?= $path.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext ?>" type="video/mp4" />
                                        <?php } else { ?>
                                            <source src="<?= $path.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext ?>" type="video/webm" />
                                        <?php } ?>
                                        </video>
                                    </div>
                                    <?php } else if ($arrayOfFiles[$i]->ext == 'pdf' && $arrayOfFiles[$i]->size < $maxSizeDisplayFile) { ?>
                                    <div class="embed">
                                    <embed src="<?= $path.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext ?>" type='application/pdf'/>
                                    </div>
                                    <?php } else { ?>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                    <?php } ?>
                                    <a class="single__link__dl" href="<?= $path.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext ?>" download="<?= $arrayOfFiles[$i]->originalName.'.'.$arrayOfFiles[$i]->ext ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#4E4E4E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download-cloud"><polyline points="8 17 12 21 16 17"></polyline><line x1="12" y1="12" x2="12" y2="21"></line><path d="M20.88 18.09A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.29"></path></svg>
                                    </a>
                                </div>
                                <?php } } ?>
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
            <?php if ($indexes[1] != 0) { ?>
                <a class="blue__btn download__link__page" href="<?= $path.'uploads/'.$arrayOfFiles[0]->thisOld.'/'.str_replace('__0', '',$arrayOfFiles[0]->nameForLink).'.zip' ?>" download="archive.zip">Tout télécharger</a>
            <?php } ?>
        </div>
            <script>
                const containerOfDlableThings = document.querySelector('.container__content'),
                      childrensOfContainer = document.querySelectorAll('.container__content > *')
                if (childrensOfContainer.length == 1 ) {
                    containerOfDlableThings.classList.add('no__bg')
                }
            </script>
        <?php } else { ?>
            <div class="error__msg no__file">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="file__icon">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                    <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                <div class="text">
                    <h5>Fichier inexistant ou supprimé</h5>
                    <span>Si le problème persiste appelez le service après vente</span>
                </div>
                <button class="close__error cross__delete"></button>
            </div>
            <!-- LIENS DYNAMIQUE A METTRE A JOUR EN FONCTION DE L'ADRESSE SERVER -->
            <a class="white__btn return__home" href="./">Retour à la page d’acceuil</a>
            <script>
                let error__span = document.querySelector('.error__msg'),
                    btn__error = error__span.querySelector('.close__error.cross__delete')
                btn__error.addEventListener('click', () => {
                    error__span.style.opacity = 0
                    setTimeout(() => {
                    error__span.remove()
                    }, 600)
                })
            </script>
        <?php } ?>
    </div>
    <div class="slider">
        <div class="small__window" data-simplebar data-simplebar-auto-hide="false">
            <div class="simplebar-wrapper">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset">
                        <div class="simplebar-content-wrapper">
                            <div class="simplebar-content content">
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
        <div class="controls">
            <div class="cross__delete slider__cross"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="./assets/jquery.min.js"></script>
    <script src="./assets/plyr.js"></script>
    <script>
      const player = new Plyr('#player')
      window.player = player
      if (window.location.href.includes('&download')) {
          let dl__link = document.querySelector('.download__link__page')
          if (dl__link != null && dl__link != undefined) {
              dl__link.click()
          } else {
              var small__link = document.querySelector('.single__link__dl')
              small__link.click()
          }
      }
      const contentToSee = document.querySelectorAll('.content__to__download .downloadpage + button > img'),
            buttonAccessFscreen = document.querySelectorAll('.content__to__download .downloadpage + button'),
            contentSlider = document.querySelector('.slider .simplebar-content.content'),
            slider = document.querySelector('.slider')
      for (let h = 0; h < contentToSee.length; h++) {
        buttonAccessFscreen[h].addEventListener('click', () => {
            let imgSlide = document.createElement('img')
            imgSlide.classList.add('slide__img')
            imgSlide.src = contentToSee[h].src
            contentSlider.appendChild(imgSlide)
            slider.style.display = 'block'
            setTimeout(() => {
                slider.style.opacity = 1
                containerOfDlableThings.style.opacity = 0
            }, 10)
            setTimeout(() => {
                containerOfDlableThings.style.display = 'none'
            }, 700)
        })
      }
      const cross__quitfs = document.querySelector('.cross__delete.slider__cross')
      cross__quitfs.addEventListener('click', () => {
        let slide__img = document.querySelector('.slide__img') 
        slider.style.opacity = 0
        containerOfDlableThings.style.display = ''
        setTimeout(() => {
            containerOfDlableThings.style.opacity = 1
        }, 1)
        setTimeout(() => {
            slide__img.remove()
            slider.style.display = 'none'
        }, 601)
      })
    </script>
</body>
</html>