<?php
    require_once 'secure.inc.php';
    $status=0;
    if(isset($_POST['submit']))
    {
        $user_name=$_SESSION['user_name'];
        $current_password=sha1($_POST['current_password']);
        $new_password=sha1($_POST['new_password']);
        $confirm_password=sha1($_POST['confirm_password']);
        require_once '../includes/db.inc.php';
        $query="select * from users where user_name='$user_name' and password='$current_password'";
        $result=  @mysql_query($query);
        
        if(@mysql_num_rows($result)==1)
        {
            if($new_password==$confirm_password)
            {
                $status=1;
                $query="update users set password='$new_password' where user_name='$user_name'";
                @mysql_query($query);
            }
            else
            {
                $status=2;
            }
        }
        else
        {
            $status=3;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../styles/w3.css" >
        <link rel="stylesheet" href="../styles/mystyle.css">
        <script src="../ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="../bootstrap-3.3.6-dist//js/bootstrap.min.js"></script>

    </head>
    <body>
        <menu>
           <?php require_once '../includes/admin/header.inc.php';?>
        </menu>
        <nav>
            <?php require_once '../includes/admin/nav.inc.php';?>
        </nav>

        <section>
            <h2 style="text-align: center;">Change password</h2>
            <form action="change_password.php" method="POST">
                <table border="0">
                    <tbody>
                        <tr>
                            <td>Current Password : </td>
                            <td><input type="password" name="current_password" value="" /></td>
                        </tr>
                        <tr>
                            <td>New Password</td>
                            <td><input type="password" name="new_password" value="" /></td>
                        </tr>
                        <tr>
                            <td>Confirm Password : </td>
                            <td><input type="password" name="confirm_password" value="" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" name="submit" value="submit" /></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php if($status==1) { ?>
            <h2>Password successfully updated.</h2>
            <?php } ?>
            <?php if($status==2) { ?>
            <h2 class="error">New and Confirm password don't match.</h2>
            <?php } ?>
            <?php if($status==3) { ?>
            <h2 class="error">Wrong Current password..</h2>
            <?php } ?>
        </section>    

        <footer>
            <?php require_once '../includes/admin/footer.inc.php';?>
        </footer>
    </body>
</html>
