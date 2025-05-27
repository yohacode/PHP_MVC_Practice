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
        <?= $content ?? '<p>Welcome to my site!</p>' ?>
        <p>Author: <?= $author ?? 'Unknown' ?></p>
        <p>Description: <?= $description ?? 'No description provided.' ?></p>
        <p>Keywords: <?= $keywords ?? 'No keywords provided.' ?></p>
        <p>Name: <?= $name ?? 'Guest' ?></p>
        <p>Current Year: <?= date('Y') ?></p>
        <p>Current Date: <?= date('Y-m-d H:i:s') ?></p>
        <p>Current Time: <?= date('H:i:s') ?></p>
        <p>Current Timestamp: <?= time() ?></p>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> My Site</p>
    </footer>

    <!-- Script -->
     <script src="/dist/bundle.js"></script>
</body>
</html>