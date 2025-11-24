<?php 

function get_tasks($userId) {
    global $db;
    $query = 'SELECT * FROM tasklist
              WHERE userId = :userId
              ORDER BY Id';
    $statement = $db->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->execute();
    $tasks = $statement->fetchAll();
    $statement->closeCursor();
    return $tasks;    
}

function get_task($Id) {
    global $db;
    $query = 'SELECT * FROM tasklist
              WHERE Id = :Id';
    $statement = $db->prepare($query);
    $statement->bindValue(':Id', $Id);
    $statement->execute();
    $task = $statement->fetch();
    $statement->closeCursor();
    return $task;    
}

function add_task($userId, $taskName, $dueDate, $description, $status) {
    global $db;
    $query = 'INSERT INTO tasklist (userId, taskName, dueDate, description, status) 
              VALUES (:userId, :taskName, :dueDate, :description, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':userId', $userId);
    $statement->bindValue(':taskName', $taskName);
    $statement->bindValue(':dueDate', $dueDate);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();
}

function update_task($Id, $taskName, $dueDate, $description, $status) {
    global $db;
    $query = 'UPDATE tasklist
              SET taskName = :taskName, dueDate = :dueDate, description = :description, status = :status
              WHERE Id = :Id';
    $statement = $db->prepare($query);
    $statement->bindValue(':taskName', $taskName);
    $statement->bindValue(':dueDate', $dueDate);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':status', $status);
    $statement->bindValue(':Id', $Id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_task($Id) {
    global $db;
    $query = 'DELETE FROM tasklist
              WHERE Id = :Id';
    $statement = $db->prepare($query);
    $statement->bindValue(':Id', $Id);
    $statement->execute();
    $statement->closeCursor();
}

?>
