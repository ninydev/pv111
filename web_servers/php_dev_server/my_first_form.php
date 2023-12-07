<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<h1> Hello from 1995 </h1>
<div>
    <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
        <input type="text" name="userName" value="<?=$_REQUEST['userName']?>">
        <input type="submit">
    </form>
</div>

<h1> Что пользователь передал: </h1>

<h3>GET:</h3>
<?php
    var_dump($_GET);
?>
<h3>POST:</h3>
<?php
var_dump($_POST);
?>
<h3>COOKIE:</h3>
<?php
var_dump($_COOKIE);
?>
</body>
</html>


