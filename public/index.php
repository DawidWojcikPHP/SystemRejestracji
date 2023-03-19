<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

?>

<!doctype html>
<html>
<head>
<link rel="stylesheet" href"style.css" />
<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
<header>
    <div id="container">
    <div><h1><pre>Witaj na stronie gry Osadnicy!</pre></h1></div>
</header>
    <main>
        <div><a href="/registration"><pre>Nie masz konta? Zarejestruj się!</pre></a></div>
    </main>
    </div>
</body>
</html>