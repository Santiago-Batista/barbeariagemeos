<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Senha - Barbearia MS</title>
    <style>
        body { font-family: Arial, sans-serif; background: #0a0a0a; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { text-align: center; }
        .titulo { color: #d4af37; font-size: 42px; font-weight: bold; margin-bottom: 25px; letter-spacing: 3px; }
        .login-box { background: #151515; padding: 40px; border-radius: 10px; width: 320px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.8); }
        .login-box h2 { color: white; margin-bottom: 20px; }
        label { color: #bbb; font-size: 14px; display: block; text-align: left; }
        input { width: 100%; padding: 12px; margin-top: 8px; margin-bottom: 18px; border: none; border-radius: 6px; background: #222; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #d4af37; border: none; border-radius: 6px; color: black; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { background: #c19b2e; transform: scale(1.03); }
        .error-msg { color: #f87171; font-size: 13px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="titulo">Barbearia MS</div>
        <div class="login-box">
            <h2>Nova Senha</h2>
            
            @if ($errors->any())
                <div class="error-msg">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                
                <label>E-mail</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" required readonly>

                <label>Nova Senha</label>
                <input type="password" name="password" placeholder="Mínimo 8 caracteres" required autofocus>

                <label>Confirmar Senha</label>
                <input type="password" name="password_confirmation" placeholder="Repita a senha" required>

                <button type="submit">Salvar Nova Senha</button>
            </form>
        </div>
    </div>
</body>
</html>