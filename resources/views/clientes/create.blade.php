@extends('layout')

@section('content')

<style>

.form-container{
max-width:500px;
background:#151515;
padding:30px;
border-radius:10px;
border-left:4px solid #d4af37;
box-shadow:0 0 15px rgba(0,0,0,0.7);
}

.form-container h2{
color:#d4af37;
margin-bottom:25px;
}

label{
color:#ccc;
font-weight:bold;
}

input{
width:100%;
padding:10px;
margin-top:6px;
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
background:#d4af37;
border:none;
padding:10px 16px;
border-radius:6px;
font-weight:bold;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#c19b2e;
transform:scale(1.03);
}

</style>

<div class="form-container">

<h2>💈 Novo Cliente</h2>

<form method="POST" action="/clientes">

@csrf

<label>Nome</label>
<input type="text" name="nome" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Telefone</label>
<input type="text" name="telefone" placeholder="31999999999" required>

<button type="submit">Salvar</button>

</form>

</div>

@endsection