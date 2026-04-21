<?php
date_default_timezone_set('Europe/Moscow');
$title = "Impact";
$current_page = "page2.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>

    <style>
        @font-face {
            font-family: 'BitcountGridDouble';
            src: url('fonts/BitcountGridDouble.ttf') format('truetype');
            font-weight: normal;
        }

        @font-face {
            font-family: 'BitcountGridDouble';
            src: url('fonts/BitcountGridDouble.ttf') format('truetype');
            font-weight: bold;
        }

        body {
            margin: 0;
            font-family: 'BitcountGridDouble', sans-serif;
        }

        header {
            background: #2F5D62;
            color: #F3EDE4;
            padding: 20px;
            position: fixed;
            top: 0;
            width: 100%;
        }

        footer {
            background: #2F5D62;
            color: #C9D6D5;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        nav a {
            margin-right: 15px;
            color: #E6D5C3;
            text-decoration: none;
            transition: 0.3s;
        }

        nav a:hover {
            color: #ffffff;
        }

        .selected_menu {
            font-weight: bold;
            text-decoration: underline;
        }

        main {
            background: #91bfa6;
            color: #3E4A4A; /* ← исправлено */
            margin-top: 130px;
            margin-bottom: 60px;
            padding: 15px;
        }
    </style>
</head>

<body>

<header>
    <h1>Global Internet</h1>

    <nav>
        <a href="<?php $name='Main'; $link='index.php'; echo $link; ?>"
        <?php if ($current_page == $link) echo 'class="selected_menu"'; ?>>
        <?php echo $name; ?></a>

        <a href="<?php $name='Development'; $link='page1.php'; echo $link; ?>"
        <?php if ($current_page == $link) echo 'class="selected_menu"'; ?>>
        <?php echo $name; ?></a>

        <a href="<?php $name='Impact'; $link='page2.php'; echo $link; ?>"
        <?php if ($current_page == $link) echo 'class="selected_menu"'; ?>>
        <?php echo $name; ?></a>
    </nav>
</header>

<main>
    <h2>Global Impact</h2>
    <h2>Connecting people</h2>

    <p>The Internet has brought people from different countries closer together.</p>
    <p>It enables communication, collaboration, and cultural exchange worldwide.</p>
    <p>Social networks and messaging platforms help maintain friendships across continents.</p>
</main>

<footer>
    <?php echo "Formed on " . date("d.m.Y H:i:s"); ?>
</footer>

</body>
</html>