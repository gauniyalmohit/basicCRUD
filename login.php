<?php
$status = 0;
if (isset($_POST['submit'])) {
    $user_name = $_POST['user_name'];
    $password = sha1($_POST['password']);
    $query = "select * from users where user_name='$user_name' and password='$password'";
    require_once 'includes/db.inc.php';
    $result = @mysql_query($query);
    if (mysql_num_rows($result) == 1) {
        $row = @mysql_fetch_assoc($result);
        if ($row['verified'] == 'Y') {
            session_start();
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_name'] = $user_name;
            $_SESSION['role_name'] = $row['role_name'];

            if ($row['role_name'] == 'admin')
                header('location:admin/index.php');
            if ($row['role_name'] == 'member')
                header('location:members/index.php');
        }
        else {
            $status = 1;
        }
    } else {
        $status = 2;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="styles/w3.css" >
        <link rel="stylesheet" href="styles/mystyle.css">
        <script src="ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.6-dist//js/bootstrap.min.js"></script>
        <style>
            .button
            {
                background-color: #4CAF50; /* Green */
                border: none;
                color: white;
                padding:10px;
                text-align: center;
                text-decoration: none;
                display: inline - block;
                font-size: 15px;
                margin-top: 8px;
                -webkit-transition-duration: 0.4s; /* Safari */
                transition-duration: 0.4s;
                cursor: pointer;
                min-width: 100px;
            }
            .button2 {
                background-color: white;
                color: black;
                border: 2px solid #008CBA;
            }

            .button2:hover {
                background-color: #008CBA;
                color: white;
            </style>    
        </head>
        <body>
            <menu>
                <?php require_once './includes/guest/header.inc.php'; ?>
            </menu>
            <nav>
                <?php require_once './includes/guest/nav.inc.php'; ?>
            </nav>

            <section>
                <h2>Log in</h2>
                <form action="login.php" method="POST" class="w3-container" class="w3-container">
                    <div class="w3-section">
                        <label><b>Username</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="user_name" value="">

                        <label><b>Password</b></label>
                        <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" value="">

                        <button class="button button2" type="submit" name="submit">Login</button>
                    </div>  
                </form>
                <hr>
                <?php if ($status == 1) { ?> 
                    <h3 class="error">Go, First complete verification.</h3>
                <?php } else if ($status == 2) { ?> 
                    <h3 class="error">Wrong username or password entered.</h3>
                <?php } ?>
                <a href="forgot_password.php">Forgot Password ?</a>
            </section>    
            <footer>
                <?php require_once './includes/guest/footer.inc.php'; ?>
            </footer>
        </body>
    </html>
