<?php
session_start();

$_SESSION['user'] = 'logout';

header('Location: http://localhost:3001/login');


