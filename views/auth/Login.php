<?php require 'views/templates/header.php'; ?>
<div class="container mt-5" style="max-width: 400px;">
    <h2>Login</h2>

    <?php if (!empty($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
    <?php if (!empty($sucesso)) echo "<div class='alert alert-success'>$sucesso</div>"; ?>

    <form method="POST" action="index.php?page=login&action=login">
        <div class="mb-3">
            <label>email</label>
            <input type="text" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        
        
        <button class="btn btn-primary w-100">Entrar</button>
        <a href="index.php?page=login&action=showRegister" class="btn btn-link w-100 mt-2">Criar conta</a>
    </form>
</div>

