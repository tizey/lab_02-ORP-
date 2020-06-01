<?php
session_start();
include 'C:\Users\Admin\Downloads\Open Server 5.3.5\OSPanel\domains\final-2lb-test\users.php';
$login = $_POST["login"];
$password = $_POST["password"];
$NumOfUsers = count($users);


for ($i = 0; $i < $NumOfUsers; $i++)
{	
	#Проверяю есть ли такой пользователь ВООБЩЕ
    if (($login == $users[$i]['login']) && ($password == $users[$i]['password']))
    {

	    	#Передаю в сессию значения логина и пароля которые совпали с комбинацией с файла users(дальше работаю с сессионными данными)
	        $_SESSION['login'] = $users[$i]['login'];
	        $_SESSION['password'] = $users[$i]['password'];

	        #Проверяю совпадает ли роль залогиненого пользователя (из users подтянулось) с фиксированной ролью "admin"
	        if ($users[$i]['role'] == 'admin'){
	            $_SESSION['role'] = $users[$i]['role'];
	            $_SESSION['name'] = $users[$i]['name'];
	            $_SESSION['surname'] = $users[$i]['surname'];
	            $_SESSION['lang'] = $users[$i]['lang'];	        
	            header('Location: users\admin.php'); #Если совпало - перекидываю на админскую страницу


	        }

	        #Проверяю совпадает ли роль залогиненого пользователя (из users подтянулось) с фиксированной ролью "manager"
	        if ($users[$i]['role'] == 'manager'){
	            $_SESSION['role'] = $users[$i]['role'];
	            $_SESSION['name'] = $users[$i]['name'];
	            $_SESSION['surname'] = $users[$i]['surname'];
	            $_SESSION['lang'] = $users[$i]['lang'];	   
	            header('Location: users\manager.php'); #Если совпало - перекидываю на менеджерскую страницу
	        }

	        #Проверяю совпадает ли роль залогиненого пользователя (из users подтянулось) с фиксированной ролью "client"
	        if ($users[$i]['role'] == 'client'){
	            $_SESSION['role'] = $users[$i]['role'];
	            $_SESSION['name'] = $users[$i]['name'];
	            $_SESSION['surname'] = $users[$i]['surname'];
	            $_SESSION['lang'] = $users[$i]['lang'];
	            header('Location: users\client.php'); #Если совпало - перекидываю на клиентскую страницу
	        }

    }
}

