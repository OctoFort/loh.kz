<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>loh.kz</title>
    <style>
        .strikethrough {
            position: relative;
            display: inline-block; /* Чтобы псевдоэлемент правильно позиционировался */
        }

        .strikethrough::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 50%; /* Позиционируем линию по центру текста */
            height: 5px; /* Толщина линии */
            background: black; /* Цвет линии */
            transform: translateY(100%); /* Сдвигаем на половину высоты линии */
        }
    </style>
</head>
<body class="h-screen bg-cyan-100 flex items-center justify-center">
<h1 class="text-2xl font-bold ">Привет, <span class="strikethrough">мир</span> лохи!</h1>
</body>
</html>
