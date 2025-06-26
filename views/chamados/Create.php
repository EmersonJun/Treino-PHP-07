<?php require 'views/templates/header.php'; ?>
<div class="container mt-5">
    <h2>Novo Chamado</h2>

    <form method="POST" action="index.php?page=chamados&action=store" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Prioridade</label>
            <select name="prioridade" class="form-select" required>
                <option value="baixa">Baixa</option>
                <option value="media">Média</option>
                <option value="alta">Alta</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="id_categoria" class="form-select" required>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Anexo (opcional - imagem ou PDF)</label>
            <input type="file" name="arquivo" class="form-control" accept=".png,.jpg,.jpeg,.pdf">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
