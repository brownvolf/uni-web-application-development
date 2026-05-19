<?php

$startTime = microtime(true);

$array = $_POST['array'] ?? [];
$algorithm = $_POST['algorithm'] ?? '';

$iterationCount = 0;
$steps = [];

function saveStep(&$steps, &$iterationCount, $array)
{
    $iterationCount++;

    $steps[] = [
        'iteration' => $iterationCount,
        'array' => $array
    ];
}

function selectionSort($array, &$steps, &$iterationCount)
{
    $n = count($array);

    for ($i = 0; $i < $n - 1; $i++) {

        $minIndex = $i;

        for ($j = $i + 1; $j < $n; $j++) {

            if ($array[$j] < $array[$minIndex]) {
                $minIndex = $j;
            }

            saveStep($steps, $iterationCount, $array);
        }

        $temp = $array[$i];
        $array[$i] = $array[$minIndex];
        $array[$minIndex] = $temp;

        saveStep($steps, $iterationCount, $array);
    }

    return $array;
}

function bubbleSort($array, &$steps, &$iterationCount)
{
    $n = count($array);

    for ($i = 0; $i < $n - 1; $i++) {

        for ($j = 0; $j < $n - $i - 1; $j++) {

            if ($array[$j] > $array[$j + 1]) {

                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }

            saveStep($steps, $iterationCount, $array);
        }
    }

    return $array;
}

function shellSort($array, &$steps, &$iterationCount)
{
    $n = count($array);

    for ($gap = floor($n / 2); $gap > 0; $gap = floor($gap / 2)) {

        for ($i = $gap; $i < $n; $i++) {

            $temp = $array[$i];
            $j = $i;

            while ($j >= $gap && $array[$j - $gap] > $temp) {

                $array[$j] = $array[$j - $gap];
                $j -= $gap;

                saveStep($steps, $iterationCount, $array);
            }

            $array[$j] = $temp;

            saveStep($steps, $iterationCount, $array);
        }
    }

    return $array;
}

function gnomeSort($array, &$steps, &$iterationCount)
{
    $index = 0;
    $n = count($array);

    while ($index < $n) {

        if ($index == 0) {
            $index++;
        }

        if ($index < $n && $array[$index] >= $array[$index - 1]) {
            $index++;
        } else if ($index < $n) {

            $temp = $array[$index];
            $array[$index] = $array[$index - 1];
            $array[$index - 1] = $temp;

            $index--;

            saveStep($steps, $iterationCount, $array);
        }

        if ($index < $n) {
            saveStep($steps, $iterationCount, $array);
        }
    }

    return $array;
}

function quickSort($array, &$steps, &$iterationCount)
{
    if (count($array) < 2) {
        return $array;
    }

    $pivot = $array[0];

    $left = [];
    $right = [];

    for ($i = 1; $i < count($array); $i++) {

        if ($array[$i] <= $pivot) {
            $left[] = $array[$i];
        } else {
            $right[] = $array[$i];
        }

        saveStep($steps, $iterationCount, $array);
    }

    return array_merge(
        quickSort($left, $steps, $iterationCount),
        [$pivot],
        quickSort($right, $steps, $iterationCount)
    );
}

function phpSort($array, &$steps, &$iterationCount)
{
    sort($array);

    saveStep($steps, $iterationCount, $array);

    return $array;
}

$algorithmNames = [
    'selection' => 'Сортировка выбором',
    'bubble' => 'Пузырьковый алгоритм',
    'shell' => 'Алгоритм Шелла',
    'gnome' => 'Алгоритм садового гнома',
    'quick' => 'Быстрая сортировка',
    'phpsort' => 'Встроенная функция PHP sort()'
];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат сортировки</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .step {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            background: rgba(255,255,255,0.9);
            border-radius: 8px;
        }

        .warning {
            color: red;
            font-weight: bold;
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

        .content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>

<!-- FISHES -->

<div class="fish-container">

    <div class="fish fish-left"
         style="top:5%; animation-duration:18s;">
         &lt;^[[[&gt;&lt;
    </div>

    <div class="fish fish-right"
         style="top:20%; animation-duration:25s;">
         &gt;&lt;]]]^&gt;
    </div>

    <div class="fish fish-left"
         style="top:35%; animation-duration:14s;">
         &lt;^[[[&gt;&lt;
    </div>

    <div class="fish fish-right"
         style="top:50%; animation-duration:22s;">
         &gt;&lt;]]]^&gt;
    </div>

    <div class="fish fish-left"
         style="top:70%; animation-duration:30s;">
         &lt;^[[[&gt;&lt;
    </div>

    <div class="fish fish-right"
         style="top:85%; animation-duration:16s;">
         &gt;&lt;]]]^&gt;
    </div>

</div>
<!-- ---------------------------------хвост-рыбов--------------------------------- -->

<div class="content">

<h1>Результат сортировки</h1>

<?php

echo "<h2>Алгоритм: " . ($algorithmNames[$algorithm] ?? "Не выбран") . "</h2>";

if (empty($array)) {
    echo "<p class='warning'>
            Предупреждение: входные данные отсутствуют.
          </p>";

    exit();
}

echo "<h3>Входные данные:</h3>";
echo implode(", ", $array);

$isValid = true;

foreach ($array as $value) {

    if (!is_numeric($value)) {
        $isValid = false;
        break;
    }
}

echo "<h3>Проверка валидности:</h3>";

if ($isValid) {
    echo "Все элементы массива являются числами.";
} else {

    echo "<p class='warning'>
            Ошибка: среди элементов массива есть нечисловые значения.
          </p>";

    exit();
}

$array = array_map('floatval', $array);

switch ($algorithm) {

    case 'selection':
        $sortedArray = selectionSort($array, $steps, $iterationCount);
        break;

    case 'bubble':
        $sortedArray = bubbleSort($array, $steps, $iterationCount);
        break;

    case 'shell':
        $sortedArray = shellSort($array, $steps, $iterationCount);
        break;

    case 'gnome':
        $sortedArray = gnomeSort($array, $steps, $iterationCount);
        break;

    case 'quick':
        $sortedArray = quickSort($array, $steps, $iterationCount);
        break;

    case 'phpsort':
        $sortedArray = phpSort($array, $steps, $iterationCount);
        break;

    default:
        echo "<p class='warning'>
                Не выбран алгоритм сортировки.
              </p>";
        exit();
}

echo "<h3>Процесс сортировки:</h3>";

foreach ($steps as $step) {

    echo "<div class='step'>";
    echo "<strong>Итерация "
        . $step['iteration']
        . ":</strong><br>";

    echo implode(", ", $step['array']);
    echo "</div>";
}

$endTime = microtime(true);
$executionTime = $endTime - $startTime;

echo "<h2>
        Сортировка завершена, проведено
        $iterationCount итераций.
      </h2>";

echo "<h2>
        Сортировка заняла
        $executionTime секунд.
      </h2>";

echo "<h3>Итоговый массив:</h3>";
echo implode(", ", $sortedArray);

?>

</div>

</body>
</html>