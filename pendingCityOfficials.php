<?php
	include "dbConn.php";
	$theQuery = "SELECT username FROM User";
	$theResponse = mysql_query($theQuery);
	
	$concatLikeRows = array();
    while ($row = mysql_fetch_assoc($theResponse)) {
        	echo $row["username"];
    	
   	}	
?>