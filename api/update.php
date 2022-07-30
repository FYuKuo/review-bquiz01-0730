<?php
include('./base.php');
$table = $_POST['table'];
$DB = new DB($table);
$data = $DB->find(1);

$data['text'] = $_POST['text'];

$DB->save($data);


to("../back.php?do=$table");
?>