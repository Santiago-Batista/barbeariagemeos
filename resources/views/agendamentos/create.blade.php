<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>Agendar Corte - Barbearia MS</title>

<style>

body{
background:#0a0a0a;
font-family:Arial, Helvetica, sans-serif;
color:white;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
margin:0;
}

/* CAIXA */

.container{
background:#151515;
padding:40px;
border-radius:10px;
width:380px;
box-shadow:0 0 20px rgba(0,0,0,0.7);
border-left:4px solid #d4af37;
}

/* TITULO */

h2{
color:#d4af37;
margin-top:0;
text-align:center;
margin-bottom:20px;
}

/* CLIENTE */

.cliente{
text-align:center;
margin-bottom:20px;
color:#ccc;
}

/* LABEL */

label{
margin-top:10px;
display:block;
color:#ccc;
font-weight:bold;
}

/* INPUTS */

input,select{
width:100%;
padding:10px;
margin-top:6px;
background:#222;
border:none;
color:white;
border-radius:6px;
}

input:focus,select:focus{
outline:none;
background:#2a2a2a;
}

/* BOTAO AGENDAR */

button{
margin-top:20px;
width:100%;
padding:12px;
background:#d4af37;
border:none;
color:black;
border-radius:6px;
font-weight:bold;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#c19b2e;
transform:scale(1.03);
}

/* BOTAO VOLTAR */

.btn-voltar{
display:inline-block;
margin-bottom:15px;
padding:8px 14px;
background:#222;
color:#ccc;
text-decoration:none;
border-radius:6px;
font-size:14px;
transition:0.2s;
}

.btn-voltar:hover{
background:#d4af37;
color:black;
}

</style>

</head>

<body>

<div class="container">

<a href="{{ route('dashboard') }}" class="btn-voltar">← Voltar ao Dashboard</a>

<h2>💈 Agendar Corte</h2>

<p class="cliente">Cliente: {{ session('user_name') }}</p>

<form method="POST" action="/agendar">

@csrf

<label>Barbeiro</label>

<select name="barbeiro">

<option value="João">João</option>
<option value="Carlos">Carlos</option>
<option value="Pedro">Pedro</option>

</select>

<label>Serviço</label>

<select name="servico">

<option value="Corte">Corte</option>
<option value="Barba">Barba</option>
<option value="Corte + Barba">Corte + Barba</option>

</select>

<label>Data</label>
<input type="date" name="data" required>

<label>Horário</label>

<select name="hora" required>

<option value="">Selecione o horário</option>

@for($i = 9; $i <= 19; $i++)

@if($i != 12)

<option value="{{ sprintf('%02d:00',$i) }}">
{{ sprintf('%02d:00',$i) }}
</option>

@endif

@endfor

</select>

<button>Agendar</button>

</form>

</div>

</body>
</html>