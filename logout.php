<?php
   session_start();
   
   # Remove all variables
   session_unset();
   
   if(session_destroy()) {
      header("location:index.php");
   }
?>