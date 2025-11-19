<?php

?>
<!DOCTYPE html>
<html>
  <?php include('util/header.php');?>
  <body> 
        <header>
            <h1>Welcome to the admin area</h1>
        </header>
        <main>
            <form action="." method="post" id="logout_form" class="aligned">
                <input type="hidden" name="action" value="logout">

                <label>&nbsp;</label>
                <input type="submit" value="Logout">
            </form>
        </main>
  </body>

</html>