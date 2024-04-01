<?php
session_start();
session_destroy();
header("login_view.php");