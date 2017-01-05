<?php
    require_once 'secure.inc.php';
    $status=0;
    if(isset($_POST['submit']))
    {
        $roll_number=$_POST['roll_number'];
        $name=$_POST['name'];
        $gender=$_POST['gender'];
        $email=$_POST['email'];
        $mobile_number=$_POST['mobile_number'];
        $course=$_POST['course'];
        
        $query="insert into students values($roll_number,'$name','$gender','$email','$mobile_number','$course')";
        
        require_once '../includes/db.inc.php';
        if(mysql_query($query))
        {
            $status=1;
        }
        else
        {
            $status=2;
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
            <h2 style="text-align: center">Add Student</h2>
            <form action="add_student.php" method="POST">
                <table>
                <tbody>
                    <tr>
                        <td>Roll Number : </td>
                        <td><input type="text" name="roll_number" value="" /></td>
                    </tr>
                    <tr>
                        <td>Name : </td>
                        <td><input type="text" name="name" value="" /></td>
                    </tr>
                    <tr>
                        <td>Gender : </td>
                        <td>
                            <input type="radio" name="gender" value="Male" checked="checked" />Male
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" value="Female" />Female
                        </td>
                    </tr>
                    <tr>
                        <td>Email ID : </td>
                        <td><input type="text" name="email" value="" /></td>
                    </tr>
                    <tr>
                        <td>Mobile Number : </td>
                        <td><input type="text" name="mobile_number" value="" /></td>
                    </tr>
                    <tr>
                        <td>Course : </td>
                        <td>
                            <select name="course">
                                <option>Java</option>
                                <option>PHP</option>
                                <option>Android</option>
                                <option>Oracle</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="submit" value="Save Record"/>
                        </td>
                    </tr>
                </tbody>
            </table>
            </form>
            <?php if($status==1) { ?>
            <h2 class="success">The record has been saved successfully.</h2>
            <?php } ?>
            <?php if($status==2) { ?>
            <h2 class="error">The record could not be saved.</h2>
            <?php } ?>
        </section>    

        <footer>
            <?php require_once '../includes/admin/footer.inc.php';?>
        </footer>
    </body>
</html>
