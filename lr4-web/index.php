<!--localhost:8000
php -S localhost:8000-->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Лабораторная работа PHP</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5fbff;
        }

        h2 {
            color: #003366;
        }

        table {
            border-collapse: collapse;
            margin-bottom: 30px;
            background: white;
        }

        td {
            border: 1px solid black;
            padding: 8px 12px;
            min-width: 80px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /*---------------------------------голова-рыбов---------------------------------*/
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
        .content
        {
            position:relative;
            z-index:2;
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
<!-- ---------------------------------хвост-рыбов--------------------------------- -->

<main>

<?php

/*
    Количество колонок таблицы
*/
$columnsCount = 4;

/*
    Массив минимум из 10 элементов
*/
$tables = [
    "A1*A2*A3#B1*B2*B3",
    "PHP*HTML*CSS#JS*SQL",
    "One*Two#Three*Four*Five",
    "Red*Green*Blue",
    "Dog*Cat#Lion*Tiger",
    "Apple*Banana#Orange*Kiwi",
    "Math*Physics#History*Biology",
    "Car*Bus*Train#Plane",
    "Monday*Tuesday#Wednesday*Thursday",
    "Table*Row*Cell#Data1*Data2"
];

/*
    ФУНКЦИЯ ФОРМИРОВАНИЯ СТРОКИ ТАБЛИЦЫ
*/
function createRow($rowData, $columnsCount)
{
    $cells = explode("*", $rowData);

    $hasCells = false;

    foreach ($cells as $cell) {
        if (trim($cell) != "") {
            $hasCells = true;
            break;
        }
    }

    // Если в строке нет ячеек — HTML не выводим
    if (!$hasCells) {
        return "";
    }

    $html = "<tr>";

    // Таблица всегда имеет одинаковое число колонок
    for ($i = 0; $i < $columnsCount; $i++) {

        if (isset($cells[$i]) && trim($cells[$i]) != "") {
            $html .= "<td>" . htmlspecialchars($cells[$i]) . "</td>";
        } else {
            $html .= "<td></td>";
        }
    }

    $html .= "</tr>";

    return $html;
}

/*
    ФУНКЦИЯ ВЫВОДА HTML-КОДА ТАБЛИЦЫ
*/
function createTable($tableStructure, $columnsCount)
{
    // Неправильное число колонок
    if ($columnsCount <= 0) {
        return "<div class='error'>Неправильное число колонок</div>";
    }

    // Нет строк
    if (trim($tableStructure) == "") {
        return "<div class='error'>В таблице нет строк</div>";
    }

    $rows = explode("#", $tableStructure);

    if (count($rows) == 0) {
        return "<div class='error'>В таблице нет строк</div>";
    }

    $tableHtml = "";
    $rowsWithCells = 0;

    foreach ($rows as $row) {

        $rowHtml = createRow($row, $columnsCount);

        // Если строка содержит ячейки
        if ($rowHtml != "") {

            if ($rowsWithCells == 0) {
                $tableHtml .= "<table>";
            }

            $tableHtml .= $rowHtml;
            $rowsWithCells++;
        }
    }

    // Нет строк с ячейками
    if ($rowsWithCells == 0) {
        return "<div class='error'>В таблице нет строк с ячейками</div>";
    }

    $tableHtml .= "</table>";

    return $tableHtml;
}

/*
    ВЫВОД ВСЕХ ТАБЛИЦ
*/
for ($i = 0; $i < count($tables); $i++) {

    // Заголовок перед каждой таблицей
    echo "<h2>Таблица №" . ($i + 1) . "</h2>";

    // Вывод таблицы
    echo createTable($tables[$i], $columnsCount);
}

?>

</main>

</body>
</html>
