<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    HOLAAAA <br>
    <a href="index.php">
        <button onclick="<?php session_start();echo session_destroy()?>">log out</button>
    </a>
</body>
</html>