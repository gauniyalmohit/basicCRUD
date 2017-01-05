<?php
    @mysql_connect('localhost','root','') or die('Can\'t connect to server right now.');
    @mysql_select_db('unisoft') or die('The database is not Available');
?>