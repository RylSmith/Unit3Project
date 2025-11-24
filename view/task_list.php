<?php
    $userId = $_SESSION['user_id'];
    $tasks = get_tasks($userId);
?>
<h1>Task List</h1>

<section>
    <table>
        <tr>
            <th>Task Name</th>
            <th>Due Date</th>
            <th>Description</th>
            <th>Status</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($tasks as $task) : ?>
            <tr>
                <td><?php echo $task['taskName']; ?></td>
                <td><?php echo $task['dueDate']; ?></td>
                <td><?php echo $task['description']; ?></td>
                <td><?php echo $task['status']; ?></td>

                <td><form action="." method="post">
                    <input type="hidden" name="action"
                        value="delete_task">
                    <input type="hidden" name="Id"
                        value="<?php echo $task['Id']; ?>">
                    <input type="submit" value="Delete">
                </form></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                        value="show_update_form">
                    <input type="hidden" name="Id"
                        value="<?php echo $task['Id']; ?>">
                    <input type="submit" value="Update">
                </form></td>
            </tr>
            <?php endforeach; ?>
    </table>
</section>