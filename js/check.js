const precisaLogin = document.currentScript.dataset.precisalogin
let logado;

function checkLogin() {
    fetch('include/UserLogin/Controlador.php?acao=check')
        .then(res => res.json())
        .then(data => {
            if (precisaLogin == "true" && data == false) {
                window.location.href = "tela-login.html";
            }
            logado = data

        }).then(() => {
            const login = document.querySelector('#btn-login')
            const adm = document.querySelector('#btn-adm')
            const logout = document.querySelector('#btn-logout')

            login.style.display = login && logado ? 'none' : 'inline-block'
            adm.style.display = adm && logado ? 'inline-block' : 'none'
            logout.style.display = logout && logado ? 'inline-block' : 'none'
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