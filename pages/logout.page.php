<?php
session_start();
if ($_SESSION['username'] =="admin"){session_destroy();}


header('Location:/igno2/?page=login');
