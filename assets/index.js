const title = document.querySelector('h1')

const form = document.querySelector('form'),
      style__file__in = form.querySelector('.anim__on__file__drop'),
      input__file__in = form.querySelector('input'),
      upload__btn = form.querySelector('button'),
      error__span = document.querySelector('.error__msg'),
      txt__error = document.querySelector('.error__msg span'),
      progress__bar = form.querySelector('.progress'),
      svg__file = form.querySelector('svg'),
      percentage__span = form.querySelector('.progress__container > span'),
      error__filesize = document.querySelector('.error__filesize')

const uploadFile = () => {
  let file = input__file__in.files[0]

  let formdata = new FormData()
  formdata.append("file", file)
  let ajax = new XMLHttpRequest()
  ajax.upload.addEventListener(`progress`, progressHandler)
  ajax.addEventListener(`load`, completeHandler)
  ajax.addEventListener(`error`, errorHandler)
  ajax.addEventListener(`abort`, abortHandler)
  ajax.open(`POST`, `./assets/post_file.php`)
  ajax.send(formdata)
  svg__file.style.transition = '.3s ease'
  percentage__span.style.display = 'block'
  setTimeout(() => {
    svg__file.style.opacity = 0
    percentage__span.style.opacity = 1      
  }, 10)
}
const progressHandler = (event) => {
  let percent = (event.loaded / event.total) * 100
  progress__bar.style.height = `${Math.round(percent)}%`
  percentage__span.innerHTML = `${Math.round(percent)}%`
  progress__bar.value = Math.round(percent)
}
const completeHandler = (event) => {
  progress__bar.value = 100
}
const errorHandler = () => {
  percentage__span.innerHTML = `Upload Failed`
}
const abortHandler = () => {
  percentage__span.innerHTML = `Upload Aborted`
}

window.addEventListener('load', () => {
  if (txt__error.innerHTML !== null && txt__error.innerHTML !== '') {
    error__span.style.transition = '.6s cubic-bezier(0,.9,.44,1.15)'
    error__span.style.transform = 'translateX(-50%) scale(1)'
  }
})
let btn__error = error__span.querySelector('.close__error.cross__delete')
btn__error.addEventListener('click', () => {
  error__span.style.opacity = 0
  setTimeout(() => {
    error__span.remove()
  }, 600)
})

let local = localStorage.getItem('theLinksCreated'),
    whereToPutLinkIn = document.querySelector('.simplebar-content')
if (local != undefined || local != null) {
  local = JSON.parse(local)
  for (let o = 0; o < local.length; o++) {
    const divLink = document.createElement('div'),
          inputLink = document.createElement('input'),
          spanLink = document.createElement('span'),
          btnCopy = document.createElement('button'),
          btnDelete = document.createElement('button')
    
    if (local[o].name.length >= 11) {
      spanLink.classList.add('is__too__long')
      spanLink.title = local[o].name
    }
    divLink.classList.add('link')
    inputLink.classList.add('old__link')
    inputLink.classList.add(`link__${o}`)
    btnCopy.setAttribute('onclick', `copyLink(${o})`)
    btnCopy.innerHTML = 'copier le lien'
    btnDelete.classList.add('cross__delete')
    spanLink.innerHTML = local[o].name
    inputLink.setAttribute('value', local[o].link)
    divLink.appendChild(inputLink)
    divLink.appendChild(spanLink)
    divLink.appendChild(btnCopy)
    divLink.appendChild(btnDelete)
    whereToPutLinkIn.appendChild(divLink)
  }
}
const copyLink = (i) => {
  let copyText = document.querySelector(`.link > .link__${i}`)
  copyText.select()
  document.execCommand('copy')
}

const deleteAll = document.querySelector('.link__list__exp > p + button')
deleteAll.addEventListener('click', () => {
  localStorage.clear()
  const allLinks = document.querySelectorAll('.simplebar-content > div.link')
  for (let l = 0; l < allLinks.length; l++) {
    allLinks[l].remove()
  }
})

const uniqueDelete = document.querySelectorAll('.link > button.cross__delete')
for (let i = 0; i < uniqueDelete.length; i++) {
  uniqueDelete[i].addEventListener('click', () => {
    let localData = localStorage.getItem('theLinksCreated')
    const allLinks = document.querySelectorAll('.simplebar-content > div.link')
    localData = JSON.parse(localData)
    localData.splice(i, 1)
    localStorage.setItem('theLinksCreated', JSON.stringify(localData))
    allLinks[i].remove()
  })
}

input__file__in.addEventListener('dragenter', () => {
  input__file__in.classList.add('is__file')
  if (input__file__in.classList.contains('is__no__file')) {
    input__file__in.classList.remove('is__no__file')
  }
  upload__btn.classList.add('is__displayed')
  event.preventDefault()
  filesSize()
})
input__file__in.addEventListener('dragleave', () => {
  input__file__in.classList.toggle('is__no__file')
  if (input__file__in.classList.contains('is__file')) {
    input__file__in.classList.remove('is__file')
  }
  filesSize()
})
input__file__in.addEventListener('change', () => {
  if (!input__file__in.classList.contains('is__file')) {
    input__file__in.classList.add('is__file')
    upload__btn.classList.add('is__displayed')
  }
  filesSize()
})
const filesSize = () => {
  let total__size = 0
  if (input__file__in.files.length > 0) {
    for (let i = 0; i < input__file__in.files.length; i++) {
      total__size += input__file__in.files[i].size
    }
  }
  if (total__size != 0 && total__size > 10000000) {
    error__filesize.style.display = 'block'
    setTimeout(() => {
      error__filesize.style.opacity = 1
    }, 10)
  } else {
    error__filesize.style.opacity = 0
    setTimeout(() => {
      error__filesize.style.display = 'none'
    }, 600)
  }
}

const blockDl = document.querySelector('.block.block__links'),
      whereLinksAre = blockDl.querySelectorAll('.simplebar-content-wrapper .simplebar-content > .link')

if (whereLinksAre.length > 0) {
  blockDl.style.opacity = 1
} else {
  blockDl.remove()
}


const rename__ct = document.querySelectorAll('.block.block__links .link__list .link'),
      rename__btn = document.querySelectorAll('.block.block__links .link__list .link > span + button')

for (let xy = 0; xy < rename__btn.length; xy++) {
  rename__btn[xy].addEventListener('click', () => {
    rename__btn[xy].style.opacity = 0
    rename__btn[xy].setAttribute('disabled', 'true')
    rename__btn[xy].style.transform = 'translateY(-50%)'
    const validate = document.createElement('div')
    validate.classList.add('confirm__picto')
    validate.innerHTML = 'copié'
    validate.classList.add('on__home')
    rename__ct[xy].appendChild(validate)
    validate.style.transform = 'translateY(50%)'
    setTimeout(() => {
      validate.style.opacity = 1
      validate.style.transform = 'translateY(0%)'
    }, 200)
    setTimeout(() => {
      rename__btn[xy].style.display = 'none'
      rename__btn[xy].style.transform = 'translateY(50%)'
    }, 401)
    setTimeout(() => {
      validate.style.opacity = 0
      validate.style.transform = 'translateY(-50%)'
      rename__btn[xy].style.display = 'block'
    }, 801)
    setTimeout(() => {
      rename__btn[xy].style.opacity = 1
      rename__btn[xy].style.transform = 'translateY(0%)'
      validate.remove()
      rename__btn[xy].removeAttribute('disabled')
    }, 901);
  })
}