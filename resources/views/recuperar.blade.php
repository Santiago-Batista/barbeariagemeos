<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Recuperar Senha - Barbearia MS</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #0a0a0a;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
        }

        .titulo {
            color: #d4af37;
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 25px;
            letter-spacing: 3px;
        }

        .login-box {
            background: #151515;
            padding: 40px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
        }

        .login-box h2 {
            color: white;
            margin-bottom: 10px;
        }

        .login-box p {
            color: #aaa;
            font-size: 14px;
            margin-bottom: 25px;
        }

        label {
            color: #bbb;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 18px;
            border: none;
            border-radius: 6px;
            background: #222;
            color: white;
            box-sizing: border-box; /* Garante que o padding não estoure a largura */
        }

        input:focus {
            outline: none;
            background: #2a2a2a;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #d4af37;
            border: none;
            border-radius: 6px;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #c19b2e;
            transform: scale(1.03);
        }

        .register {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
            font-size: 14px;
        }

        .register a {
            color: #d4af37;
            text-decoration: none;
            font-weight: bold;
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* Estilo para as mensagens de erro/sucesso */
        .status-msg {
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 13px;
        }
        .success { background: rgba(0, 128, 0, 0.2); color: #4ade80; border: 1px solid #4ade80; }
        .error { background: rgba(255, 0, 0, 0.2); color: #f87171; border: 1px solid #f87171; }
    </style>
</head>

<body>

    <div class="container">

        <div class="titulo">
            Barbearia MS
        </div>

        <div class="login-box">

            <h2>Recuperar Senha</h2>
            <p>Enviaremos um link de recuperação para o seu e-mail.</p>

            {{-- Alerta de Sucesso --}}
            @if (session('status'))
                <div class="status-msg success">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Alerta de Erro --}}
            @if ($errors->has('email'))
                <div class="status-msg error">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <label>Seu E-mail de cadastro</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus>

                <button type="submit">Enviar Link</button>

            </form>

            <div class="register">
                <a href="/">Voltar para o Login</a>
            </div>

        </div>

    </div>

</body>

</html>