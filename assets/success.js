const input__rename = document.querySelectorAll('.file__name'),
      link = document.querySelector('.link__download'),
      //link__share = document.querySelector('.link__download + input + button'),
      block__file = document.querySelectorAll('.block__file')

const copyLink = () => {
  let copyText = document.querySelector('#linkShare')
  copyText.select()
  document.execCommand('copy')
}
for (let k = 0; k < block__file.length; k++) {
  $(document).ready(function () {
    $(`#button${k}`).click(function () {
      $.ajax({
        type: 'POST',
        url: './assets/rename.php',
        data: { name: link.id, newNameFile: input__rename[k].value, index: block__file[k].id },
        success: function (data) {
          input__rename[k].placeholder = data
        }
      })
    })
  })
  /*
  document.addEventListener('DOMContentLoaded', function() {
    let btn = document.querySelector(`#button${k}`)
    btn.addEventListener('click', () => {
      var httpRequest = new XMLHttpRequest()
      httpRequest.onreadystatechange = function () {
        if (httpRequest.readyState == 4 ) {
          console.log(httpRequest.responseText)
          input__rename[k].placeholder = httpRequest.responseText
          console.log(httpRequest)
        }
      } 
      httpRequest.open('POST', './assets/rename.php', true)
      httpRequest.setRequestHeader('Content-Type', 'text/xml')
      httpRequest.send({name: link.id, newNameFile: input__rename[k].value, index: block__file[k].id})
    })
  })
  */
}

window.addEventListener('load', () => {
    //link.style.transform = `translate(-50%, -50%)`
    //link__share.style.transform = `translate(-50%, -50%)`
    //link.style.zIndex = `1`
    //link.style.opacity = `1`
    //link__share.style.zIndex = `1`
    //link__share.style.opacity = `1`
})
let background__mail__div = 0
const btn__mail = document.querySelector('.cta__links > button.white__btn')
btn__mail.addEventListener('click', () => {
  const background__mail = document.createElement('div'),
        form__mail = document.createElement('div'),
        btn__quit = document.createElement('button'),
        input__destination = document.createElement('input'),
        input__ur__mail = document.createElement('input'),
        message = document.createElement('textarea'),
        submit = document.createElement('button'),
        label__destination = document.createElement('label'),
        label__ur__mail = document.createElement('label'),
        label__message = document.createElement('label'),
        div__dest = document.createElement('div'),
        div__ur__mail = document.createElement('div'),
        div__message = document.createElement('div')
  
  window.scrollTo(0, 0); // values are x,y-offset
  document.body.appendChild(background__mail)
  background__mail.classList.add('bg__mail')
  document.body.style.overflow = 'hidden'
  background__mail.appendChild(form__mail)
  form__mail.classList.add('form__mail')
  form__mail.method = 'POST'
  form__mail.action = './assets/mail.php'
  form__mail.appendChild(btn__quit)
  btn__quit.classList.add('cross__delete')
  btn__quit.classList.add('quit__mail')
  form__mail.appendChild(div__dest)
  form__mail.appendChild(div__ur__mail)
  form__mail.appendChild(div__message)
  div__dest.appendChild(label__destination)
  label__destination.innerHTML = 'Destinataire'
  label__destination.setAttribute('for', 'destination__mail')
  label__destination.classList.add('dest__label')
  div__dest.appendChild(input__destination)
  input__destination.type = 'email'
  input__destination.id = 'destination__mail'
  input__destination.name = 'destination__mail'
  input__destination.placeholder = 'exemple@innocean.eu'
  div__ur__mail.appendChild(label__ur__mail)
  label__ur__mail.innerHTML = 'Votre e-mail'
  label__ur__mail.setAttribute('for', 'ur__mail')
  label__ur__mail.classList.add('mail__label')
  div__ur__mail.appendChild(input__ur__mail)
  input__ur__mail.type = 'email'
  input__ur__mail.id = 'ur__mail'
  input__ur__mail.name = 'ur__mail'
  input__ur__mail.placeholder = 'exemple@innocean.eu'
  div__message.appendChild(label__message)
  label__message.innerHTML = 'Votre message'
  label__message.setAttribute('for', 'message__mail')
  label__message.classList.add('message__label')
  div__message.appendChild(message)
  message.id = 'message__mail'
  message.name = 'message__mail'
  message.placeholder = 'hello !'
  form__mail.appendChild(submit)
  submit.classList.add('blue__btn')
  submit.id = 'submit__mail'
  submit.name = 'mail'
  submit.innerHTML = 'Envoyer le mail'
  setTimeout(() => {
    background__mail.style.opacity = 1
  }, 1)
  background__mail__div = background__mail
  handleInteraction(background__mail, btn__quit)
})

const handleInteraction = (el, btn) => {
  btn.addEventListener('click', () => {
    el.style.opacity = 0
    setTimeout(() => {
      el.remove()
      document.body.style.overflow = 'auto'
    }, 600)
  })
}
var data = { 
  destination__mail: $(`#destination__mail`).val(),
  ur__mail: $(`#ur__mail`).val(),
  message__mail: $(`#message__mail`).val()
}
$(document).ready(function () {
  $(`#submit__mail`).click(function () {
    $.ajax({
      type: 'POST',
      url: './assets/mail.php',
      data: data,
      success: function (data) {
        console.log(data)
      }
    })
  })
})

const checkbox__autodl = document.querySelector('#checkdl')
checkbox__autodl.addEventListener('click', () => {
  let linkText = document.querySelector('#linkShare'),
      linkAccess = document.querySelector('.cta__links > .link__download.white__btn')
  if (checkbox__autodl.classList.contains('active')) {
    checkbox__autodl.classList.remove('active')
    linkText.value = linkText.value.replace('&download','')
    linkAccess.href = linkAccess.href.replace('&download','')
  } else {
    checkbox__autodl.classList.add('active')
    linkText.value = `${linkText.value}&download`
    linkAccess.href = `${linkAccess.href}&download`
  }
})

const rename__ct = document.querySelectorAll('.rename__file'),
      rename__btn = document.querySelectorAll('.rename__file > button')

for (let xy = 0; xy < rename__btn.length; xy++) {
  rename__btn[xy].addEventListener('click', () => {
    rename__btn[xy].style.opacity = 0
    rename__btn[xy].style.transform = 'translateY(-100%)'
    const validate = document.createElement('div')
    validate.classList.add('confirm__picto')
    rename__ct[xy].appendChild(validate)
    validate.style.transform = 'translateY(100%)'
    setTimeout(() => {
      validate.style.opacity = 1
      validate.style.transform = 'translateY(0%)'
    }, 200)
    setTimeout(() => {
      rename__btn[xy].style.display = 'none'
      rename__btn[xy].style.transform = 'translateY(100%)'
    }, 401)
    setTimeout(() => {
      validate.style.opacity = 0
      validate.style.transform = 'translateY(-100%)'
      rename__btn[xy].style.display = 'block'
    }, 801)
    setTimeout(() => {
      rename__btn[xy].style.opacity = 1
      rename__btn[xy].style.transform = 'translateY(0%)'
      validate.remove()
    }, 901);
  })
}