<?php
include "config.php";
session_start();

// remove all session variables
session_unset();

// destroy the session

if(session_destroy()){
    echo "Session  destroyed";
    header("Location:{$hostname}admin/");

}else{
    echo "Session not destroyed";
}





?>
