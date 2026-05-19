<!-- result.php -->

<?php
header('Content-Type: text/html; charset=UTF-8');

$text = $_POST['text'] ?? '';
$text = trim($text);

function getWords($text)
{
    preg_match_all('/[a-zA-Zа-яА-ЯёЁ]+/u', $text, $matches);
    return $matches[0];
}

function toLowerCase($text)
{
    $upper = [
        'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й',
        'К','Л','М','Н','О','П','Р','С','Т','У','Ф',
        'Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
    ];

    $lower = [
        'а','б','в','г','д','е','ё','ж','з','и','й',
        'к','л','м','н','о','п','р','с','т','у','ф',
        'х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я'
    ];

    return strtr(strtolower($text), array_combine($upper, $lower));
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результат анализа</title>

    <style>

        table {
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }

        .source-text {
            color: blue;
            font-style: italic;
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

        body
        {
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

<h2>Результат анализа</h2>

<?php if ($text === ''): ?>

    <p>Нет текста для анализа</p>

<?php else: ?>

    <h3>Исходный текст:</h3>

    <p class="source-text">
        <?= nl2br(htmlspecialchars($text, ENT_QUOTES, 'UTF-8')) ?>
    </p>

    <?php
    // 1. Количество символов (включая пробелы)
    $charactersCount = count(
        preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY)
    );

    // 2. Количество букв
    preg_match_all('/[a-zA-Zа-яА-ЯёЁ]/u', $text, $letters);
    $lettersCount = count($letters[0]);

    // 3. Количество строчных букв
    preg_match_all('/[a-zа-яё]/u', $text, $lowerLetters);
    $lowerCount = count($lowerLetters[0]);

    // 4. Количество заглавных букв
    preg_match_all('/[A-ZА-ЯЁ]/u', $text, $upperLetters);
    $upperCount = count($upperLetters[0]);

    // 5. Количество знаков препинания
    preg_match_all('/[.,!?;:()"\'«»—\-]/u', $text, $punctuation);
    $punctuationCount = count($punctuation[0]);

    // 6. Количество цифр
    preg_match_all('/\d/u', $text, $digits);
    $digitsCount = count($digits[0]);

    // 7. Количество слов
    $words = getWords($text);
    $wordsCount = count($words);

    // 8. Количество вхождений каждого символа
    $textLower = toLowerCase($text);

    $charactersArray = preg_split(
        '//u',
        $textLower,
        -1,
        PREG_SPLIT_NO_EMPTY
    );

    $characterOccurrences = [];

    foreach ($charactersArray as $char) {
        if (isset($characterOccurrences[$char])) {
            $characterOccurrences[$char]++;
        } else {
            $characterOccurrences[$char] = 1;
        }
    }

    ksort($characterOccurrences);

    // 9. Список слов и количество вхождений
    $wordOccurrences = [];

    foreach ($words as $word) {
        $word = toLowerCase($word);

        if (isset($wordOccurrences[$word])) {
            $wordOccurrences[$word]++;
        } else {
            $wordOccurrences[$word] = 1;
        }
    }

    ksort($wordOccurrences);
    ?>

    <h3>Информация о тексте:</h3>

    <table>
        <tr>
            <th>Параметр</th>
            <th>Значение</th>
        </tr>

        <tr>
            <td>Количество символов (включая пробелы)</td>
            <td><?= $charactersCount ?></td>
        </tr>

        <tr>
            <td>Количество букв</td>
            <td><?= $lettersCount ?></td>
        </tr>

        <tr>
            <td>Количество строчных букв</td>
            <td><?= $lowerCount ?></td>
        </tr>

        <tr>
            <td>Количество заглавных букв</td>
            <td><?= $upperCount ?></td>
        </tr>

        <tr>
            <td>Количество знаков препинания</td>
            <td><?= $punctuationCount ?></td>
        </tr>

        <tr>
            <td>Количество цифр</td>
            <td><?= $digitsCount ?></td>
        </tr>

        <tr>
            <td>Количество слов</td>
            <td><?= $wordsCount ?></td>
        </tr>
    </table>

    <h3>Количество вхождений каждого символа:</h3>

    <table>
        <tr>
            <th>Символ</th>
            <th>Количество</th>
        </tr>

        <?php foreach ($characterOccurrences as $char => $count): ?>
            <tr>
                <td>
                    <?= htmlspecialchars($char, ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td><?= $count ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h3>Список слов и количество вхождений:</h3>

    <table>
        <tr>
            <th>Слово</th>
            <th>Количество</th>
        </tr>

        <?php foreach ($wordOccurrences as $word => $count): ?>
            <tr>
                <td>
                    <?= htmlspecialchars($word, ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td><?= $count ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>

<br>

<a href="index.html">
    Другой анализ
</a>

</body>
</html>