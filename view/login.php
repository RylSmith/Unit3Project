<?php

?>
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Sign In</h1>
        </header>
        <main>
            <form action="." method="post" id="login_form" class="aligned">
                <input type="hidden" name="action" value="login">

                <label>E-Mail:</label>
                <input type="text" name="email" value="">
                <br>

                <label>Password:</label>
                <input type="password" name="password" value="">
                <br>

                <label>&nbsp;</label>
                <input type="submit" value="Sign In">
            </form>
            <form action="." method="post" id="new_user_form" class="aligned">
                <input type="hidden" name="action" value="new_admin">

                <label>&nbsp;</label>
                <input type="submit" value="Create New Login">
            </form>

            <p><?php echo $login_message; ?></p>
        </main>
  </body>

</html>