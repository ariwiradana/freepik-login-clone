const formSignUp = document.querySelector('.form__sign-up')
const btnSignUp = document.querySelector('#sign-up-btn')
btnSignUp.addEventListener('click', async (e) => {
  e.preventDefault()

  btnSignUp.setAttribute('disabled', true)
  const username = document.querySelector('#sign-up-username').value
  const email = document.querySelector('#sign-up-email').value
  const password = document.querySelector('#sign-up-password').value
  const fd = new FormData()

  fd.append('username', username)
  fd.append('email', email)
  fd.append('password', password)

  const req = await fetch('http://localhost:8080/login/php/sign-up.php', {
    method: 'post',
    body: fd
  })

  const {
    success,
    message
  } = await req.json()

  if (success) {
    alert(message)
    btnSignUp.removeAttribute('disabled')
    formSignUp.reset()

  } else {
    alert(message)
    btnSignUp.removeAttribute('disabled')
  }
})