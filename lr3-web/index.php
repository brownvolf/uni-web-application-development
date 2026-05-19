<?php
session_start();

// Инициализация
if (!isset($_SESSION['result'])) {
    $_SESSION['result'] = '';
}

if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
}

// Нажатие цифры
if (isset($_GET['num'])) {
    $_SESSION['result'] .= $_GET['num'];
    $_SESSION['count']++;

    header("Location: index.php");
    exit;
}

// Сброс
if (isset($_GET['reset'])) {
    $_SESSION['result'] = '';
    $_SESSION['count']++;

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>PHP Кнопки</title>

<style>
/*---------------------------------голова-рыбов---------------------------------*/
.fish-container {
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    overflow:hidden;
    pointer-events:none;
    z-index:1;
}

.fish {
    position:absolute;
    white-space:nowrap;
    font-size:40px;
    opacity:0.75;
    color:#0044cc;
    text-shadow:0 0 10px #66aaff;
}

.fish-left {
    animation: swimLeft linear infinite;
}

.fish-right {
    animation: swimRight linear infinite;
}

@keyframes swimLeft {
    from { transform:translateX(100vw); }
    to { transform:translateX(-300px); }
}

@keyframes swimRight {
    from { transform:translateX(-300px); }
    to { transform:translateX(100vw); }
}

/* MAIN ABOVE FISHES */
.display, .buttons, .footer {
    position:relative;
    z-index:2;
}

/*---------------------------------интерфейс---------------------------------*/
body {
    font-family: Arial;
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
}

.display {
    width: 300px;
    height: 60px;
    border: 2px solid #000;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 20px;
    background: white;
}

.buttons {
    display: grid;
    grid-template-columns: repeat(5, 60px);
    gap: 10px;
}

a.button {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 50px;
    background: #e0e0e0;
    text-decoration: none;
    color: #000;
    border-radius: 5px;
    font-size: 18px;
}

a.button:hover {
    background: #cfcfcf;
}

a.reset {
    grid-column: 1 / -1;
    width: 100%;
}

.footer {
    margin-top: 30px;
    font-size: 16px;
    background: white;
    padding: 5px 10px;
}
</style>
</head>

<body>

<!-- FISHES -->
<div class="fish-container">

    <div class="fish fish-left" style="top:5%; animation-duration:18s;">
        <^[[[><
    </div>

    <div class="fish fish-right" style="top:20%; animation-duration:25s;">
        ><]]]^>
    </div>

    <div class="fish fish-left" style="top:35%; animation-duration:14s;">
        <^[[[><
    </div>

    <div class="fish fish-right" style="top:50%; animation-duration:22s;">
        ><]]]^>
    </div>

    <div class="fish fish-left" style="top:70%; animation-duration:30s;">
        <^[[[><
    </div>

    <div class="fish fish-right" style="top:85%; animation-duration:16s;">
        ><]]]^>
    </div>

</div>

<!-- UI -->
<div class="display">
    <?php echo $_SESSION['result']; ?>
</div>

<div class="buttons">

    <?php for ($i = 1; $i <= 5; $i++): ?>
        <a class="button" href="?num=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php for ($i = 6; $i <= 9; $i++): ?>
        <a class="button" href="?num=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <a class="button" href="?num=0">0</a>

    <a class="button reset" href="?reset=1">СБРОС</a>

</div>

<div class="footer">
    Общее число нажатий: <?php echo $_SESSION['count']; ?>
</div>

</body>
</html>