<?php
// File: app/views/layouts/main.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'My Site' ?></title>
</head>
<body>
    <header>
        <h1>My Site Header</h1>
    </header>

    <main>
        <?= $content ?? '' ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> My Site</p>
    </footer>

    <!-- Script -->
     <script src="/dist/bundle.js"></script>
</body>
</html>