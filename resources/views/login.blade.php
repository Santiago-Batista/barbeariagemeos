<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
<title>Login - Barbearia MS</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:Arial,Helvetica,sans-serif;
    background:#0a0a0a;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}
.wrapper{text-align:center;}
.logo{
    color:#d4af37;
    font-size:36px;
    font-weight:bold;
    letter-spacing:4px;
    margin-bottom:8px;
}
.logo-sub{
    color:#555;
    font-size:12px;
    letter-spacing:2px;
    margin-bottom:32px;
}
.box{
    background:#151515;
    padding:36px 40px;
    border-radius:10px;
    width:340px;
    border-top:3px solid #d4af37;
}
.box h2{
    color:#fff;
    font-size:18px;
    margin-bottom:24px;
}
.form-group{margin-bottom:16px;text-align:left;}
.form-group label{
    display:block;
    color:#bbb;
    font-size:12px;
    font-weight:bold;
    margin-bottom:6px;
    letter-spacing:0.5px;
}
.form-group input{
    width:100%;
    padding:11px 12px;
    background:#222;
    border:1px solid #2a2a2a;
    border-radius:6px;
    color:white;
    font-size:13px;
    transition:0.2s;
}
.form-group input:focus{
    outline:none;
    border-color:#d4af37;
    background:#2a2a2a;
}
.btn-login{
    width:100%;
    padding:12px;
    background:#d4af37;
    border:none;
    border-radius:6px;
    color:#000;
    font-weight:bold;
    font-size:14px;
    cursor:pointer;
    margin-top:8px;
    transition:0.2s;
}
.btn-login:hover{background:#c19b2e;}
.link-register{
    margin-top:20px;
    color:#666;
    font-size:13px;
}
.link-register a{
    color:#d4af37;
    text-decoration:none;
    font-weight:bold;
}
.link-register a:hover{text-decoration:underline;}
.alert-error{
    background:#2a0a0a;
    border-left:3px solid #e57373;
    color:#e57373;
    padding:10px 14px;
    border-radius:6px;
    margin-bottom:18px;
    font-size:13px;
    text-align:left;
}
</style>
</head>
<body>
<div class="wrapper">
    <div class="logo">✂ Barbearia MS</div>
    <div class="logo-sub">BEM-VINDO DE VOLTA</div>

    <div class="box">
        <h2>Entrar na conta</h2>

        @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required autofocus>
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" required>
            </div>
            <button class="btn-login" type="submit">Entrar</button>
        </form>

        <div class="link-register">
            Não tem conta? <a href="/register">Criar conta</a>
        </div>
        <div class="link-register">
            Esqueçeu sua senha? <a href="/recuperar">Recuperar senha</a>
        </div>
    </div>
</div>
</body>

</html>