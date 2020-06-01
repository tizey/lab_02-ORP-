<?php


session_start();

include 'C:\Users\Admin\Downloads\Open Server 5.3.5\OSPanel\domains\final-2lb-test\users.php';
include 'C:\Users\Admin\Downloads\Open Server 5.3.5\OSPanel\domains\final-2lb-test\resources\lang.php';

#Ловлю методом GET то что пользователь нажал на exit
if($_GET["exit"])
{
    session_destroy(); #разрушаю сессию
    header("Location: ..\index.php"); #перекидываю пользователя на страницу ввода л/п
}

#Ловлю методом GET то что пользователь нажал на кнопку смены языка
if (isset($_GET['lang'])){
    $_SESSION['lang'] = $_GET['lang']; #передаю в сессию тот язык который получил из формы
}




#Проверяю залогинен ли вообще ХОТЬ КТО-ТО, а так же если это не админ - не пускаю его
if (!(($_SESSION['role']) == 'admin')) {
    session_destroy();  #разрушаю сессию
    header("Location:  ..\index.php");  #перекидываю пользователя на страницу ввода л/п
}


class User{ #Класс пользователя
    public $login;
    public $password;
    public $name;
    public $surname;
    public $role;
    public $langhi;
    public $langinfo;

    function __construct($login,$password,$name,$surname,$role,$langhi,$langinfo) #Конструктор "по-умолчанию" в который передаём при создания обьекта все необходимые данные
    {
        $this->login = $login; 
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->role = $role;
        $this->langhi = $langhi;
        $this->langinfo = $langinfo;
    }
}

class admin extends User { #Унаследование класса Админ от класса Пользователя

    public function welcome (){ #Функция вывода приветствия
        echo $this ->langhi . $this->name. "  " . $this->surname. "  ". $this ->langinfo;
    }
}


if ($_SESSION['lang'] == 'ru') {
    # code...
         $admin = new admin($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['ru'], $lang[1]['ru']);
}

if ($_SESSION['lang'] == 'en') {
    # code...
         $admin = new admin($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['en'], $lang[1]['en']);
}

if ($_SESSION['lang'] == 'ua') {
    # code...
         $admin = new admin($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['ua'], $lang[1]['ua']);
       
}

if ($_SESSION['lang'] == 'it') {
    # code...
         $admin = new admin($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['it'], $lang[1]['it']);
}


$admin ->welcome();


?>

<head>
    <title>Админ</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    

<form >
    <select name="lang" method="GET">
        <option value="ru">Русский</option>
        <option value="ua">Українська</option>
        <option value="en">English</option>
        <option value="it">Italian</option>
    </select>
    <input type="submit" value="Save">
</form>

<form method="GET">
        <input type="submit" class= "ex-b" name="exit"  value="Exit">
    </form>

    <form name = "test" action = "manager.php" method = "post">
        <button>Manager</button>
    </form>
    <form name = "test" action = "client.php" method = "post">
        <button>Client</button>
    </form>


</body> 
