<?php
  // Initialiser la session
  session_start();
  
  // Détruire la session.
  session_destroy();
  header("Location: login.php");

?>