<?php require_once 'views/templates/header.php'; ?>

<div class="container mt-5">
    <h2>Resolver Chamado</h2>

    <div class="card mb-3">
        <div class="card-header bg-light">
            <strong><?= htmlspecialchars($chamado['titulo']) ?></strong>
        </div>
        <div class="card-body">
            <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($chamado['descricao'])) ?></p>
            <p><strong>Prioridade:</strong> <?= ucfirst($chamado['prioridade']) ?></p>
            <p><strong>Status atual:</strong> <?= ucfirst(str_replace('_', ' ', $chamado['statuss'])) ?></p>
        </div>
    </div>

    <p class="text-danger">Após confirmar, o chamado será marcado como <strong>resolvido</strong> e não poderá ser editado.</p>

    <form method="POST" action="index.php?page=chamados&action=confirmar_resolver">
    <input type="hidden" name="id" value="<?= $chamado['id'] ?>">
    <button type="submit" class="btn btn-success">Confirmar Resolução</button>
    <a href="index.php?page=chamados" class="btn btn-secondary">Cancelar</a>
</form>

</div>
