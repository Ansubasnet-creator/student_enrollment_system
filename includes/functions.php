<?php
session_start();

function check_login(){
    if(empty($_SESSION['admin'])){
        header("Location: login.php");
        exit;
    }
}
