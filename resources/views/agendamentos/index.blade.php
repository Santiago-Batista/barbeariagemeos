<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">
<title>Agendamentos - Barbearia MS</title>

<style>

body{
font-family:Arial, Helvetica, sans-serif;
background:#0a0a0a;
color:white;
padding:40px;
margin:0;
}

/* TOPO */

.topo{
margin-bottom:25px;
}

.btn-voltar{
background:#222;
padding:8px 16px;
color:#ccc;
text-decoration:none;
border-radius:6px;
transition:0.3s;
}

.btn-voltar:hover{
background:#d4af37;
color:black;
}

/* TITULO */

h2{
color:#d4af37;
margin-bottom:20px;
}

/* TABELA */

table{
width:100%;
border-collapse:collapse;
background:#151515;
border-radius:10px;
overflow:hidden;
box-shadow:0 0 15px rgba(0,0,0,0.7);
}

th,td{
padding:12px;
border-bottom:1px solid #333;
text-align:center;
}

th{
background:#1f1f1f;
color:#d4af37;
}

tr:nth-child(even){
background:#141414;
}

tr:hover{
background:#1f1f1f;
}

</style>

</head>

<body>

<div class="topo">

<a href="/dashboard" class="btn-voltar">⬅ Voltar ao Dashboard</a>

</div>

<h2>📅 Agendamentos</h2>

<table>

<tr>
<th>Cliente</th>
<th>Barbeiro</th>
<th>Serviço</th>
<th>Data</th>
<th>Hora</th>
</tr>

@foreach($agendamentos as $a)

<tr>

<td>{{ $a->cliente->nome }}</td>
<td>{{ $a->barbeiro }}</td>
<td>{{ $a->servico }}</td>
<td>{{ $a->data }}</td>
<td>{{ $a->hora }}</td>

</tr>

@endforeach

</table>

</body>

</html>