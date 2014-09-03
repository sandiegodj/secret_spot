<!DOCTYPE html>
<html>
    <head>
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>
        <?php if (isset($title)): ?>
            <title>Secret Spot <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Secret Spot</title>
        <?php endif ?>

        <script src="/js/jquery-1.10.2.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
            <a href="insert.php"><img alt="Secret Spot" src="/img/Secret Spot.gif"/></a>
            </div>

