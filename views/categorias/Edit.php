<?php require 'views/templates/header.php'; ?>

<div class="container mt-5">
    <h2>Editar Projeto</h2>
    <form method="POST" action="index.php?page=projetos&action=update" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

        <div class="mb-3">
            <label class="form-label">nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
        </div>
        <button class="btn btn-primary">Salvar</button>
        <a href="index.php?page=projetos" class="btn btn-secondary">Cancelar</a>
    </form>
</di
