<?php
date_default_timezone_set('Europe/Moscow');
$title = "Development";
$current_page = "page1.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
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

        table {
            border-collapse: collapse;
        }

        td {
            padding: 8px;
            border: 1px solid #5E8B7E;
        }

        footer {
            background: #2F5D62;
            color: #C9D6D5;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
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
    <h2>Internet Development</h2>
    <h2>Key stages</h2>

    <p>The Internet began as a research project connecting universities.</p>
    <p>It rapidly expanded with the invention of the World Wide Web.</p>

    <table>
        <tr>
            <td>Period</td>
            <td>Event</td>
            <td>Impact</td>
        </tr>
        <tr>
            <td>1960s</td>
            <td>ARPANET creation</td>
            <td>First network connection</td>
        </tr>
        <tr>
            <td>1990s</td>
            <td>World Wide Web</td>
            <td>Public global access</td>
        </tr>
    </table>
</main>

<footer>
    <?php echo "Formed on " . date("d.m.Y H:i:s"); ?>
</footer>

</body>
</html>