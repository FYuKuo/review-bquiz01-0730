<?php
include('./base.php');
$table = $_POST['table'];
$DB= new DB($table);

if(isset($_POST['id'])){

    foreach ($_POST['id'] as $key => $id) {
        if(isset($_POST['del']) && in_array($id,$_POST['del'])){

            $DB->del($id);
    
        }else{
            $data = $DB->find($id);

            $data['sh'] = (isset($_POST['sh']) && in_array($id,$_POST['sh']))?1:0;
            $data['text'] = $_POST['text']["$key"];
            $data['href'] = $_POST['href']["$key"];


            $DB->save($data);
        }
    }


}

if(isset($_POST['textAdd'])){

    foreach ($_POST['textAdd'] as $key => $textAdd) {
    
        $data = [];
    
        $data['sh'] = 1;
        $data['parent'] = $_POST['parentId'];
        $data['text'] = $_POST['textAdd']["$key"];
        $data['href'] = $_POST['textAdd']["$key"];
    
        $DB->save($data);
    }
}






to("../back.php?do=$table");



?>