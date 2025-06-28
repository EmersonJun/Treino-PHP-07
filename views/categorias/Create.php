<?php require 'views/templates/header.php'; ?>

<div class="container mt-5">
    <h2>Novo Projeto</h2>
    <form method="POST" action="index.php?page=categorias&action=store" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <button class="btn btn-primary">Salvar</button>
        <a href="index.php?page=projetos" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
