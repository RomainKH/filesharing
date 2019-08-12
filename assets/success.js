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

const btn__mail = document.querySelector('.cta__links > button.white__btn')
btn__mail.addEventListener('click', () => {
  const background__mail = document.createElement('div'),
        form__mail = document.createElement('div'),
        btn__quit = document.createElement('button'),
        input__destination = document.createElement('input'),
        input__ur__mail = document.createElement('input'),
        message = document.createElement('input'),
        submit = document.createElement('button')
  
  window.scrollTo(0, 0); // values are x,y-offset
  document.body.appendChild(background__mail)
  background__mail.classList.add('bg__mail')
  document.body.style.overflow = 'hidden'
  background__mail.appendChild(form__mail)
  form__mail.classList.add('form__mail')
  form__mail.appendChild(btn__quit)
  btn__quit.classList.add('quit__mail')
  form__mail.appendChild(input__destination)
  form__mail.appendChild(input__ur__mail)
  form__mail.appendChild(message)
  form__mail.appendChild(submit)


  
        


})