<?
require_once ("class/query.php");

/*
class User extends Query{
    public $user;
    protected $users;

    public function __construct($name, $pass)
    {
        parent::__construct("users");
        $this->user = array("user_name" => $name, "user_pass" => md5($pass));
        $this->users = parent::Select_all();

    }
    public function availability()
    {
        foreach ($this->users as $user){
            if ($user['user_name'] == $this->user['user_name']) return $user;
        }
     return false;
    }
    
    public function add_user()
    {
        if ($this->availability() == false){
            parent::Insert($this->user);
            return true;
        }
        else return false;
    }

    public function check_pass($user)
    {
        if ($this->user["user_pass"] == $user['user_pass']) return true;
        else return false;

    }

    public function log_in_user()
    {
        $result = array(
            'try' => NULL,
            'massage'=> NULL
        );
        $user = $this->availability();
        if (is_array($user)){
            if ($this->check_pass($user) == true) {
                $result['try'] = true;
                $result['massage'] = "Вы успешно авторизованны";
            }
            else {
                $result['try'] = false;
                $result['massage'] = "Неверный пароль";
            }
        }
        else {
            $result['try'] = false;
            $result['massage'] = "Имя пользователья не существует";
        }
        return $result;
    }
    public function get_arg(){
        echo "<pre>";
        print_r($this->users);
        print_r($this->user);
        echo "</pre>";

    }
    function __destruct()
    {
        parent::__destruct();
        $this->user = null;
        $this->users = null;
    }
} */

