<?php

require_once 'libs/session.php';

session_unset();
session_destroy();
header("location: login.php");