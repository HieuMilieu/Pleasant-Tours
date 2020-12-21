<?php
session_start();
session_destroy();
header('Location: ../Tour/index.php');