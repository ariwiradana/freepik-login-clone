// login nav
document.addEventListener('click', (e) => {
  if (e.target.classList.contains('login__header-title')) {
    const navLogins = document.querySelectorAll('.login__header-title')
    const navLoginContent = document.querySelectorAll('.login__card-body')
    const i = e.target.dataset.login

    for (const nav of navLogins) {
      nav.classList.remove('login__header-active')
    }

    for (const navContent of navLoginContent) {
      navContent.classList.remove('login__show')
    }

    e.target.classList.add('login__header-active')
    navLoginContent[i].classList.add('login__show')
  }
})

// password toggle
document.addEventListener('click', (e) => {
  if (e.target.classList.contains('input__password-toggle')) {
    e.target.classList.toggle('uil-eye-slash')
    const passToggleIcon = document.querySelector('.uil-eye-slash')
    const passwordInput = document.querySelectorAll('.form__password input')

    if (passToggleIcon) {
      for (const pass of passwordInput) {
        pass.setAttribute('type', 'text')
      }
    } else {
      for (const pass of passwordInput) {
        pass.setAttribute('type', 'password')
      }
    }
  }

})