<?php require 'views/templates/header.php'; ?>
<div class="container mt-5" style="max-width: 400px;">
    <h2>Cadastro de Usuário</h2>

    <?php if (!empty($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

    <form method="POST" action="index.php?page=login&action=register">
        <div class="mb-3">
            <label>Usuário</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>email</label>
            <input type="text" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <div class="mb-3">
        <label>Tipo de usuário</label>
            <select name="tipo" class="form-control" required>
                <option value="cliente">cliente</option>
                <option value="tecnico">tecnico</option>
            </select>
        </div>
        <button class="btn btn-success w-100">Cadastrar</button>
        <a href="index.php?page=login" class="btn btn-secondary w-100 mt-2">Voltar</a>
    </form>
</div>

