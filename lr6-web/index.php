<?php
header('Content-Type: text/html; charset=utf-8');

/* -----------------------------
   ФУНКЦИЯ ДЛЯ ЧИСЕЛ
------------------------------*/
function normalizeNumber($value)
{
    return floatval(str_replace(',', '.', trim($value)));
}

/* -----------------------------
   СЛУЧАЙНЫЕ ЧИСЛА
------------------------------*/
$randA = rand(0, 100);
$randB = rand(0, 100);
$randC = rand(0, 100);

/* -----------------------------
   ЕСЛИ ФОРМА ОТПРАВЛЕНА
------------------------------*/
if (isset($_POST['A']))
{
    $fio = htmlspecialchars($_POST['FIO']);
    $group = htmlspecialchars($_POST['GROUP']);
    $about = nl2br(htmlspecialchars($_POST['ABOUT']));
    $task = $_POST['TASK'];
    $view = $_POST['VIEW'];

    $A = normalizeNumber($_POST['A']);
    $B = normalizeNumber($_POST['B']);
    $C = normalizeNumber($_POST['C']);

    $user_answer = trim(str_replace(',', '.', $_POST['ANSWER']));

    $task_name = '';
    $result = 0;

    /* -----------------------------
       ВЫЧИСЛЕНИЯ
    ------------------------------*/

    switch ($task)
    {
        case 'triangle_area':
            $task_name = 'Площадь треугольника';
            $p = ($A + $B + $C) / 2;

            if (($p-$A)>0 && ($p-$B)>0 && ($p-$C)>0)
                $result = round(sqrt($p * ($p - $A) * ($p - $B) * ($p - $C)), 2);
            else
                $result = 0;
            break;

        case 'triangle_perimeter':
            $task_name = 'Периметр треугольника';
            $result = round($A + $B + $C, 2);
            break;

        case 'parallelepiped_volume':
            $task_name = 'Объем параллелепипеда';
            $result = round($A * $B * $C, 2);
            break;

        case 'average':
            $task_name = 'Среднее арифметическое';
            $result = round(($A + $B + $C) / 3, 2);
            break;

        case 'max':
            $task_name = 'Максимальное число';
            $result = max($A, $B, $C);
            break;

        case 'sum_squares':
            $task_name = 'Сумма квадратов';
            $result = round($A*$A + $B*$B + $C*$C, 2);
            break;
    }

    /* -----------------------------
       ПРОВЕРКА ОТВЕТА
    ------------------------------*/

    $success = false;

    if ($user_answer !== '')
    {
        if (abs($result - floatval($user_answer)) < 0.01)
        {
            $success = true;
        }
    }

    /* -----------------------------
       ФОРМИРУЕМ ОТЧЕТ
    ------------------------------*/

    $out_text = '';

    $out_text .= "<h2>Результаты теста</h2>";

    $out_text .= "<b>ФИО:</b> $fio <br>";
    $out_text .= "<b>Группа:</b> $group <br><br>";

    $out_text .= "<b>Немного о себе:</b><br>$about<br><br>";

    $out_text .= "<b>Тип задачи:</b> $task_name <br><br>";

    $out_text .= "<b>Входные данные:</b><br>";
    $out_text .= "A = $A <br>";
    $out_text .= "B = $B <br>";
    $out_text .= "C = $C <br><br>";

    if ($user_answer !== '')
    {
        $out_text .= "<b>Ваш ответ:</b> $user_answer <br>";
    }
    else
    {
        $out_text .= "<b>Ваш ответ:</b> Задача самостоятельно решена не была<br>";
    }

    $out_text .= "<b>Ответ программы:</b> $result <br><br>";

    if ($success)
    {
        $out_text .= "<h3 style='color:green'>ТЕСТ ПРОЙДЕН</h3>";
    }
    else
    {
        $out_text .= "<h3 style='color:red'>ОШИБКА: ТЕСТ НЕ ПРОЙДЕН</h3>";
    }

    /* -----------------------------
       ОТПРАВКА EMAIL
    ------------------------------*/

    $mail_message = '';

    if (isset($_POST['send_mail']))
    {
        $email = htmlspecialchars($_POST['MAIL']);

        @mail(
            $email,
            'Результаты теста',
            strip_tags(str_replace("<br>", "\r\n", $out_text)),
            "Content-type:text/plain;charset=UTF-8"
        );

        $mail_message =
            "<p style='color:blue'>
            Результаты теста были автоматически отправлены на e-mail: <b>$email</b>
            </p>";
    }

    ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Результаты теста</title>

<style>

body
{
    font-family: Arial;
    margin: 40px;
    overflow-x:hidden;

    <?php
    if ($view == 'browser')
        echo "background:#f4f4f4;";
    else
        echo "background:white;";
    ?>
}

.container
{
    width: 700px;
    margin: auto;
    background: white;
    padding: 30px;
    position: relative;
    z-index: 2;

    <?php
    if ($view == 'browser')
        echo "box-shadow:0 0 10px gray;";
    ?>
}

.repeat_btn
{
    display:inline-block;
    margin-top:20px;
    padding:12px 20px;
    background:#007BFF;
    color:white;
    text-decoration:none;
    border-radius:5px;
    border:1px solid #0056b3;
}

.repeat_btn:hover
{
    background:#0056b3;
}

/* =========================
   FISHES
========================= */

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

<div class="container">

<?php
echo $out_text;
echo $mail_message;

/* -----------------------------
   КНОПКА ПОВТОРИТЬ
------------------------------*/

if ($view == 'browser')
{
    echo '<a class="repeat_btn" href="?FIO=' .
        urlencode($fio) .
        '&GROUP=' .
        urlencode($group) .
        '">Повторить тест</a>';
}
?>

</div>

</body>
</html>

<?php
exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>

<meta charset="UTF-8">
<title>Математический тест</title>

<style>

body
{
    font-family: Arial;
    background: #f2f2f2;
    padding: 30px;
    overflow-x:hidden;
}

.form-box
{
    width: 700px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px gray;
    position: relative;
    z-index: 2;
}

.row
{
    display:flex;
    align-items:center;
    margin-bottom:15px;
}

label
{
    width:250px;
    font-weight:bold;
}

input[type=text],
input[type=email],
textarea,
select
{
    width:300px;
    padding:8px;
}

textarea
{
    height:100px;
}

button
{
    padding:12px 25px;
    background:#007BFF;
    color:white;
    border:none;
    cursor:pointer;
    border-radius:5px;
}

button:hover
{
    background:#0056b3;
}

#mail_block
{
    display:none;
}

/* =========================
   FISHES
========================= */

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

</style>

<script>

function toggleMail()
{
    let checkbox = document.getElementById('send_mail');
    let block = document.getElementById('mail_block');

    if (checkbox.checked)
        block.style.display = 'flex';
    else
        block.style.display = 'none';
}

</script>

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

<div class="form-box">

<h2>Математический тест</h2>

<form method="post" action="">

<div class="row">
<label>ФИО:</label>
<input type="text" name="FIO"
value="<?php echo isset($_GET['FIO']) ? htmlspecialchars($_GET['FIO']) : ''; ?>"
required>
</div>

<div class="row">
<label>Номер группы:</label>
<input type="text" name="GROUP"
value="<?php echo isset($_GET['GROUP']) ? htmlspecialchars($_GET['GROUP']) : ''; ?>"
required>
</div>

<div class="row">
<label>Значение A:</label>
<input type="text" name="A" value="<?php echo $randA; ?>" required>
</div>

<div class="row">
<label>Значение B:</label>
<input type="text" name="B" value="<?php echo $randB; ?>" required>
</div>

<div class="row">
<label>Значение C:</label>
<input type="text" name="C" value="<?php echo $randC; ?>" required>
</div>

<div class="row">
<label>Ваш ответ:</label>
<input type="text" name="ANSWER">
</div>

<div class="row">
<label>Немного о себе:</label>
<textarea name="ABOUT"></textarea>
</div>

<div class="row">
<label>Выберите задачу:</label>

<select name="TASK">

<option value="triangle_area">
Площадь треугольника
</option>

<option value="triangle_perimeter">
Периметр треугольника
</option>

<option value="parallelepiped_volume">
Объем параллелепипеда
</option>

<option value="average">
Среднее арифметическое
</option>

<option value="max">
Максимальное число
</option>

<option value="sum_squares">
Сумма квадратов
</option>

</select>
</div>

<div class="row">
<label>Отправить результат по e-mail:</label>

<input
type="checkbox"
name="send_mail"
id="send_mail"
onclick="toggleMail()">
</div>

<div class="row" id="mail_block">
<label>Ваш e-mail:</label>
<input type="email" name="MAIL">
</div>

<div class="row">
<label>Версия страницы:</label>

<select name="VIEW">

<option value="browser">
Версия для просмотра в браузере
</option>

<option value="print">
Версия для печати
</option>

</select>
</div>

<div class="row">
<label></label>
<button type="submit">Проверить</button>
</div>

</form>

</div>

</body>
</html>