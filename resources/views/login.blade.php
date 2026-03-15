<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login - Barbearia MS</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#0a0a0a;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
}

.container{
    text-align:center;
}

.titulo{
    color:#d4af37;
    font-size:42px;
    font-weight:bold;
    margin-bottom:25px;
    letter-spacing:3px;
}

.login-box{
    background:#151515;
    padding:40px;
    border-radius:10px;
    width:320px;
    box-shadow:0 0 20px rgba(0,0,0,0.8);
}

.login-box h2{
    color:white;
    margin-bottom:25px;
}

label{
    color:#bbb;
    font-size:14px;
}

input{
    width:100%;
    padding:12px;
    margin-top:8px;
    margin-bottom:18px;
    border:none;
    border-radius:6px;
    background:#222;
    color:white;
}

input:focus{
    outline:none;
    background:#2a2a2a;
}

button{
    width:100%;
    padding:12px;
    background:#d4af37;
    border:none;
    border-radius:6px;
    color:black;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#c19b2e;
    transform:scale(1.03);
}

.register{
    text-align:center;
    margin-top:15px;
    color:#aaa;
}

.register a{
    color:#d4af37;
    text-decoration:none;
    font-weight:bold;
}

.register a:hover{
    text-decoration:underline;
}

</style>
</head>

<body>

<div class="container">

<div class="titulo">
Barbearia MS
</div>

<div class="login-box">

<h2>Login</h2>

<form method="POST" action="/login">

@csrf

<label>Email</label>
<input type="email" name="email" required>

<label>Senha</label>
<input type="password" name="password" required>

<button type="submit">Entrar</button>

</form>

<div class="register">
<p>Não tem conta?</p>
<a href="/register">Criar conta</a>
</div>

</div>

</div>

</body>
</html>