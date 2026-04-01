<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Barbearia MS</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
    font-family:Arial,Helvetica,sans-serif;
    background:#0a0a0a;
    color:white;
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:220px;
    min-height:100vh;
    background:#111;
    border-right:1px solid #d4af37;
    display:flex;
    flex-direction:column;
    position:fixed;
    top:0;
    left:0;
    bottom:0;
}

/* Classes de apoio para as fontes e logos da sidebar */
.sidebar-logo{ padding:24px 20px; border-bottom:1px solid #222; }
.sidebar-logo .nome{ color:#d4af37; font-size:17px; font-weight:bold; letter-spacing:2px; }
.sidebar-logo .sub{ color:#555; font-size:11px; margin-top:3px; letter-spacing:1px; }
.sidebar-menu{ padding:16px 12px; flex:1; }
.sidebar-menu a{ display:flex; align-items:center; gap:10px; padding:10px 12px; margin-bottom:4px; color:#aaa; text-decoration:none; border-radius:6px; font-size:13px; font-weight:bold; transition:0.2s; border-left:3px solid transparent; }
.sidebar-menu a:hover, .sidebar-menu a.active{ background:#1a1a1a; color:#d4af37; border-left:3px solid #d4af37; }
.sidebar-menu .icon{ font-size:15px; width:18px; text-align:center; }
.sidebar-bottom{ padding:16px; border-top:1px solid #222; }
.sidebar-user{ display:flex; align-items:center; gap:10px; }
.avatar{ width:34px; height:34px; border-radius:50%; background:#d4af37; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:bold; color:#000; flex-shrink:0; }
.user-name{ color:#ccc; font-size:13px; font-weight:bold; }
.user-role{ color:#555; font-size:11px; }

/* MAIN CONTAINER */
.main {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    /* Se NÃO for registro, deixa o espaço da sidebar */
    margin-left: {{ request()->is('register') ? '0' : '220px' }};
}

/* TOPBAR */
.topbar{
    background:#111;
    padding:14px 28px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #222;
    position:sticky;
    top:0;
    z-index:10;
    width: 100%;
}

.topbar-title{ color:#fff; font-size:15px; font-weight:bold; }
.btn-sair{ background:transparent; border:1px solid #d4af37; color:#d4af37; padding:6px 16px; border-radius:5px; font-size:12px; font-weight:bold; cursor:pointer; transition:0.2s; }
.btn-sair:hover{ background:#d4af37; color:#000; }

/* CONTEÚDO */
.content{
    padding:32px 28px;
    flex:1;
    display: flex;
    flex-direction: column;
    {{-- Se for registro, centraliza o form vertical e horizontalmente --}}
    @if(request()->is('register'))
        align-items: center;
        justify-content: center;
    @endif
}

/* FORMULÁRIO */
.form-box{
    width: 100%;
    max-width:400px;
    background:#151515;
    padding:32px;
    border-radius:10px;
    border-left:4px solid #d4af37;
}
.form-group{ margin-bottom:18px; }
.form-group label{ display:block; color:#bbb; font-size:13px; font-weight:bold; margin-bottom:6px; }
.form-group input{ width:100%; padding:10px 12px; background:#222; border:1px solid #2a2a2a; border-radius:6px; color:white; }
.btn-gold{ background:#d4af37; color:#000; padding:10px 20px; border-radius:5px; font-weight:bold; border:none; cursor:pointer; width:100%; }

/* Outros estilos omitidos para brevidade, mas mantidos no seu código original */
</style>
</head>
<body>

{{-- Mostra a Sidebar APENAS se não for registro --}}
@if(!request()->is('register'))
<div class="sidebar">
    <div class="sidebar-logo">
        <div class="nome">✂ Barbearia MS</div>
        <div class="sub">{{ session('user_role') == 'admin' ? 'PAINEL ADMIN' : 'ÁREA DO CLIENTE' }}</div>
    </div>
    <div class="sidebar-menu">
        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}"><span class="icon">◈</span> Dashboard</a>
        @if(session('user_role') == 'admin')
            <a href="/agendamentos"><span class="icon">◷</span> Agendamentos</a>

            <a href="/relatorios" class="{{ request()->is('relatorios') ? 'active' : '' }}"><span class="icon">📊</span> Relatórios</a>

        @else
            <a href="/agendar"><span class="icon">◷</span> Agendar Corte</a>
        @endif
    </div>
</div>
@endif

<div class="main">
    {{-- A Topbar permanece sempre, inclusive no registro --}}
    <div class="topbar">
        <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        <form method="POST" action="/logout">
            @csrf
            <button class="btn-sair" type="submit">Sair</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

</body>
</html>