<?php
$status = 0;
$template = 1;
$user_name = '';
$password = '';
$confirm_password = '';
$name = '';
$email = '';
$question = '';
$answer = '';
$photo='';

function get_photo_name($photo){
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = str_shuffle($str);
        $str = substr($str, 0,20);
        $i = strpos($photo, '.');
        $ext_name = substr($photo, $i);
        return $str.$ext_name;
    }

$errors = array();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $user_name = $_POST['user_name'];
    $password = trim($_POST['password']);
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $question = $_POST['question'];
    $answer = $_POST['answer'];    

    if (empty($name)) {
        $errors['name'] = ' * Name Required.';
    }
    if (empty($user_name)) {
        $errors['user_name'] = ' * User Name Required.';
    }
    if (empty($password)) {
        $errors['password'] = ' * Password Required.';
        $errors['confirm_password'] = ' * Required.';
        $errors['answer'] = ' * Answer Required.';
    }
    if (empty($confirm_password)) {
        $errors['password'] = ' * Password Required.';
        $errors['confirm_password'] = ' * Required.';
        $errors['answer'] = ' * Answer Required.';
    }
    if (empty($email)) {
        $errors['email'] = ' * Email Required.';
    }
    if (empty($question)) {
        $errors['question'] = ' * Question Required.';
    }
    if (empty($answer)) {
        
        $errors['password'] = ' * Password Required.';
        $errors['confirm_password'] = ' * Required.';
        $errors['answer'] = ' * Answer Required.';
    }

    if (count($errors) == 0) {
        if (!preg_match('/^[A-Za-z][A-Za-z0-9]*$/', $user_name)) {
            $errors['user_name'] = 'User Name is not Valid';
        }
        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
            $errors['confirm_password'] = 'Passwords does not match';
        }
        if ($password != $confirm_password) {
            $errors['password'] = ' * Password Required.';
            $errors['confirm_password'] = 'Passwords does not match';
        }
        if (!preg_match('/^[A-Za-z0-9]+@[A-Za-z0-9]+\.[A-Za-z]+$/', $email)) {
            $errors['email'] = 'Email is not Valid';
        }
    }

    if (count($errors) == 0) {
        $query = "select * from users where user_name='$user_name'";
        require_once './includes/db.inc.php';
        $result = mysql_query($query);
        if (mysql_num_rows($result) == 1) {
            $errors['user_name'] = 'User Name already Exists';
        }
    }

    if (count($errors) == 0) {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = str_shuffle($str);
        $verification_code = substr($str, 0, 25);
        $password = sha1($password);
        $answer = sha1($answer);
        $query = "insert into users values('$user_name','$password','member','$name','$email','$question','$answer','$verification_code','N')";
        require_once './includes/db.inc.php';
        mysql_query($query);
        $template = 2;
        
    /*    require_once('includes/class.phpmailer.php');

            $mailer = new PHPMailer(true);

            $mailer->Sender = 'php.batch.2015@gmail.com';
            $mailer->SetFrom('php.batch.2015@gmail.com', 'Unisoft Dehradun');
            $mailer->AddAddress($email);
            $mailer->Subject = 'Registration';
            $mailer->MsgHTML('<p>Registration Successful</p>'.
                    '<p>Verification Link <a href="http://unisoft.com/verify.php?user_name='.$user_name.'&code='.$verification_code.'">Click here to verify</a></p>');

            // Set up our connection information.
            $mailer->IsSMTP();
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = 465;
            $mailer->Host = 'smtp.gmail.com';
            $mailer->Username = 'php.batch.2015@gmail.com';
            $mailer->Password = 'abc#1234';

            $mailer->Send();*/
    }
}
?><!DOCTYPE html>
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

    </head>
    <body>
        <menu>
            <?php require_once './includes/guest/header.inc.php'; ?>
        </menu>
        <nav>
            <?php require_once './includes/guest/nav.inc.php'; ?>
        </nav>

        <section>
            <h1>Register</h1>
            <?php if ($template == 1) { ?>
                <form action="register.php" method="POST">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td>Name : </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $name ?>"/>
                                    <?php if (isset($errors['name'])) { ?>
                                        <span class="error"><?php echo $errors['name']; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>User Name : </td>
                                <td>
                                    <input type="text" name="user_name" value="<?php echo $user_name ?>" />
                                    <?php if (isset($errors['user_name'])) { ?>
                                        <span class="error"><?php echo $errors['user_name']; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Password : </td>
                                <td>
                                    <input type="password" name="password" value="" />
                                    <?php if (isset($errors['password'])) { ?>
                                        <span class="error"><?php echo $errors['password']; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Confirm Password : </td>
                                <td>
                                    <input type="password" name="confirm_password" value="" />
                                    <?php if (isset($errors['confirm_password'])) { ?>
                                        <span class="error"><?php echo $errors['confirm_password']; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email : </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $email ?>" />
                                    <?php if (isset($errors['email'])) { ?>
                                        <span class="error"><?php echo $errors['email']; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
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
                                <td>
                                    <input type="text" name="answer" value="" />
                                    <?php if (isset($errors['answer'])) { ?>
                                        <span class="error"><?php echo $errors['answer']; ?></span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" name="submit" value="Register" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            <?php } ?>
            <?php if ($template == 2) {?>
                <h3>Congratulations!</h3>
                <h3>You'be been registered.</h3>
                <h3>GO TO your email account - '<?php echo $email; ?>' for verification.</h3><br>
            <?php } ?>
        </section>    
        <footer>
            <?php require_once './includes/guest/footer.inc.php'; ?>
        </footer>
    </body>
</html>
