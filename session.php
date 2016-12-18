<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = pg_query($pg_conn, "SELECT userID FROM Users WHERE userID = '$user_check' ");
   
   $row = pg_fetch_array($ses_sql,NULL,PGSQL_ASSOC);
   
   $login_session = $row['userID'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   } #else {
      #header("location:lol.php"); # Should go here if login_user is found! and may session
   #}
?>