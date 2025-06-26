<?php require 'views/templates/header.php'; ?>
<div class="container mt-5">
    <h2>Editar chamado</h2>
    <form method="POST" action="index.php?page=chamados&action=update" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $chamado['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($chamado['titulo']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"><?= htmlspecialchars($chamado['descricao']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="id_categoria" class="form-select" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= ($chamado['id_categoria'] == $cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Prioridade</label>
            <select name="prioridade" class="form-select" required>
                <option value="baixa" <?= $chamado['prioridade'] == 'baixa' ? 'selected' : '' ?>>Baixa</option>
                <option value="media" <?= $chamado['prioridade'] == 'media' ? 'selected' : '' ?>>Média</option>
                <option value="alta" <?= $chamado['prioridade'] == 'alta' ? 'selected' : '' ?>>Alta</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="aberto" <?= $chamado['statuss'] == 'aberto' ? 'selected' : '' ?>>Aberto</option>
                <option value="em_andamento" <?= $chamado['statuss'] == 'em_andamento' ? 'selected' : '' ?>>Em andamento</option>
                <option value="resolvido" <?= $chamado['statuss'] == 'resolvido' ? 'selected' : '' ?>>Resolvido</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Arquivo atual:</label><br>
            <?php if (!empty($chamado['arquivo'])): ?>
                <a href="uploads/chamados/<?= $chamado['arquivo'] ?>" target="_blank"><?= $chamado['arquivo'] ?></a>
            <?php else: ?>
                Nenhum arquivo enviado.
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Novo arquivo (opcional):</label>
            <input type="file" name="arquivo" class="form-control">
        </div>

        <button class="btn btn-primary">Salvar</button>
    </form>
</div>
