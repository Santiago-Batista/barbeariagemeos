@extends('layout')

@section('content')

<h2>Cadastrar</h2>

<form method="POST" action="/register">
@csrf

<label>Nome</label>
<input type="text" name="name">

<label>Email</label>
<input type="email" name="email">

<label>Senha</label>
<input type="password" name="password">

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

@endsection