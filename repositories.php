<?php
include_once 'curl.php';

$token = 'b593d5e843c65c79f907179edf0bfc6f78d30243'; // Token generado
$url = 'https://api.github.com/user/repos';
$crud = new curl;
$result = $crud->get($url, $token);
$resultado_json = (json_decode($result));

if ((isset($_REQUEST['repositori']))) {
    echo '<h1 style="color: purple">' . $_REQUEST['repositori'] . ' de ' . $_REQUEST['user'] . '</h1>';

    $url_commits = 'https://api.github.com/repos/' . $_REQUEST['user'] . '/' . $_REQUEST['repositori'] . '/commits';
    $result = $crud->get($url_commits, $token);
    $resultado_json = (json_decode($result));
    //print_r($resultado_json);

    foreach ($resultado_json as $repositori) {
        echo '<br>AUTOR: ' . $repositori->commit->author->name;
        echo '<br>FECHA: ' . $repositori->commit->committer->date;
        echo '<br>TITULO: ' . $repositori->commit->message;
        echo '<br>';
    }

    $url_readme = 'https://api.github.com/repos/' . $_REQUEST['user'] . '/' . $_REQUEST['repositori'] . '';
    $result = $crud->get($url_readme, $token);
    $resultado_json2 = (json_decode($result));
    //print_r($resultado_json2);

    if (isset($resultado_json2->content)) {
        echo base64_decode($resultado_json2->content);
    }
} else {
    echo '<h1 style="color: purple;">Repositori de sandraperez93</h1>';
    $contador = 0;
    foreach ($resultado_json as $repositori) {
        if ($repositori->owner->login == 'sandraperez93') {
            $contador++;
            echo '<a href="?repositori=' . $repositori->name . '&user=' . $repositori->owner->login . '">' . $contador . '. ' . $repositori->name . '<a/>';
            echo '<br>';
        }
    }
}
?>


<html>
    <head>
        <title>Practica 10</title>
        <link rel="stylesheet" href="css/CSSpr10.css">

        <style>
            a{
                text-decoration: none;
                color: black;
            }



        </style>
    </head>
</html>
