<?php
date_default_timezone_set('Europe/Moscow');

$title = "Global Internet - main page";
$current_page = "index.php";
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

        table {
            margin-bottom: 20px;
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
            color: #3E4A4A;
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

    <h2>About the Internet</h2>
    <h2>General overview</h2>

    <p>The Internet is a global network that connects millions of computers worldwide.</p>
    <p>It allows people to communicate instantly regardless of distance.</p>
    <p>Over time, it has transformed how people interact, work, and share knowledge.</p>

    <table>
        <?php echo "<tr><td>technology type</td><td>main purpose</td><td>global reach</td></tr>"; ?>
        <tr>
            <td><?php echo "digital network"; ?></td>
            <td><?php echo "communication and information sharing"; ?></td>
            <td><?php echo "worldwide"; ?></td>
        </tr>
    </table>

    <?php
    $img = (date('s') % 2 == 0) ? "images/internet1.jpg" : "images/internet2.jpg";
    echo '<img src="'.$img.'" width="300">';
    ?>

</main>

<footer>
    <?php echo "Formed on " . date("d.m.Y H:i:s"); ?>
</footer>

</body>
</html>