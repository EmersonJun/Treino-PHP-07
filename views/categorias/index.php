<?php require 'views/templates/header.php'; ?>
<div class="container mt-5">
    <a href="index.php?page=categorias&action=create" class="btn btn-success mb-3">Nova categoria</a>
    <table class="table table-bordered">
        <thead>
            <tr><th>Nome</th></tr>
        </thead>
        <tbody>
        <?php foreach ($categorias as $p): ?>
            <tr>
                <td><?= $p['nome'] ?></td>
                <td>
                    <a href="index.php?page=categorias&action=edit&id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="index.php?page=categorias &action=delete&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

