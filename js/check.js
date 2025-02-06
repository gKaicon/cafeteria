const precisaLogin = document.currentScript.dataset.precisalogin

function checkLogin() {
    fetch('include/check.php')
        .then(res => res.json())
        .then(data => {
            if (precisaLogin == "true" && data.logado == "false") {
                window.location.href = "tela-login.html";
            }
            else if (data.logado == "true" && data.tipoUser == 0) {
                document.querySelector('#btn-login').style.display = 'none'
                document.querySelector('#btn-adm').style.display = 'block'
                document.querySelector('#btn-logout').style.display = 'block'
                return true;
            }
            else if (data.logado == "false" && data.tipoUser == 1) {
                document.querySelector('#btn-login').style.display = 'block'
                document.querySelector('#btn-adm').style.display = 'none'
                document.querySelector('#btn-logout').style.display = 'none'
                return false;
            }            
        })
}

checkLogin()

function logout() {
    fetch('include/logout.php')
        .then(res => res.json())
        .then(data => {
            window.location.reload();            
        })
}