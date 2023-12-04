<?php
    include_once("templates/header.php");
?>
    <div class="container">
        <?php if(isset($printMsg) && $printMsg != ''): ?>
            <p id="msg"><?= $printMsg ?></p>
        <?php endif; ?>
        <h1 id="main-title">Minha Agenda</h1>
        <?php if(count($contacts) > 0 ): ?>
            <table class="table" id="contacts-table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Telefone</th>
                        <th scope="col"></th>
                    </tr>
                    <tbody>
                        <?php foreach($contacts as $contato): ?>
                            <tr>
                                <td scope="row" class="col-id"><?= $contato["id"] ?> </td>
                                <td scope="row"><?= $contato["name"] ?> </td>
                                <td scope="row"><?= $contato["phone"] ?> </td>
                                <td class="actions">
                                    <a href="<?= $BASE_URL ?>show.php?id=<?= $contato["id"] ?>"><i class="fas fa-eye check-icon"></i></a>
                                    <a href="<?= $BASE_URL ?>edit.php?id=<?= $contato["id"] ?>"><i class="fas fa-edit edit-icon"></i></a>
                                    <form class="delete-form" action="<?= $BASE_URL ?>/config/process.php" method="POST">
                                        <input type="hidden" name="type" value="delete">
                                        <input type="hidden" name="id" value="<?= $contato["id"] ?>">
                                        <button type="submit" class="delete-btn"><if class="fas fa-times delete-icon"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>    
                    </tbody>
                </thead>
            </table>
        <?php else: ?>
            <p id="empty-list-text">Ainda não há contatos na sua agenda, <a href="<?= $BASE_URL ?>create.php">Clique aqui para adicionar</a>.</p>
        <?php endif; ?>
    </div>

<?php
    include_once("templates/footer.php");
?>
