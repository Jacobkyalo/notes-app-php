<?php

//destroy session go to login
session_start();
session_destroy();
header('Location: ../index.php');

?>