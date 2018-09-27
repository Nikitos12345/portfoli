<?php
/*
 * TODO Дописать
 * **/
class Upload
{
    private $file;
    private $path;
    private $pdo;
    private $table = 'users';
    private $user_name;

    function __construct()
    {
        $this->path = "/upload/";
        $this->pdo = new Query($this->table);

    }

    function __set($name, $value)
    {
        $this->$name = $value;
    }

    private function setFile()
    {
        if (isset($_FILES)){
            foreach ($_FILES as $item){
                $this->file = $item;
            }
            return true;
        }
        else return false;
    }

    private function CheckUser()
    {
        if (isset($_SESSION['user'])){
            $this->user_name = $_SESSION['user']['user_name'];
            return true;
        }
        else return false;
    }

    public function UploadFile()
    {
        if ($this->CheckUser() && $this->setFile()){
            move_uploaded_file($this->file['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$this->path.$this->file['name']);
            $this->writeFile();
            return true;
        } else return false;

//        } else echo $this->file['error'];
    }

    private function writeFile()
    {
        $where['user_name'] = $this->user_name;
        $update['image'] = $this->path.$this->file['name'];
        if ($this->pdo->Update($update, $where)) return true;
        else return false;
    }

    function __destruct()
    {
        unset($this->path);
        unset($this->file);
    }

}