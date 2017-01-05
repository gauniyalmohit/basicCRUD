<?php
$status = 0;
$template = 1;
if (isset($_POST['submit'])) {
    session_start();
    $_SESSION['user_name']=$user_name;
    $user_name = $_POST['user_name'];
    $query = "select * from users where user_name='$user_name'";
    require_once './includes/db.inc.php';
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1) {
        $template = 2;
        $query = "select question from users where user_name='$user_name'";
        $result = @mysql_query($query);
        $row = @mysql_fetch_assoc($result);
        $question = $row['question'];
    } else {
        $template = 1;
        $status = 1;
    }
}

if (isset($_POST['reset'])) {
    session_start();
    $user_name=$_SESSION['user_name'];
    $answer = sha1($_POST['answer']);
    $question = $_POST['question'];
    $query = "select * from users where user_name='$user_name' and answer='$answer'";
    require_once './includes/db.inc.php';
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 1) {
        $template = 3;
        $row=  mysql_fetch_assoc($result);
        
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
  $str = str_shuffle($str);
  $password = substr($str, 0, 8);
  $data = sha1($password);
  require_once './includes/db.inc.php';
  $query = "update users set password='$data' where user_name='$user_name'";
  mysql_query($query);
  $query = "select email from users where user_name='$user_name'";
  $result = mysql_query($query);
  $row = mysql_fetch_assoc($result);
  $email = $row['email'];
  require_once('includes/class.phpmailer.php');

  $mailer = new PHPMailer(true);

  $mailer->Sender = 'php.batch.2015@gmail.com';
  $mailer->SetFrom('php.batch.2015@gmail.com', 'Unisoft Dehradun');
  $mailer->AddAddress($email);
  $mailer->Subject = 'Password Reset';
  $mailer->MsgHTML('<p>Your Password is : '.$password.'</p>');

  // Set up our connection information.
  $mailer->IsSMTP();
  $mailer->SMTPAuth = true;
  $mailer->SMTPSecure = 'ssl';
  $mailer->Port = 465;
  $mailer->Host = 'smtp.gmail.com';
  $mailer->Username = 'php.batch.2015@gmail.com';
  $mailer->Password = 'abc#1234';

  $mailer->Send();      
    } else {
        $template = 2;
        $status = 2;
    }
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./bootstrap-3.3.6-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="./styles/w3.css" >
        <link rel="stylesheet" href="./styles/mystyle.css">
        <script src="./ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="./bootstrap-3.3.6-dist//js/bootstrap.min.js"></script>

    </head>
    <body>

        <menu>
            <?php require_once './includes/guest/header.inc.php'; ?>
        </menu>

        <nav>
            <?php require_once './includes/guest/nav.inc.php'; ?>
        </nav>

        <section>
            <?php if ($template == 1) { ?>
                <form action="forgot_password.php" method="POST">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td>User Name : </td>
                                <td><input type="text" name="user_name" value="" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="submit" value="Search" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php if ($status == 1) { ?>
                    <h2 class="error">User Name doesn't exist. Please, check your Spelling.</h2>
                <?php } ?>
            <?php } ?>


            <?php if ($template == 2) { ?>
                <form action="forgot_password.php" method="POST">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td>Question : </td>
                                <td>
                                    <select name="question">
                                        <option <?php if ($question == 1) echo "selected='selected'"; ?>value='1'>Your favourite movie ? </option>
                                        <option <?php if ($question == 2) echo "selected='selected'"; ?>value='2'>Your favourite animal ? </option>
                                        <option <?php if ($question == 3) echo "selected='selected'"; ?>value='3'>Your birth place ? </option>
                                        <option <?php if ($question == 4) echo "selected='selected'"; ?>value='4'>Last name of your first grade teacher ? </option>
                                        <option <?php if ($question == 5) echo "selected='selected'"; ?>value='5'>Your best friend ? </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Answer : </td>
                                <td><input type="text" name="answer" value="" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="reset" value="Submit" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <?php if ($status==2) { ?>
                    <h2 class="error">Wrong answer.</h2>
                <?php } ?>
            <?php } ?>
                    
            <?php if ($template == 3) { ?>
                <h3>Hello, <?php echo $user_name;?></h3>    
                <h3>Your password has been changed.</h3>
                <h3>Your New password has been sent to your mail id '<?php echo $row['email']; ?>'</h3>
                Click <a href="login.php">here</a> to login.
            <?php } ?>
        </section>    

        <footer>
            <?php require_once './includes/guest/footer.inc.php'; ?>
        </footer>

    </body>
</html>