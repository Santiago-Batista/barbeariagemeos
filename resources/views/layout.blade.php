<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Barbearia MS</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#0a0a0a;
    color:white;
    margin:0;
}

/* NAVBAR */

nav{
    background:#151515;
    padding:15px 40px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    border-bottom:2px solid #d4af37;
}

.logo{
    font-size:24px;
    font-weight:bold;
    color:#d4af37;
    letter-spacing:2px;
}

.menu a{
    color:#ccc;
    margin-right:20px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.menu a:hover{
    color:#d4af37;
}

/* BOTAO SAIR */

.logout-btn{
    padding:8px 15px;
    background:#d4af37;
    border:none;
    border-radius:5px;
    color:black;
    font-weight:bold;
    cursor:pointer;
}

.logout-btn:hover{
    background:#c19b2e;
}

/* CONTEUDO */

.container{
    padding:40px;
}

/* TABELA */

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

th,td{
    border:1px solid #333;
    padding:12px;
}

th{
    background:#1f1f1f;
    color:#d4af37;
}

tr:nth-child(even){
    background:#141414;
}

/* BOTÕES */

button{
    padding:8px 12px;
    border:none;
    border-radius:4px;
    cursor:pointer;
}

</style>
</head>

<body>

<nav>

<div class="logo">
💈 Barbearia MS
</div>

<div class="menu">

<a href="/dashboard">Dashboard</a>

@auth
@if(auth()->user()->role == 'admin')
<a href="/clientes">Clientes</a>
@endif
@endauth

<a href="/agendamentos">Agendamentos</a>

</div>

@auth
<form action="/logout" method="POST">
@csrf
<button class="logout-btn" type="submit">Sair</button>
</form>
@endauth

</nav>

<div class="container">
@yield('content')
</div>

</body>
</html>