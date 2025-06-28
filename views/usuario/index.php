<?php require 'views/templates/header.php'; ?>
<div class="container mt-5">
    <h2>Usuários</h2>
    <table class="table">
        <thead>
            <tr><th>Nome</th><th>Email</th><th>Tipo</th><th>Ações</th></tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['nome']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= $u['tipo'] ?></td>
                    <td>
                        <?php if ($u['tipo'] !== 'admin'): ?>
                            <a href="index.php?page=usuarios&action=delete&id=<?= $u['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
