<?php

session_start();

function isLoggedIn(): bool{
    return(session_status() === PHP_SESSION_ACTIVE && isset($_SESSION["user"]));
}