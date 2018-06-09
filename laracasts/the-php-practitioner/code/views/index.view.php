<?php require 'partials/head.php'; ?>
    <h1>This is Index</h1>
    <h2>Submit your name</h2>
    <form method="POST" action="/names">
        <input type="text" name="name">
        <button type="submit">submit</button>
    </form>
<?php require 'partials/footer.php'; ?>