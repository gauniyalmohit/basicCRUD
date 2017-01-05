<?php
require_once 'secure.inc.php';
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

        <style>
            .button {
                display: inline-block;
                border-radius: 5px;
                background-color: #6699ff;
                border: none;
                color: #FFFFFF;
                text-align: center;
                font-size: 20px;
                padding: 15px;
                min-width: 200px;
                transition: all 0.5s;
                cursor: pointer;
                margin: 5px;
            }

            .button span {
                cursor: pointer;
                display: inline-block;
                position: relative;
                transition: 0.5s;
            }

            .button span:after {
                content: '+';
                position: absolute;
                opacity: 0;
                top: 0;
                right: -20px;
                transition: 0.5s;
            }

            .button:hover span {
                padding-right: 20px;
            }

            .button:hover span:after {
                opacity: 1;
                right: 0;
            }
        </style>

    </head>
    <body>
        <menu>
            <?php require_once '../includes/admin/header.inc.php'; ?>
        </menu>
        <nav>
            <?php require_once '../includes/admin/nav.inc.php'; ?>
        </nav>

        <section>
            <a href="add_student.php"><button class="button" style="vertical-align:middle"><span>Add Student</span></button></a>
        </section>    

        <footer>
            <?php require_once '../includes/admin/footer.inc.php'; ?>
        </footer>
    </body>
</html>
