<?php
// --------------------
// ПАРАМЕТРЫ
// --------------------

$html_type = $_GET['html_type'] ?? 'table';
$content = $_GET['content'] ?? 'all';

// Проверка допустимых значений
if ($html_type !== 'table' && $html_type !== 'block') {
    $html_type = 'table';
}

$allowed_content = ['all', '2', '3', '4', '5', '6', '7', '8', '9'];

if (!in_array($content, $allowed_content)) {
    $content = 'all';
}

// --------------------
// ФУНКЦИЯ СОЗДАНИЯ ССЫЛКИ НА ЦИФРУ
// --------------------

function makeNumberLink($number)
{
    if ($number >= 2 && $number <= 9) {
        return '<a href="?content=' . $number . '">' . $number . '</a>';
    }

    return $number;
}

// --------------------
// ИНФОРМАЦИЯ
// --------------------

$layout_name = ($html_type == 'table') ? 'Табличная верстка' : 'Блочная верстка';

$table_name = ($content == 'all')
    ? 'Полная таблица умножения'
    : 'Таблица умножения на ' . $content;

$date_time = date('d.m.Y H:i:s');

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица умножения</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #ffffff;
            overflow-x: hidden;
        }

        /* --------------------------------- */
        /* ГОЛОВА РЫБОВ */
        /* --------------------------------- */

        .fish-container
        {
            position: fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;
            overflow:hidden;
            pointer-events:none;
            z-index:1;
        }

        .fish
        {
            position:absolute;
            white-space:nowrap;
            font-size:40px;
            opacity:0.75;
            color:#0044cc;
            text-shadow:0 0 10px #66aaff;
        }

        .fish-left
        {
            animation: swimLeft linear infinite;
        }

        .fish-right
        {
            animation: swimRight linear infinite;
        }

        @keyframes swimLeft
        {
            from
            {
                transform:translateX(100vw);
            }

            to
            {
                transform:translateX(-300px);
            }
        }

        @keyframes swimRight
        {
            from
            {
                transform:translateX(-300px);
            }

            to
            {
                transform:translateX(100vw);
            }
        }

        /* =========================
           MAIN CONTENT OVER FISHES
        ========================= */

        main,
        .container,
        .wrapper,
        .content,
        .header,
        .sidebar,
        .footer
        {
            position:relative;
            z-index:2;
        }

        /* -------------------- */
        /* ВЕРХНЕЕ МЕНЮ */
        /* -------------------- */

        .header {
            background: #333;
            padding: 15px;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            padding: 8px 12px;
            border-radius: 5px;
        }

        .active-top {
            background: orange;
        }

        /* -------------------- */
        /* ОСНОВНАЯ СТРУКТУРА */
        /* -------------------- */

        .container {
            display: flex;
            min-height: 500px;
        }

        /* -------------------- */
        /* ЛЕВОЕ МЕНЮ */
        /* -------------------- */

        .sidebar {
            width: 150px;
            background: rgba(240,240,240,0.95);
            padding: 15px;
            box-sizing: border-box;
        }

        .sidebar a {
            display: block;
            margin-bottom: 10px;
            text-decoration: none;
            color: black;
            padding: 10px;
            border-radius: 5px;
        }

        .active-side {
            background: lightblue;
            font-weight: bold;
        }

        /* -------------------- */
        /* ОСНОВНАЯ ОБЛАСТЬ */
        /* -------------------- */

        .content {
            flex: 1;
            padding: 20px;
            overflow-x: auto;
            box-sizing: border-box;
            background: rgba(255,255,255,0.9);
        }

        /* -------------------- */
        /* ТАБЛИЧНАЯ ВЕРСТКА */
        /* -------------------- */

        table {
            border-collapse: collapse;
            background: white;
        }

        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            min-width: 140px;
            height: 45px;
            box-sizing: border-box;
        }

        /* -------------------- */
        /* БЛОЧНАЯ ВЕРСТКА */
        /* -------------------- */

        .block-wrapper {
            display: flex;
            flex-wrap: wrap;
        }

        .block-item {
            border: 1px solid black;
            min-width: 140px;
            min-height: 45px;
            padding: 5px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: -1px 0 0 -1px;
            box-sizing: border-box;
            background: white;
        }

        /* -------------------- */
        /* БОЛЬШАЯ ТАБЛИЦА */
        /* -------------------- */

        .big {
            font-size: 28px;
            font-weight: bold;
        }

        /* -------------------- */
        /* ПОДВАЛ */
        /* -------------------- */

        .footer {
            background: rgba(221,221,221,0.95);
            padding: 15px;
        }

        /* -------------------- */
        /* ССЫЛКИ В ТАБЛИЦЕ */
        /* -------------------- */

        .content a {
            color: darkblue;
            text-decoration: none;
            font-weight: bold;
        }

        .content a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<!-- FISHES -->

<div class="fish-container">

    <div class="fish fish-left"
         style="top:5%; animation-duration:18s;">
         <^[[[><
    </div>

    <div class="fish fish-right"
         style="top:20%; animation-duration:25s;">
         ><]]]^>
    </div>

    <div class="fish fish-left"
         style="top:35%; animation-duration:14s;">
         <^[[[><
    </div>

    <div class="fish fish-right"
         style="top:50%; animation-duration:22s;">
         ><]]]^>
    </div>

    <div class="fish fish-left"
         style="top:70%; animation-duration:30s;">
         <^[[[><
    </div>

    <div class="fish fish-right"
         style="top:85%; animation-duration:16s;">
         ><]]]^>
    </div>

</div>

<!-- ГЛАВНОЕ МЕНЮ -->

<div class="header">

    <a href="?html_type=table&content=<?php echo $content; ?>"
       class="<?php echo (isset($_GET['html_type']) && $html_type == 'table') ? 'active-top' : ''; ?>">
        Табличная верстка
    </a>

    <a href="?html_type=block&content=<?php echo $content; ?>"
       class="<?php echo ($html_type == 'block') ? 'active-top' : ''; ?>">
        Блочная верстка
    </a>

</div>

<div class="container">

    <!-- БОКОВОЕ МЕНЮ -->

    <div class="sidebar">

        <a href="?html_type=<?php echo $html_type; ?>&content=all"
           class="<?php echo ($content == 'all') ? 'active-side' : ''; ?>">
            Всё
        </a>

        <?php for ($i = 2; $i <= 9; $i++): ?>

            <a href="?html_type=<?php echo $html_type; ?>&content=<?php echo $i; ?>"
               class="<?php echo ($content == $i) ? 'active-side' : ''; ?>">
                <?php echo $i; ?>
            </a>

        <?php endfor; ?>

    </div>

    <!-- ОСНОВНАЯ ЧАСТЬ -->

    <div class="content">

        <?php if ($html_type == 'table'): ?>

            <table>

                <?php

                if ($content == 'all') {

                    for ($row = 1; $row <= 10; $row++) {

                        echo '<tr>';

                        for ($col = 2; $col <= 9; $col++) {

                            $result = $row * $col;

                            echo '<td>';

                            echo makeNumberLink($col);
                            echo ' × ';
                            echo makeNumberLink($row);
                            echo ' = ';
                            echo makeNumberLink($result);

                            echo '</td>';
                        }

                        echo '</tr>';
                    }

                } else {

                    for ($row = 1; $row <= 10; $row++) {

                        $result = $row * $content;

                        echo '<tr>';
                        echo '<td class="big">';

                        echo makeNumberLink($content);
                        echo ' × ';
                        echo makeNumberLink($row);
                        echo ' = ';
                        echo makeNumberLink($result);

                        echo '</td>';
                        echo '</tr>';
                    }
                }

                ?>

            </table>

        <?php else: ?>

            <div class="block-wrapper">

                <?php

                if ($content == 'all') {

                    for ($row = 1; $row <= 10; $row++) {

                        for ($col = 2; $col <= 9; $col++) {

                            $result = $row * $col;

                            echo '<div class="block-item">';

                            echo makeNumberLink($col);
                            echo ' × ';
                            echo makeNumberLink($row);
                            echo ' = ';
                            echo makeNumberLink($result);

                            echo '</div>';
                        }
                    }

                } else {

                    for ($row = 1; $row <= 10; $row++) {

                        $result = $row * $content;

                        echo '<div class="block-item big">';

                        echo makeNumberLink($content);
                        echo ' × ';
                        echo makeNumberLink($row);
                        echo ' = ';
                        echo makeNumberLink($result);

                        echo '</div>';
                    }
                }

                ?>

            </div>

        <?php endif; ?>

    </div>

</div>

<!-- ПОДВАЛ -->

<div class="footer">

    <p><strong>Тип верстки:</strong> <?php echo $layout_name; ?></p>

    <p><strong>Название:</strong> <?php echo $table_name; ?></p>

    <p><strong>Дата и время:</strong> <?php echo $date_time; ?></p>

</div>

</body>
</html>