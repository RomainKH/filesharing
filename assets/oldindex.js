// function for progress bar to be shown
/**const uploadFile = () => {
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
}
const progressHandler = (event) => {
  let percent = (event.loaded / event.total) * 100
  progress__bar.style.width = `${Math.round(percent)}%`
  progress__bar.value = Math.round(percent)
}
const completeHandler = (event) => {
  progress__bar.value = 100
}
const errorHandler = () => {
  txt__error.innerHTML = `Upload Failed`
}
const abortHandler = () => {
  txt__error.innerHTML = `Upload Aborted`
}**/

/**
 * Check conditions on page load
 */
/*
if (performance.navigation.type == 1) {
  sessionStorage.setItem('wasPageLoaded', 'false')
}
let isPageLoaded = sessionStorage.getItem('wasPageLoaded')
*/
/*
window.addEventListener('load', () => {
  //if (isPageLoaded == 'true') {
  //  form.classList.add('no__tr__form')
  //  title.classList.add('no__tr__title')
  //}
  //else {
  //  form.classList.add('pop__tr')
  //  title.classList.add('clip__tr')
  //}
  //sessionStorage.setItem('wasPageLoaded', 'true')
})*/
/*if (isPageLoaded == 'true') {
      form.classList.add('no__tr__form')
      title.classList.add('no__tr__title')
    }
    else {
      form.classList.add('pop__tr')
      title.classList.add('clip__tr')
    }*/
        /*sessionStorage.setItem('wasPageLoaded', 'true')*/
/*
if (input__file__in != null) {
  input__file__in.addEventListener('dragenter', () => {
    style__file__in.classList.add('is__file')
    if (style__file__in.classList.contains('is__no__file')) {
      style__file__in.classList.remove('is__no__file')
    }
    upload__btn.classList.add('is__displayed')
    event.preventDefault()
  })
  input__file__in.addEventListener('dragleave', () => {
    style__file__in.classList.toggle('is__no__file')
    if (style__file__in.classList.contains('is__file')) {
      style__file__in.classList.remove('is__file')
    }
  })
  input__file__in.addEventListener('change', () => {
    if (!style__file__in.classList.contains('is__file')) {
      style__file__in.classList.add('is__file')
      upload__btn.classList.add('is__displayed')
    }
  })
}
upload__btn.addEventListener('mousedown', () => {
  upload__btn.style.opacity = '0'
  error__span.style.opacity = '0'
})*/
//particlesJS.load('particles-js', 'assets/particles.json', function() {
//  console.log('callback - particles.js config loaded');
//});