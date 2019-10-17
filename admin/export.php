<!-- WIP so filename might change (idk where should this go lol)-->
<!--Referenced from-->
<!--https://stackoverflow.com/questions/2170182/how-to-backup-mysql-database-in-php-->

<?php
   $dbhost = '127.0.0.1';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'foodsmith';
   
   $backupFile = "backupfile\\" . $dbname . date("Y-m-d-H-i-s") . '.sql';
   $command = "mysqldump --u $dbuser -p $dbname > $backup_file";
   
   exec($command, $output);
   
   if($output=' '){
		echo "Exported.";
   }
   else{
	   echo "Error.";
	   var_dump($output);
   }
?>