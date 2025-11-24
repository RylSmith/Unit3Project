<?php 

function get_admin($user_id) {
    global $db;
    $query = 'SELECT * FROM administrators
              WHERE Id = :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}

function add_admin($email, $firstName, $lastName, $password) {
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO administrators (emailAddress, password, fName, lName) 
              VALUES (:email, :password, :fName, :lName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $hash);
    $statement->bindValue(':fName', $firstName);
    $statement->bindValue(':lName', $lastName);
    $statement->execute();
    $statement->closeCursor();
}

function update_admin($Id, $email, $firstName, $lastName) {
    global $db;
    $query = 'UPDATE administrators
              SET emailAddress = :email, fName = :fName, lName = :lName
              WHERE Id = :Id';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':fName', $firstName);
    $statement->bindValue(':lName', $lastName);
    $statement->bindValue(':Id', $Id);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_admin_login($email, $password) {
    global $db;
    $query = 'SELECT password FROM administrators
              WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return password_verify($password, $hash);
}

function get_user_id($email) {
    global $db;
    $query = 'SELECT * FROM administrators
              WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();    
    $user_id = $user['Id'];
    return $user_id;
}

?>