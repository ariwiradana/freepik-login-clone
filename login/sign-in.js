const formLogin = document.querySelector('.form__sign-in')
const btnLogin = document.querySelector('#sign-in-btn')
btnLogin.addEventListener('click', async (e) => {
  e.preventDefault()

  btnLogin.setAttribute('disabled', true)

  const username = document.querySelector('#sign-in-username').value
  const password = document.querySelector('#sign-in-password').value
  const fd = new FormData()

  fd.append('username', username)
  fd.append('password', password)

  const req = await fetch('http://localhost:8080/login/php/sign-in.php', {
    method: 'post',
    body: fd
  })

  const {
    success,
    data,
    message
  } = await req.json()

  if (success) {
    alert(message)

    sessionStorage.setItem('login', data.login)
    sessionStorage.setItem('id', data.id)

    formLogin.reset()

    btnLogin.removeAttribute('disabled')

  } else {
    alert(message)
    btnLogin.removeAttribute('disabled')
  }
})