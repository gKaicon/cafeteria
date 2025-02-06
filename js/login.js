document.querySelector('#login-form').addEventListener('submit', () => {
    event.preventDefault();
    let dados = {
        entrada: document.getElementById('entrada').value,
        password: document.getElementById('password').value,
    }
    fetch('include/UserLogin/Controlador.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dados)
    })
        .then(response => {
            if (!response.ok) {
                console.log(response);
                throw new Error('Network response was not ok. Error:' + response);
            }
        })
        .then(data => { 
            window.location.href = "index.html";
        })
        .catch(error => { console.error('Error:', error); });

})
