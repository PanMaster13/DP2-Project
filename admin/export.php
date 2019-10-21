<!-- WIP (WORKED FOR NOW) -->
<!--Referenced from-->
<!--https://phppot.com/php/how-to-backup-mysql-database-using-php/-->

<?php
    include_once ($_SERVER['DOCUMENT_ROOT']."/db_conn.php");
	
	$tables = array();
	$sqlQuery = "SHOW TABLES";
	$queryResult = mysqli_query($conn, $sqlQuery);

	//Gets the number of tables available
	while ($row = mysqli_fetch_row($queryResult)) {
		$tables[] = $row[0];
	}
    
	
	//Loop through all the tables available
	$scriptString = "";
	foreach ($tables as $table) {
    
		//Shows the structure of the table
		$sqlQuery = "SHOW CREATE TABLE $table";
		$queryResult = mysqli_query($conn, $sqlQuery);
		$row = mysqli_fetch_row($queryResult);
		
		$scriptString .= "\n\n" . $row[1] . ";\n\n";
		
		
		$sqlQuery = "SELECT * FROM $table";
		$queryResult = mysqli_query($conn, $sqlQuery);
		
		$columnCount = mysqli_num_fields($queryResult);
		
		//Insert all those codes inserting required data to the specific tables into the string
		for ($i = 0; $i < $columnCount; $i ++) {
			while ($row = mysqli_fetch_row($queryResult)) {
				$scriptString .= "INSERT INTO $table VALUES(";
				for ($j = 0; $j < $columnCount; $j ++) {
					$row[$j] = $row[$j];
					
					if (isset($row[$j]))
						$scriptString .= '"' . $row[$j] . '"';
					else
						$scriptString .= '""';
					
					
					if ($j < ($columnCount - 1))
						$scriptString .= ',';
				}
				$scriptString .= ");\n";
			}
		}
		
		$scriptString .= "\n"; 
	}
	
	//Save the script to a sql file if the string is not empty
	if(!empty($scriptString))
	{
		$dbname = "foodsmith";
		
		$backupFileName = $dbname . '_backup_' . date("Y-m-d-H-i-s") . '.sql';
		//Open the file for reading and writing
		$fileHandle = fopen($backupFileName, 'w+');
		//Write content to file
		$number_of_lines = fwrite($fileHandle, $scriptString);
		//Close the file
		fclose($fileHandle); 

		//Download the file to the browser(header), 
		//allowing user to choose a directory to download the file
		//Term is called Force Download
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		//Calls this file for download
		header('Content-Disposition: attachment; filename=' . basename($backupFileName));
		//Encoding within HTTP protocol
		header('Content-Transfer-Encoding: binary');
		//Expires after download completed
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($backupFileName));
		//Cleans and flush output buffer
		ob_clean();
		flush();
		
		//Output the file
		readfile($backupFileName);
		
		//Used to delete the sql file that is created in the root folder 
		unlink($backupFileName);
		
		exec('rm ' . $backupFileName); 
	}
	
?>