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

#Проверяю залогинен ли вообще ХОТЬ КТО-ТО, а если кто-то залогинен - пускаю его на странцу клиента 
#проверку на то клиент ли это вообще - не делаю как так на его страницу можно пускать любую роль
if (!(isset($_SESSION['login'])) && (!(isset($_SESSION['password'])))){
    session_destroy();
    header('location:  ..\index.php');
}

class User{
    public $login;
    public $password;
    public $name;
    public $surname;
    public $role;
    public $langhi;
    public $langinfo;

    function __construct($login,$password,$name,$surname,$role,$langhi,$langinfo)#Конструктор "по-умолчанию" в который передаём при создания обьекта все необходимые данные
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



class client extends user { #Унаследование класса клиент от класса Пользователя

    public function welcome (){
        echo $this ->langhi . $this->name. "  " . $this->surname. "  ". $this ->langinfo;
    }
}


#1 - admin
#2 -manager
#3 - client


if ($_SESSION['role'] == 'admin') {
    $n_rl = 1;
}

if ($_SESSION['role'] == 'manager') {
    $n_rl = 2;
}

if ($_SESSION['role'] == 'client') {
    $n_rl = 3;
}




if ($_SESSION['lang'] == 'ru') {
    
         $client = new client($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['ru'], $lang[$n_rl]['ru']);
}

if ($_SESSION['lang'] == 'en') {
# code...
         $client = new client($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['en'], $lang[$n_rl]['en']);
}

if ($_SESSION['lang'] == 'ua') {
   
         $client = new client($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['ua'], $lang[$n_rl]['ua']);
       
}

if ($_SESSION['lang'] == 'it') {
    
         $client = new client($_SESSION['login'], $_SESSION['password'], $_SESSION['name'], $_SESSION['surname'], $_SESSION['role'], $lang[0]['it'], $lang[$n_rl]['it']);
}


$client ->welcome();
?>
<head>
    <title>Клиент</title>
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
    <input type="submit"value="Save">
</form>

<form method="GET">
    <input type="submit" name="exit" class= "ex-b" value="Exit">
</form>

<!--Вариативное меню для роли админа на странице клиентского ЛК-->
<?php if($_SESSION['role'] == 'admin') { ?>

    <form name = "test" action = "admin.php" method = "post">
        <button>Admin</button>
    </form>
    <form name = "test" action = "manager.php" method = "post">
        <button>Manager</button>
    </form>
<?} ?>

<!--Вариативное меню для роли менеджера на странице клиентского ЛК-->

<?php if($_SESSION['role'] == 'manager') { ?>
    <form name = "test" action = "manager.php" method = "post">
        <button>Manager</button>
    </form>
<?} ?>

</form>
</body>