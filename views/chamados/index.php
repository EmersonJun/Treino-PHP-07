<?php require 'views/templates/header.php'; ?>
<div class="container mt-5">
    <?php if ($_SESSION['tipo'] === 'cliente'): ?>
        <a href="index.php?page=chamados&action=create" class="btn btn-success mb-3">Novo chamado</a>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Descrição</th>
                <th>Prioridade</th>
                <th>Status</th>
                <th>Categoria</th>
                <th>
    <?php
        if ($_SESSION['tipo'] === 'cliente') {
            echo 'Técnico';
        } elseif ($_SESSION['tipo'] === 'tecnico') {
            echo 'Usuário';
        } else {
            echo 'Usuário'; // para admin ou outro tipo
        }
    ?>
</th>


                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($chamados as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['titulo']) ?></td>
                <td><?= htmlspecialchars(substr($p['descricao'], 0, 50)) ?>...</td>
                <td>
                    <span class="badge bg-<?= 
                        $p['prioridade'] === 'alta' ? 'danger' : (
                        $p['prioridade'] === 'media' ? 'warning' : 'secondary') ?>">
                        <?= ucfirst($p['prioridade']) ?>
                    </span>
                </td>
                <td>
                    <span class="badge bg-<?= 
                        $p['statuss'] === 'aberto' ? 'primary' : (
                        $p['statuss'] === 'em_andamento' ? 'warning' : 'success') ?>">
                        <?= ucfirst(str_replace('_', ' ', $p['statuss'])) ?>
                    </span>
                </td>
                <td><?= htmlspecialchars($p['categoria_nome'] ?? '—') ?></td>
                <td>
    <?php
        if ($_SESSION['tipo'] === 'cliente') {
            echo !empty($p['tecnico_nome']) ? htmlspecialchars($p['tecnico_nome']) : '—';
        } if ($_SESSION['tipo'] === 'tecnico')  {
            echo !empty($p['cliente_nome']) ? htmlspecialchars($p['cliente_nome']) : '—';
        }
    ?>
</td>


                <td>
                    <?php if ($_SESSION['tipo'] === 'cliente' && $p['id_cliente'] == $_SESSION['id']): ?>
                        <a href="index.php?page=chamados&action=edit&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?page=chamados&action=delete&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                    <?php elseif ($_SESSION['tipo'] === 'tecnico'): ?>
                        <?php if (empty($p['id_tecnico'])): ?>
                            <a href="index.php?page=chamados&action=assumir&id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">Assumir</a>
                        <?php elseif ($p['id_tecnico'] == $_SESSION['id'] && $p['statuss'] !== 'resolvido'): ?>
                            <a href="index.php?page=chamados&action=resolver&id=<?= $p['id'] ?>" class="btn btn-success btn-sm">Resolver</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
