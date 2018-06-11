<?php require 'partials/head.php'; ?>
    <h2>All users</h2>
    <?php foreach ($users as $user) : ?>
        <li><?= $user->name; ?></li>
    <?php endforeach; ?>

    <h2>Add your name</h2>
    <form method="POST" action="/names">
        <input type="text" name="name">
        <button type="submit">submit</button>
    </form>
<?php require 'partials/footer.php'; ?>