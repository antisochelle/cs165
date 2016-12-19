<?php
   session_start();
   
   # Remove all variables
   session_unset();
   
   # Destroy session
   session_destroy();
   
   if(session_destroy()) {
      header("location:https://cs165.herokuapp.com/");
   }
?>