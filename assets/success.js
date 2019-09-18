const input__rename = document.querySelectorAll('.file__name'),
      link = document.querySelector('.link__download'),
      block__file = document.querySelectorAll('.block__file'),
      bg = document.querySelector('.background'),
      buttons__rename = document.querySelectorAll('.flex__multiples .block__file button')

const copyLink = () => {
  let copyText = document.querySelector('#linkShare')
  copyText.select()
  document.execCommand('copy')
}
let allowEnter = false,
    indexEnter = false
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
  bg.addEventListener('click', () => {
    allowEnter = false
  })
  input__rename[k].addEventListener('click', () => {
    setTimeout(() => {
      indexEnter = k
      allowEnter = true
    }, 1)
  })
}

document.addEventListener('keydown', (event) => {
  if (event.key == 'Enter' && allowEnter == true) {
    buttons__rename[indexEnter].click()
  }
}, false)

let background__mail__div = 0
const btn__mail = document.querySelector('.cta__links > button.white__btn')
btn__mail.addEventListener('click', () => {
  const background__mail = document.createElement('div'),
        form__mail = document.createElement('div'),
        btn__quit = document.createElement('button'),
        input__destination = document.createElement('input'),
        message = document.createElement('textarea'),
        submit = document.createElement('button'),
        label__destination = document.createElement('label'),
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
  input__destination.placeholder = 'exemple@email.com'
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
  submit.setAttribute('onclick','sendMail()')
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
function sendMail() {
  const destination__mail = document.querySelector('#destination__mail')
  if ($(`#destination__mail`).val() != null && $(`#destination__mail`).val().indexOf('@') !== -1 && $(`#destination__mail`).val().indexOf('.') !== -1 && $(`#destination__mail`).val() != undefined && $(`#destination__mail`).val() != '') {
    $(document).ready(function() {
      destination__mail.style.border = "2px var(--blue) solid"
      $.ajax({
        type: 'POST',
        url: './assets/mail.php',
        data: {destination__mail: $(`#destination__mail`).val(),message__mail: $(`#message__mail`).val(), url: $(`#linkShare`).val()},
        success: function (data) {
          const bg__mail = document.querySelector('.bg__mail'),
                mail__display = document.querySelector('.form__mail')
          bg__mail.style.opacity = 0
          mail__display.style.transform = 'translate(-50%, -100%)'
          setTimeout(() => {
            bg__mail.remove()
          },1200)
        }
      })
    })
  } else {
    destination__mail.style.border = "2px var(--red) solid"
    alert('Veuillez entrer une adresse email valide')
  }
}

const checkbox__autodl = document.querySelector('#checkdl')
checkbox__autodl.addEventListener('click', () => {
  let linkText = document.querySelector('#linkShare')
  if (checkbox__autodl.classList.contains('active')) {
    checkbox__autodl.classList.remove('active')
    linkText.value = linkText.value.replace('&download','')
  } else {
    checkbox__autodl.classList.add('active')
    let newValue = `${linkText.value}&download`
    linkText.value = newValue
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
Push.create("File Sharing",{
  body: "Votre mise en ligne est terminé!",
  icon: '../from/favicon.png',
  timeout: 4500,
  onClick: function () {
    window.focus()
    this.close()
  }
})