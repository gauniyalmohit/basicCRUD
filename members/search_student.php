<?php
    require_once 'secure.inc.php';
    $status=0;
    
    if(isset($_POST['submit']))
    {
        $roll_number=$_POST['roll_number'];
        $query="select * from students where roll_number='$roll_number'";
        require_once '../includes/db.inc.php';
        
        $result=  @mysql_query($query);
        if(@mysql_num_rows($result)==1)
        {
            $status=1;
            $row=  @mysql_fetch_assoc($result);
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
            <?php require_once '../includes/members/header.inc.php'; ?>
        </menu>
        <nav>
            <?php require_once '../includes/members/nav.inc.php'; ?>
        </nav>

        <section>
            <h2 style="text-align: center;">Search Student</h2>
        <form action="search_student.php" method="POST">
            <table border="0">
                <tbody>
                    <tr>
                        <td>Roll Number : </td>
                        <td><input type='text' name='roll_number'></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="submit" value="Search" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
        <hr>
        <?php if($status==1) { ?>
        <table border="1">
                <tbody>
                    <tr>
                        <td>Roll number : </td>
                        <td><?php echo $row['roll_number']; ?></td>
                    </tr>
                    <tr>
                        <td>Name : </td>
                        <td><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Gender : </td>
                        <td><?php echo $row['gender']; ?></td>
                    </tr>
                    <tr>
                        <td>Email : </td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Mobile number : </td>
                        <td><?php echo $row['mobile_number']; ?></td>
                    </tr>
                    <tr>
                        <td>Course : </td>
                        <td><?php echo $row['course']; ?></td>
                    </tr>
                </tbody>
            </table>

        <?php } ?>
        <?php if($status==2) { ?>
        <h2 class="error">Roll number doesn't exist.</h2>
        <?php } ?>
        </section>    

        <footer>
            <?php require_once '../includes/members/footer.inc.php'; ?>
        </footer>
    </body>
</html>
