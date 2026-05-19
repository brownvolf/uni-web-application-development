<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сортировка массива</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .element-row {
            margin-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 100px;
        }

        button {
            margin-top: 10px;
            margin-right: 10px;
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

    <h1>Ввод массива</h1>

    <form action="sort.php" method="post" target="_blank">

        <div id="array-container">
            <div class="element-row">
                <label>Элемент 1:</label>
                <input type="text" name="array[]">
            </div>
        </div>

        <br>

        <label>Алгоритм:</label>

        <select name="algorithm">
            <option value="selection">Сортировка выбором</option>
            <option value="bubble">Пузырьковый алгоритм</option>
            <option value="shell">Алгоритм Шелла</option>
            <option value="gnome">Алгоритм садового гнома</option>
            <option value="quick">Быстрая сортировка</option>
            <option value="phpsort">Встроенная функция PHP sort()</option>
        </select>

        <br><br>

        <button type="button" onclick="addElement()">
            Добавить еще один элемент
        </button>

        <button type="submit">
            Сортировать массив
        </button>

    </form>

</div>

<script>
    let counter = 1;

    function addElement() {
        counter++;

        const container = document.getElementById("array-container");

        const div = document.createElement("div");
        div.className = "element-row";

        div.innerHTML =
            `<label>Элемент ${counter}:</label>
             <input type="text" name="array[]">`;

        container.appendChild(div);
    }
</script>

</body>
</html>