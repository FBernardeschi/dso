let login = document.querySelector('section.login input[name="login"]'),
    password = document.querySelector('section.login input[name="pass"]'),
    labelLogin = document.querySelector('section.login label[for="login_input"]'),
    labelpassword = document.querySelector('section.login label[for="password_input"]');

login.addEventListener('change', () => {
    labelLogin.classList.toggle('green', login.value.length > 3);
});

password.addEventListener('change', () => {
    labelpassword.classList.toggle('green', password.value.length > 3);
});