<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sistema de Projetos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if (!empty($_SESSION['logado'])): ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=chamados">chamados</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=categorias">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=login&action=logout">Sair</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?page=login&action=showRegister">Cadastro</a></li>
                <?php endif; ?>
                <?php if ($_SESSION['tipo'] === 'admin'): ?>
    <li class="nav-item"><a class="nav-link" href="index.php?page=usuarios">Usuários</a></li>
<?php endif; ?>

            </ul>
        </div>
    </div>
</nav>
