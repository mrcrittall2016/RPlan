<?php

    // configuration
    require("../includes/config.php"); 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE username = ?", "matthew");
    
    
    if (empty($_GET["user"]))
    {
        http_response_code(400);
        exit;
    }
    
    
    $user_name = $_GET["user"]; 
    
    //$user_name = "Rodger"; 
    
    // Check database...
    $rows = Database::query("SELECT Scheme_name FROM `inthev8_main_rplanner`. `reactions` WHERE username = ?", $user_name);
    
    //print_r($rows); 
    
    $schemes = []; 
    
    foreach ($rows as $row){
            
		//print_r($row["Scheme_name"]); 
		array_push($schemes, $row["Scheme_name"]); 
		
    }    
    
    
    header("Content-type: application/json");
    print(json_encode($schemes, JSON_PRETTY_PRINT));
    
 
?>