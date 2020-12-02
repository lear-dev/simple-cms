<?php
include('../config.php');
session_start();
$user_check=$_SESSION['login_user'];

$ses_sql=mysqli_query($dbcon,"select id, username from admin where username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session=$row['username'];
$login_id=$row['id'];

if(!isset($login_session))
{
header("Location: login.php");
}
?>