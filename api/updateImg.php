<?php
include('./base.php');
$table = $_POST['table'];
$DB= new DB($table);
$data = $DB->find($_POST['id']);

if(isset($_FILES['img']['tmp_name'])){

    move_uploaded_file($_FILES['img']['tmp_name'],'../img/'.$_FILES['img']['name']);
    $data['img'] = $_FILES['img']['name'];
}

$DB->save($data);

to("../back.php?do=$table");

?>