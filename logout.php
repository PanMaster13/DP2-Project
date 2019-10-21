<?php
//destroy the session
session_start();
session_destroy();
header("Location: /");
?>