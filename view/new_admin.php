<?php

?>
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Create a Login</h1>
        </header>
        <main>
            <form action="." method="post" id="new_user_login_form" class="aligned">
                <input type="hidden" name="action" value="new_admin_login">

                <label>E-Mail:</label>
                <input type="text" name="email" 
                    value="">
                <?php echo $fields->getField('email')->getHTML(); ?><br>

                <label>Password:</label>
                <input type="password" name="password" 
                    value="">
                <?php echo $fields->getField('password')->getHTML(); ?><br>

                <label>Verify Password:</label>
                <input type="password" name="verify" 
                    value="">
                <?php echo $fields->getField('verify')->getHTML(); ?><br>

                <label>&nbsp;</label>
                <input type="submit" value="Create Login">
            </form>
        </main>
  </body>

</html>