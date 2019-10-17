<?php
$output = shell_exec("git pull origin master");
echo "<pre>".$output."</pre>";
?>
