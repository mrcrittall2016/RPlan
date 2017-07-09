<?php

    // configuration
    require("../includes/config.php"); 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `main_rplanner`. `users` WHERE username = ?", "matthew");
    
    if (empty($_GET["scheme"]))
    {
        http_response_code(400);
        exit;
    }
    
    $scheme = $_GET["scheme"]; 
    
    // Check database...
    $rows = Database::query("SELECT * FROM `main_rplanner`. `reactions` WHERE Scheme_name = ?", $scheme);
    
    // If not in table
    if (!$rows){
        
        $return = false; 
        
    }
    
    else if ($rows){
        
        $return = true; 
        
    }
    
    $info = ["result" => $return]; 
    
    header("Content-type: application/json");
    print(json_encode($info, JSON_PRETTY_PRINT));
   
 
?>