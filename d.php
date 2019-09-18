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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/themes/prism.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="favicon.png" />
</head>
<body>
    <script>needZip = false</script>
    <?php if ($isFound == true && $indexes[1] != 0) { ?>
    <div class="lds-ring">
        <svg class="logo__on__loading" style="width: 130%;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
        <div class="container__load">
            <div></div><div></div><div></div><div></div>
        </div>
    </div>
    <?php }?>
    <div class="background">
        <?php if ($isFound == true) { 
              $imgNbIncr = -1;
        ?>
        <svg class="big__logo" style="width: 130%;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
        <script>
            const logo = document.querySelector('.big__logo')
            window.addEventListener('load', function(){
                logo.style.opacity = 1 
                logo.style.transform = 'translateX(-50%) translateY(0%)'
            })
        </script>
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
                                <div class="content__to__download <?php if($indexes[1] == 0) { echo 'only__block';} else if(in_array($arrayOfFiles[$i]->ext, $arrayIsVideo)) {echo 'video__block';} ?>">
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
                                    <?php if (in_array($arrayOfFiles[$i]->ext,$arrayIsImg) && $arrayOfFiles[$i]->size < $maxSizeDisplayFile ) { 
                                        $imgNbIncr += 1;
                                    ?>
                                    <button>
                                        <img class="img__display__<?= $imgNbIncr ?>" src="<?= $path.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext ?>" alt="image">
                                    </button>
                                    <?php } else if (in_array($arrayOfFiles[$i]->ext, $arrayIsVideo) && $arrayOfFiles[$i]->size < $maxSizeDisplayFile) { ?>
                                    <div class="video__container">
                                        <video class="player" playsinline controls>
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
                                    <?php } else if (in_array($arrayOfFiles[$i]->ext,$arrayIsCode) && $arrayOfFiles[$i]->size < $maxSizeDisplayFile) { ?>
                                    <pre><code class="language-<?=$arrayOfFiles[$i]->ext?>">
                                        <?php
                                            $textToDisplay = $domain.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext;
                                            $read = file_get_contents($textToDisplay);
                                            echo $read;
                                        ?>
                                    </code></pre>
                                    <?php } else if (in_array($arrayOfFiles[$i]->ext,$arrayIsAdobe)) { $imgNbIncr += 1;?>
                                        <?php if(file_exists('uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.png')) { ?>
                                            <button>
                                                <img id="imgAdobe" class="img__display__<?= $imgNbIncr ?>" src="<?= $path.'uploads/'.$arrayOfFiles[$i]->thisOld.'/'.$arrayOfFiles[$i]->nameForLink.'.png' ?>" alt="image">
                                            </button>
                                        <?php } else { ?>
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 58 58" style="enable-background:new 0 0 58 58;" xml:space="preserve"><g><path d="M50.949,12.187l-5.818-5.818l-5.047-5.048l0,0l-0.77-0.77C38.964,0.201,38.48,0,37.985,0H8.963C7.605,0,6.5,1.105,6.5,2.463V39v16.537C6.5,56.895,7.605,58,8.963,58h40.074c1.358,0,2.463-1.105,2.463-2.463V39V13.515C51.5,13.02,51.299,12.535,50.949,12.187z M39.5,12V8.903V3.565L47.935,12h-6.741H39.5z M24.022,31.168C23.868,31.071,23.696,31,23.5,31c-0.501,0-0.899,0.375-0.971,0.856c-0.298,0.069-0.604,0.113-0.923,0.113l-1.111,0.006C20.482,31.435,20.044,31,19.5,31c-0.548,0-0.99,0.441-0.997,0.987L16.221,32c0.262-0.396,0.465-0.823,0.63-1.253C17.027,30.899,17.249,31,17.5,31c0.552,0,1-0.448,1-1c0-0.552-0.448-1-1-1c-0.063,0-0.119,0.025-0.179,0.036c0.072-0.403,0.118-0.776,0.143-1.081l0.082-0.504c0.017-0.165,0.059-0.321,0.094-0.479C18.123,26.901,18.5,26.502,18.5,26c0-0.208-0.079-0.391-0.188-0.551c0.175-0.243,0.372-0.467,0.595-0.665C19.075,24.911,19.274,25,19.5,25c0.552,0,1-0.448,1-1c0-0.025-0.012-0.045-0.014-0.07c0.358-0.103,0.73-0.174,1.12-0.174c0.121,0,0.235,0.025,0.354,0.036l0.167,0.021c0.135,0.017,0.263,0.053,0.394,0.082C22.517,23.932,22.5,23.963,22.5,24c0,0.552,0.448,1,1,1c0.273,0,0.52-0.111,0.7-0.288c0.191,0.156,0.367,0.326,0.527,0.513c0.021,0.025,0.041,0.049,0.062,0.075C24.611,25.48,24.5,25.727,24.5,26c0,0.552,0.448,1,1,1c0.035,0,0.065-0.016,0.099-0.02c0.01,0.048,0.029,0.092,0.038,0.141l0.005,0.026c0.041,0.234,0.072,0.471,0.072,0.716c0,0.399-0.075,0.778-0.182,1.143C25.52,29.006,25.511,29,25.5,29c-0.552,0-1,0.448-1,1c0,0.208,0.078,0.39,0.187,0.55C24.487,30.779,24.267,30.988,24.022,31.168z M26.516,24.247c-0.007-0.009-0.013-0.017-0.02-0.026c-0.605-0.811-1.405-1.465-2.332-1.895l2.123-2.123l2.828,2.828l-2.071,2.07C26.893,24.801,26.715,24.516,26.516,24.247z M30.531,21.617l-2.828-2.828L30.49,16c1.479-1.479,4.86-4.282,7.01-5.551v3.442c-1.419,1.91-3.22,3.976-4.181,4.938L30.531,21.617z M49.5,55.537c0,0.255-0.208,0.463-0.463,0.463H8.963C8.708,56,8.5,55.792,8.5,55.537V41h41V55.537z M8.5,39V2.463C8.5,2.208,8.708,2,8.963,2h28.595C37.525,2.126,37.5,2.256,37.5,2.391v5.804c-2.573,1.169-7.029,4.996-8.424,6.391l-7.185,7.185c-0.095-0.004-0.189-0.014-0.285-0.014c-2.971,0-5.463,2.125-5.983,5.016l-0.108,0.073l-0.02,0.536c-0.034,0.942-0.302,4.052-2.343,4.546c-0.517,0.129-0.858,0.625-0.793,1.152L12.52,34h6.98l2.106-0.03c3.367,0,6.107-2.74,6.107-6.107c0-0.193-0.011-0.383-0.029-0.572l7.049-7.048c1.223-1.224,3.591-3.976,5.141-6.243h9.234c0.135,0,0.265-0.025,0.392-0.058V39H8.5z"/><path d="M18.385,50.363h1.217c0.528,0,1.012-0.077,1.449-0.232s0.811-0.374,1.121-0.656c0.31-0.282,0.551-0.631,0.725-1.046c0.173-0.415,0.26-0.877,0.26-1.388c0-0.483-0.103-0.918-0.308-1.306s-0.474-0.718-0.807-0.991c-0.333-0.273-0.709-0.479-1.128-0.615c-0.419-0.137-0.843-0.205-1.271-0.205h-2.898V54h1.641V50.363z M18.385,45.168h1.23c0.419,0,0.756,0.066,1.012,0.198c0.255,0.132,0.453,0.296,0.595,0.492c0.141,0.196,0.234,0.401,0.28,0.615c0.045,0.214,0.068,0.403,0.068,0.567c0,0.41-0.05,0.754-0.15,1.032c-0.101,0.278-0.232,0.494-0.396,0.649c-0.164,0.155-0.344,0.267-0.54,0.335c-0.196,0.068-0.395,0.103-0.595,0.103h-1.504V45.168z"/><path d="M27.477,52.756c-0.183,0-0.378-0.019-0.588-0.055c-0.21-0.036-0.419-0.084-0.629-0.144c-0.21-0.06-0.413-0.123-0.608-0.191c-0.196-0.068-0.358-0.139-0.485-0.212l-0.287,1.176c0.155,0.137,0.339,0.253,0.554,0.349c0.214,0.096,0.439,0.171,0.677,0.226c0.237,0.055,0.472,0.094,0.704,0.116s0.458,0.034,0.677,0.034c0.51,0,0.966-0.077,1.367-0.232c0.401-0.155,0.738-0.362,1.012-0.622s0.485-0.561,0.636-0.902s0.226-0.695,0.226-1.06c0-0.538-0.105-0.978-0.314-1.319c-0.21-0.342-0.472-0.627-0.786-0.854s-0.654-0.422-1.019-0.581c-0.365-0.159-0.702-0.323-1.012-0.492c-0.31-0.169-0.57-0.364-0.779-0.588c-0.21-0.224-0.314-0.518-0.314-0.882c0-0.146,0.036-0.299,0.109-0.458c0.073-0.159,0.173-0.303,0.301-0.431c0.127-0.128,0.273-0.234,0.438-0.321s0.337-0.139,0.52-0.157c0.328-0.027,0.597-0.032,0.807-0.014c0.209,0.019,0.378,0.05,0.506,0.096c0.127,0.046,0.226,0.091,0.294,0.137s0.13,0.082,0.185,0.109c0.009-0.009,0.036-0.055,0.082-0.137c0.045-0.082,0.1-0.185,0.164-0.308c0.063-0.123,0.132-0.255,0.205-0.396c0.073-0.142,0.137-0.271,0.191-0.39c-0.265-0.173-0.611-0.299-1.039-0.376c-0.429-0.077-0.853-0.116-1.271-0.116c-0.41,0-0.8,0.063-1.169,0.191s-0.693,0.313-0.971,0.554c-0.278,0.241-0.499,0.535-0.663,0.882s-0.246,0.743-0.246,1.189c0,0.492,0.104,0.902,0.314,1.23c0.209,0.328,0.474,0.613,0.793,0.854c0.319,0.241,0.661,0.451,1.025,0.629c0.364,0.178,0.704,0.355,1.019,0.533s0.576,0.376,0.786,0.595c0.209,0.219,0.314,0.483,0.314,0.793c0,0.511-0.148,0.896-0.444,1.155C28.458,52.626,28.032,52.756,27.477,52.756z"/><path d="M36.896,53.952c0.264-0.032,0.556-0.104,0.875-0.219c0.319-0.114,0.649-0.285,0.991-0.513s0.649-0.54,0.923-0.937s0.499-0.889,0.677-1.477s0.267-1.297,0.267-2.126c0-0.602-0.105-1.188-0.314-1.757c-0.21-0.569-0.526-1.078-0.95-1.524s-0.957-0.805-1.6-1.073s-1.388-0.403-2.235-0.403h-3.035V54h3.814C36.436,54,36.632,53.984,36.896,53.952z M34.135,52.797v-7.629h0.957c0.784,0,1.422,0.103,1.914,0.308s0.882,0.474,1.169,0.807s0.48,0.704,0.581,1.114c0.1,0.41,0.15,0.825,0.15,1.244c0,1.349-0.246,2.379-0.738,3.09s-1.294,1.066-2.406,1.066H34.135z"/><circle cx="21.5" cy="26" r="1"/><circle cx="23.5" cy="28" r="1"/><circle cx="19.5" cy="28" r="1"/><circle cx="21.5" cy="30" r="1"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                        <?php }?>
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
            <?php if ($indexes[1] != 0 && isset($indexes)) { ?>
                <script>needZip = true</script>
                <div class="blob__container">
                    <p></p>
                    <a id="blob" class="blue__btn download__link__page">Tout télécharger</a>
                    <div class="progress__zip"></div>
                </div>
            <?php } ?>
        </div>
            <script>
                const containerOfDlableThings = document.querySelector('.container__content'),
                      childrensOfContainer = document.querySelectorAll('.container__content > *')
                if (childrensOfContainer.length <= 2 ) {
                    containerOfDlableThings.style.opacity = 1
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.2.2/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/components/prism-core.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="./assets/plyr.js"></script>
    <script>
      const players = Plyr.setup('.player')
      if (players != undefined) {
        window.player = players
        players.map(player => new Plyr(player, {
                controls: false
        }))   
      }
      if (window.location.href.includes('&download')) {
          let dl__link = document.querySelector('.download__link__page')
          if (dl__link != null && dl__link != undefined) {
              dl__link.click()
          } else {
              var small__link = document.querySelector('.single__link__dl')
              small__link.click()
          }
      }
      const contentToSee = document.querySelectorAll('.content__to__download > button > img'),
            buttonAccessFscreen = document.querySelectorAll('.content__to__download > button'),
            contentSlider = document.querySelector('.slider .simplebar-content.content'),
            slider = document.querySelector('.slider'),
            container__content = document.querySelector('.container__content')
      document.body.style.overflow = 'hidden'
      for (let h = 0; h < contentToSee.length; h++) {
        buttonAccessFscreen[h].addEventListener('click', () => {
            let imgSlide = document.createElement('img')
            imgSlide.classList.add('slide__img')
            imgSlide.src = contentToSee[h].src
            contentSlider.appendChild(imgSlide)
            slider.style.display = 'block'
            logo.style.opacity = 0
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
            logo.style.opacity = 1
        }, 1)
        setTimeout(() => {
            slide__img.remove()
            slider.style.display = 'none'
        }, 601)
      })
      if (needZip == true) {
        let zip = new JSZip()
        <?php if (!isset($arrayOfFiles[0])) {
            exit;
        } ?>
        let link = <?=$path?>+'uploads/<?=$arrayOfFiles[0]->thisOld?>/',
            fileName = new Array,
            realNames = new Array
        <?php for ($i=0; $i <= $indexes[1] ; $i++) { ?>
        fileName.push('<?= $arrayOfFiles[$i]->nameForLink.'.'.$arrayOfFiles[$i]->ext ?>')
        realNames.push('<?= $arrayOfFiles[$i]->originalName.'.'.$arrayOfFiles[$i]->ext ?>')
        <?php } ?>
        let blob__ct = document.querySelector('.blob__container'),
            progressbar__zip = blob__ct.querySelector('.progress__zip'),
            btn__download__all = blob__ct.querySelector('#blob'),
            text__progress = blob__ct.querySelector('p'),
            charged = 0

        for (let i = 0; i < fileName.length; i++) {
            let xhr = new XMLHttpRequest()
            xhr.open("GET", link+fileName[i], true)
            xhr.overrideMimeType('text/plain; charset=x-user-defined')
            xhr.onload = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        zip.file(realNames[i], xhr.responseText, {binary : true, compression : "DEFLATE"})
                        charged++
                        const logo = document.querySelector('.big__logo')
                        logo.style.opacity = 0
                        logo.style.transform = 'translate(-50%, 200%)'
                        if (charged == fileName.length) {
                            logo.style.zIndex = 2
                            let loadingAnim = document.querySelector('.lds-ring')
                            container__content.style.opacity = 1
                            loadingAnim.style.opacity = 0
                            loadingAnim.style.transform = 'translate(-50%, -250%)'
                            setTimeout(() => {
                                document.body.style.overflow = 'auto'
                                logo.style.opacity = 1
                                logo.style.transform = 'translate(-50%, 0%)'
                                setTimeout(() => {
                                    logo.style.zIndex = 0
                                    loadingAnim.remove()
                                }, 400)
                            }, 300)
                        }
                    } else {
                        console.log(xhr.statusText)
                    }
                }
            }
            xhr.send(null)
        }
        btn__download__all.addEventListener('click', function() {
            if (charged == realNames.length) {
                zip.generateAsync({type:"blob", streamFiles: true}, function (metadata) {
                    btn__download__all.style.cursor = 'default'
                    blob__ct.style.cursor = 'default'
                    progressbar__zip.style.width = metadata.percent + '%'
                    text__progress.innerHTML = Math.round(metadata.percent) + ' %'
                    if (text__progress.innerHTML == '99 %') {
                        progressbar__zip.style.transition = '.4s ease-out'
                        btn__download__all.style.transition = '.4s ease-out'
                    }
                })
                .then(function (blob) {
                    saveAs(blob, "archive.zip")
                    setTimeout(() => {
                        progressbar__zip.style.opacity = '0'
                        btn__download__all.style.opacity = '0'
                        text__progress.style.opacity = '0'
                        text__progress.style.transform = 'translateY(100%)'
                        setTimeout(() => {
                            text__progress.innerHTML = 'téléchargement terminé'
                            text__progress.style.color = '#4E4E4E'
                            setTimeout(() => {
                                text__progress.style.opacity = '1'
                                text__progress.style.transform = 'translateY(0%)'    
                            }, 401)
                        }, 401)
                    }, 101)
                })
                text__progress.style.zIndex = 1
                btn__download__all.innerHTML = ""
                btn__download__all.classList.add('download__all')
            } else {
                console.log('not ready to dl')
            }
        })
      }
      
    </script>
</body>
</html>