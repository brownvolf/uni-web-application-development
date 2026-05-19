<!--localhost:8000
php -S localhost:8000-->

<!DOCTYPE html>
<html lang="ru">
<head>

<style>

body
{
    overflow-x:hidden;
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

/* =========================
   TABLE STYLES
========================= */

table
{
    border-collapse:collapse;
    width:80%;
    margin:auto;
}

th,
td
{
    border:2px solid #0044cc;
    padding:10px;
    text-align:center;
}

th
{
    background:#66aaff;
    color:white;
}

</style>

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

<!-- ---------------------------------хвост-рыбов--------------------------------- -->

</div>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>
    Зайцев Богдан Михайлович - Группа 241-353 - Лабораторная работа №2
</title>

<link rel="stylesheet" href="styles.css">

</head>

<body>

<header>

    <img src="logo.png"
         alt="Логотип университета"
         class="logo">

    <div class="header-text">

        <h1>
            Зайцев Богдан Михайлович
        </h1>

        <p>
            Группа: 241-353
        </p>

        <p>
            Лабораторная работа №2
        </p>

    </div>

</header>

<main>

<?php

/*
|--------------------------------------------------------------------------
| НАСТРОЙКИ
|--------------------------------------------------------------------------
*/

// Начальное значение x
$startX = 0;

// Количество вычисляемых значений
$count = 25;

// Шаг изменения x
$step = 1;

// Минимальное значение функции
$minFunction = -1000;

// Максимальное значение функции
$maxFunction = 1000;

// Тип верстки: A B C D E
$layoutType = 'D';


/*
|--------------------------------------------------------------------------
| МАССИВ ДЛЯ ХРАНЕНИЯ ЗНАЧЕНИЙ
|--------------------------------------------------------------------------
*/

$results = [];


/*
|--------------------------------------------------------------------------
| ВЫЧИСЛЕНИЕ ФУНКЦИИ
|--------------------------------------------------------------------------
*/

for ($i = 0; $i < $count; $i++) {

    $x = $startX + ($i * $step);

    $y = null;

    // 1 случай
    if ($x <= 10) {

        $y = ($x * $x * 0.33) + 4;
    }

    // 2 случай
    elseif ($x > 10 && $x < 20) {

        $y = (18 * $x) - 3;
    }

    // 3 случай
    else {

        $denominator = ($x * 0.1) - 2;

        if ($denominator == 0) {

            $y = "error";
        }
        else {

            $y = (1 / $denominator) + 3;
        }
    }

    // Округление
    if ($y !== "error") {

        $y = round($y, 3);

        // Проверка ограничений
        if ($y < $minFunction || $y > $maxFunction) {

            break;
        }
    }

    $results[] = [
        "x" => $x,
        "y" => $y
    ];
}


/*
|--------------------------------------------------------------------------
| ВЫВОД РЕЗУЛЬТАТОВ
|--------------------------------------------------------------------------
*/

echo "<h2>Результаты вычислений</h2>";


// ---------------------------------------------------------------------
// A — простой текст
// ---------------------------------------------------------------------

if ($layoutType == 'A') {

    foreach ($results as $item) {

        echo "f(" . $item['x'] . ") = " . $item['y'] . "<br>";
    }
}


// ---------------------------------------------------------------------
// B — маркированный список
// ---------------------------------------------------------------------

elseif ($layoutType == 'B') {

    echo "<ul>";

    foreach ($results as $item) {

        echo "<li>";
        echo "f(" . $item['x'] . ") = " . $item['y'];
        echo "</li>";
    }

    echo "</ul>";
}


// ---------------------------------------------------------------------
// C — нумерованный список
// ---------------------------------------------------------------------

elseif ($layoutType == 'C') {

    echo "<ol>";

    foreach ($results as $item) {

        echo "<li>";
        echo "f(" . $item['x'] . ") = " . $item['y'];
        echo "</li>";
    }

    echo "</ol>";
}


// ---------------------------------------------------------------------
// D — таблица
// ---------------------------------------------------------------------

elseif ($layoutType == 'D') {

    echo "<table>";

    echo "<tr>";
    echo "<th>№</th>";
    echo "<th>X</th>";
    echo "<th>F(X)</th>";
    echo "</tr>";

    $number = 1;

    foreach ($results as $item) {

        echo "<tr>";

        echo "<td>" . $number . "</td>";
        echo "<td>" . $item['x'] . "</td>";
        echo "<td>" . $item['y'] . "</td>";

        echo "</tr>";

        $number++;
    }

    echo "</table>";
}


// ---------------------------------------------------------------------
// E — блочная верстка
// ---------------------------------------------------------------------

elseif ($layoutType == 'E') {

    echo '<div class="blocks-container">';

    foreach ($results as $item) {

        echo '<div class="result-block">';
        echo "f(" . $item['x'] . ") = " . $item['y'];
        echo '</div>';
    }

    echo '</div>';
}


/*
|--------------------------------------------------------------------------
| СТАТИСТИКА
|--------------------------------------------------------------------------
*/

$numericValues = [];

foreach ($results as $item) {

    if ($item['y'] !== "error") {

        $numericValues[] = $item['y'];
    }
}

if (count($numericValues) > 0) {

    $maxValue = max($numericValues);

    $minValue = min($numericValues);

    $sumValue = round(array_sum($numericValues), 3);

    $averageValue = round(
        array_sum($numericValues) / count($numericValues),
        3
    );

    echo "<div class='statistics'>";

    echo "<h2>Статистика</h2>";

    echo "<p>Максимальное значение: " . $maxValue . "</p>";

    echo "<p>Минимальное значение: " . $minValue . "</p>";

    echo "<p>Сумма значений: " . $sumValue . "</p>";

    echo "<p>Среднее арифметическое: " . $averageValue . "</p>";

    echo "</div>";
}

?>

</main>

<footer>

    Тип верстки:
    <?php echo $layoutType; ?>

</footer>

</body>
</html>