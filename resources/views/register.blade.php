@extends('layout')

@section('content')

<style>

.cadastro-container{
    display:flex;
    justify-content:center;
    align-items:center;
    height:80vh;
}

.cadastro-box{
    background:#151515;
    padding:40px;
    border-radius:10px;
    width:350px;
    box-shadow:0 0 20px rgba(0,0,0,0.8);
}

.cadastro-box h2{
    text-align:center;
    color:#d4af37;
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

</style>

<div class="cadastro-container">

<div class="cadastro-box">

<h2>Cadastrar</h2>

<form method="POST" action="/register">

@csrf

<label>Nome</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Senha</label>
<input type="password" name="password" required>

<label>Telefone</label>
<input 
type="tel"
name="telefone"
placeholder="31999999999"
maxlength="11"
required
oninput="this.value = this.value.replace(/[^0-9]/g, '')">

<button type="submit">Cadastrar</button>

</form>

</div>

</div>

@endsection