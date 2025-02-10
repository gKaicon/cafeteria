const precisaLogin = document.currentScript.dataset.precisalogin

function checkLogin() {
    fetch('include/UserLogin/Controlador.php?acao=check')
        .then(res => res.json())
        .then(data => {
            
            if (precisaLogin == "true" && data == "false") {
                window.location.href = "tela-login.html";
            }
            if (data == "true") {
                document.querySelector('#btn-login').style.display = 'none'
                document.querySelector('#btn-adm').style.display = 'inline-block'
                document.querySelector('#btn-logout').style.display = 'inline-block'
            }
            if (data == "false") {
                document.querySelector('#btn-login').style.display = 'inline-block'
                document.querySelector('#btn-adm').style.display = 'none'
                document.querySelector('#btn-logout').style.display = 'none'
            }
        })
}

checkLogin()

function logout() {
    fetch('include/UserLogin/Controlador.php?acao=logout')
        .then(res => res.json())
        .then(data => {
            console.log(data);
            window.location.href = "../index.html";
        })
}