<?php
date_default_timezone_set('Asia/Taipei');
session_start();

class DB{
    protected $dsn="mysql:host=localhost;chartset=utf8;dbname=db15-0730";
    public $table;
    public $pdo;

    public function __construct($table)
    {
        $this->pdo = new PDO($this->dsn,'root','');
        $this->table = $table;
    }

    // 找特定條件的全部資料
    public function all(...$arg)
    {
        $sql = "SELECT * FROM `$this->table` ";

        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach ($arg[0] as $key => $value) {
                    $tmp[] = "`$key` = '$value'";
                }

                $sql .= "WHERE ". join('AND',$tmp);
            }else{
                $sql .= $arg[0];
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 找特定條件的單一筆資料
    public function find($id){
        $sql = "SELECT * FROM `$this->table` ";

        if(is_array($id)){
            foreach ($id as $key => $value) {
                $tmp[] = "`$key` = '$value'";
            }

            $sql .= "WHERE ". join('AND',$tmp);
        }else{
            $sql .= "WHERE `id` = '$id'";
        }

        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // 刪除特定條件的單一筆資料
    public function del($id)
    {
        $sql = "DELETE FROM `$this->table` ";

        if(is_array($id)){
            foreach ($id as $key => $value) {
                $tmp[] = "`$key` = '$value'";
            }

            $sql .= "WHERE ". join('AND',$tmp);
        }else{
            $sql .= "WHERE `id` = '$id'";
        }

        return $this->pdo->exec($sql);
    }

    // 儲存 - 更新或新增
    public function save($array)
    {
        // 更新
        if(isset($array['id'])){

            foreach ($array as $key => $value) {
                if($key != 'id'){
                    $tmp[] = "`$key` = '$value'";
                }
            }

            $sql = "UPDATE `$this->table` SET ". join(',',$tmp) ." WHERE `id` = '{$array['id']}'";

        }else{
        // 新增
            
            $col = join("`,`",array_keys($array));
            $val = join("','",$array);
    
            $sql = "INSERT INTO `$this->table` (`$col`) VALUES ('$val')"; 
        }

        return $this->pdo->exec($sql);
    }

    // 用特定條件做數學計算
    public function math($math,$col,...$arg)
    {
        $sql = "SELECT $math($col) FROM `$this->table` ";

        if(isset($arg[0])){
            if(is_array($arg[0])){
                foreach ($arg[0] as $key => $value) {
                    $tmp[] = "`$key` = '$value'";
                }

                $sql .= "WHERE ". join('AND',$tmp);
            }else{
                $sql .= $arg[0];
            }
        }

        if(isset($arg[1])){
            $sql .= $arg[1];
        }

        return $this->pdo->query($sql)->fetchColumn();
    }
}

class STR{
    public $table;
    public $header;
    public $text = [];
    public $addBtn;
    public $addHeader;
    public $addText = [];
    public $updateBtn;
    public $updateHeader;
    public $updateText = [];

    public function __construct($table)
    {
        $this->table = $table;
        
        switch ($table) {
            
            case 'title' :
                $this->header = '網站標題管理';
                $this->text = ['網站標題','替代文字'];
                $this->updateBtn = '更新圖片';
                $this->updateHeader = '更新標題區圖片';
                $this->updateText = ['標題區圖片：','標題區替代文字：'];
                $this->addBtn = '新增網站標題圖片';
                $this->addHeader = '新增標題區圖片';
                $this->addText = ['標題區圖片：','標題區替代文字：'];
            break;

            case 'ad' :
                $this->header = '動態文字廣告管理';
                $this->text = ['動態文字廣告'];
                $this->addBtn = '新增動態文字廣告';
                $this->addHeader = '新增動態文字廣告';
                $this->addText = ['動態文字廣告：'];
            break;

            case 'mvim' :
                $this->header = '動畫圖片管理';
                $this->text = ['動畫圖片'];
                $this->updateBtn = '更新動畫';
                $this->updateHeader = '更新動畫圖片';
                $this->updateText = ['動畫圖片：'];
                $this->addBtn = '新增動畫圖片';
                $this->addHeader = '新增動畫圖片';
                $this->addText = ['動畫圖片：'];
            break;

            case 'image' :
                $this->header = '校園映像資料管理';
                $this->text = ['校園映像資料圖片'];
                $this->updateBtn = '更新圖片';
                $this->updateHeader = '更新校園映像圖片';
                $this->updateText = ['校園映像圖片：'];
                $this->addBtn = '新增校園映像圖片';
                $this->addHeader = '新增校園映像圖片';
                $this->addText = ['校園映像圖片：'];
            break;

            case 'total' :
                $this->header = '進站總人數管理';
                $this->text = ['進站總人數：'];
            break;

            case 'bottom' :
                $this->header = '頁尾版權資料管理';
                $this->text = ['頁尾版權資料：'];
            break;

            case 'news' :
                $this->header = '最新消息資料管理';
                $this->text = ['最新消息資料內容'];
                $this->addBtn = '新增最新消息資料';
                $this->addHeader = '新增最新消息資料';
                $this->addText = ['最新消息資料：'];
            break;

            case 'admin' :
                $this->header = '管理者帳號管理';
                $this->text = ['帳號','密碼'];
                $this->addBtn = '新增管理者帳號';
                $this->addHeader = '新增管理者帳號';
                $this->addText = ['帳號：','密碼：','確認密碼：'];
            break;

            case 'menu' :
                $this->header = '選單管理';
                $this->text = ['主選單名稱','選單連結網址','次選單數'];
                $this->updateBtn = '編輯次選單';
                $this->updateHeader = '編輯次選單';
                $this->updateText = ['次選單名稱','次選單連結網址'];
                $this->addBtn = '新增主選單';
                $this->addHeader = '新增主選單';
                $this->addText = ['主選單名稱：','選單連結網址：'];
            break;

    
        }
    }


    

}





function to($url){
    header("location:$url");
}

function dd($str){
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}
?>