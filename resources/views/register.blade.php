@extends('layout')

@section('page-title', 'Criar conta')

@section('content')
<div class="form-box">
    <h2 style="color:#d4af37;margin-bottom:24px;">Criar conta</h2>

    @if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Senha</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Telefone</label>
            <input type="tel" name="telefone" placeholder="31999999999" maxlength="11"
                oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
        </div>
        <button class="btn btn-gold" type="submit">Cadastrar</button>
    </form>
</div>
@endsection