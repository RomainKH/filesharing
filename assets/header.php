<?php include './assets/setup.php'; ?>
<div class="background__infos"></div>
<nav>
    <a href="<?= $domain ?>">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
    </a>
    <div class="questionmark">
        <button>?</button>
        <div class="infos__iwfsf">
            <p>
                RK File Share est un service de partage de fichiers en ligne. Il possède une limite de 2go. Si jamais vous avez des problèmes n’hésitez pas à nous contacter à l’adresse mail suivante:
                <br/>
                <br/>
                <small>romain.khanoyan@gmail.com</small>
            </p>
        </div>
    </div>
</nav>
<script>
const buttonInfos = document.querySelector('.questionmark button'),
      background = document.querySelector('.background__infos'),
      infosPopup = document.querySelector('.infos__iwfsf')

buttonInfos.addEventListener('click', () => {
  if (infosPopup.classList.contains('is__open')) {
    infosPopup.classList.remove('is__open')
    background.style.opacity = 0
    infosPopup.style.opacity = 0
    setTimeout(() => {
      background.style.display = 'none'
      document.body.style.overflow = ''
      infosPopup.style.display = 'none'
    }, 300)
  } else {
    infosPopup.classList.add('is__open')
    document.body.style.overflow = 'hidden'
    infosPopup.style.display = 'block'
    background.style.display = 'block'
    setTimeout(() => {
      background.style.opacity = 1
    }, 100)
    setTimeout(() => {
      infosPopup.style.opacity = 1
    }, 200)
  }
})

background.addEventListener('click', () => {
  if (infosPopup.classList.contains('is__open')) {
    infosPopup.classList.remove('is__open')
    document.body.style.overflow = ''
    background.style.opacity = 0
    infosPopup.style.opacity = 0
    setTimeout(() => {
      background.style.display = 'none'
      infosPopup.style.display = 'none'
    }, 300)
  }
})
</script>