<?php
// DO NOT start session here

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_name($name) {
    // Allows letters and spaces only
    return preg_match("/^[a-zA-Z ]+$/", $name);
}
