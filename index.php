<?php
session_start();
require_once('model/database.php');
require_once('model/admin_db.php');
require_once('model/tasks_db.php');
require_once('model/fields.php');
require_once('model/validate.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('email', 'Must be a valid email address.');
$fields->addField('first_name');
$fields->addField('last_name');
$fields->addField('password', 'Must be at least 8 characters, contain an uppercase letter, and a digit.');
$fields->addField('verify', 'Must match the password given.');
$fields->addField('task_name', 'Task must have a name.');
$fields->addField('due_date', 'must be in the format of yyyy-mm-dd.');
$fields->addField('description');
$fields->addField('status', 'Select from the options provided.');


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
                $_SESSION['user_id'] = get_user_id($email); // This grabs user id for the session will help fetch their tasks
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
        $firstName = trim(filter_input(INPUT_POST, 'first_name'));
        $lastName = trim(filter_input(INPUT_POST, 'last_name'));
        $password = filter_input(INPUT_POST, 'password');
        $verify = filter_input(INPUT_POST, 'verify');

        $validate->email('email', $email);
        $validate->text('first_name', $firstName);
        $validate->text('last_name', $lastName);
        $validate->password('password', $password);
        $validate->verify('verify', $password, $verify);
        
        if ($fields->hasErrors()) {
            include 'view/new_admin.php';
        } else {
            add_admin($email, $firstName, $lastName, $password);
            include 'view/login.php';
        }
        break;
    case 'logout':
        $_SESSION = array();   // Clear all session data from memory
        session_destroy();     // Clean up the session ID
        $login_message = 'You have been logged out.';
        include('view/login.php');
        break;
    case 'add_task_form':
        include('view/add_task.php');
        break;
    case 'add_task':
        $taskName = trim(filter_input(INPUT_POST, 'task_name'));
        $dueDate = trim(filter_input(INPUT_POST, 'due_date'));
        $description = trim(filter_input(INPUT_POST, 'description'));
        $status = filter_input(INPUT_POST, 'status');

        $validate->text('task_name', $taskName);
        $validate->dueDate('due_date', $dueDate);
        $validate->text('description', $description);
        $validate->text('status', $status);

        $userId = $_SESSION['user_id'];

        if ($fields->hasErrors()) {
            echo('This is problem');
            include 'view/home.php';
        } else {
            add_task($userId, $taskName, $dueDate, $description, $status);
            include 'view/home.php';
        }
        break;
    case 'show_update_form':
        $task_id = filter_input(INPUT_POST, 'Id', 
            FILTER_VALIDATE_INT);
        $_SESSION['task_id'] = $task_id;
        include('view/update_task.php');
        break;
    case 'update_task':
        $taskName = trim(filter_input(INPUT_POST, 'task_name'));
        $dueDate = trim(filter_input(INPUT_POST, 'due_date'));
        $description = trim(filter_input(INPUT_POST, 'description'));
        $status = filter_input(INPUT_POST, 'status');

        $validate->text('task_name', $taskName);
        $validate->dueDate('due_date', $dueDate);
        $validate->text('description', $description);
        $validate->text('status', $status);

        $Id = $_SESSION['task_id'];

        if ($fields->hasErrors()) {
            echo('This is problem');
            include 'view/home.php';
        } else {
            update_task($Id, $taskName, $dueDate, $description, $status);
            include 'view/home.php';
        }
            break;
        case 'delete_task':
            $task_id = filter_input(INPUT_POST, 'Id', 
            FILTER_VALIDATE_INT);
            delete_task($task_id);
            include 'view/home.php';
            break;
} 
      
?>