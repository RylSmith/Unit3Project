<?php
session_start();
require_once('model/database.php');
require_once('model/admin_db.php');
require_once('model/fields.php');
require_once('model/validate.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('email', 'Must be a valid email address.');
$fields->addField('password', 'Must be at least 8 characters, contain an uppercase letter, and a digit.');
$fields->addField('verify', 'Must match the password given.');

$login_message = '';

$action = filter_input(INPUT_POST, 'action');
if($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_admin_menu';
    }
}

if (!isset($_SESSION['is_valid_admin']) && $action !== 'new_admin' && $action !== 'new_admin_login' && $action !== 'login') {
    $action = 'login';
}

switch($action) {
    case 'login':
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        if ($email != NULL && $password != NULL){

            if (is_valid_admin_login($email, $password)) {
                $_SESSION['is_valid_admin'] = true;
                include('view/home.php');
            } else {
                $login_message = 'You must login to view the home page.';
                include('view/login.php');
            }
            break;
        } else {
            $login_message = 'You must login to view the home page.';
            include('view/login.php');
        }
        break;
    case 'show_admin_menu':
        include('view/home.php');
        break;   
    case 'new_admin':
        include('view/new_admin.php');
        break;
    case 'new_admin_login':
        $email = trim(filter_input(INPUT_POST, 'email'));
        $password = filter_input(INPUT_POST, 'password');
        $verify = filter_input(INPUT_POST, 'verify');

        $validate->email('email', $email);
        $validate->password('password', $password);
        $validate->verify('verify', $password, $verify);
        
        if ($fields->hasErrors()) {
            include 'view/new_admin.php';
        } else {
            add_admin($email, $password);
            include 'view/login.php';
        }
        break;
    case 'logout':
        //Will need stuff to logout the user
}       



?>