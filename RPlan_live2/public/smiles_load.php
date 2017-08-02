<?php

    // configuration
    require("../includes/config.php"); 
    
    /* Test database connection */
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `users` WHERE username = ?", "matthew");
    
    // Smiles array for storage of retrieved compounds
    $smiles_array = []; 
    
    
    if (empty($_GET["scheme"]))
    {
        http_response_code(400);
        exit;
    }
    
    
    //echo "Hello there"; 
    
    //echo $_GET["scheme_number"]; 
    //$scheme_number = "RP106469"; 
    
    $scheme_number = $_GET["scheme"]; 
    
    //echo $scheme_number; 
    
    // Get all details associated with above scheme_number 
    $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `reactions` WHERE Scheme_name = ?", $scheme_number);
    
    if ($rows){
        
        $compounds = $rows[0]["cmpds_id"];
        $steps = $rows[0]["steps"];
        $yields = $rows[0]["yields"];
        $quantity = $rows[0]["quantity"];
        $units = $rows[0]["units"];
        $start = $rows[0]["start"];
        
    }
    
    //print_r($compounds); 
    
    // Decrypt/unserialize compound array
    $compounds = unserialize($compounds);
    $yields = unserialize($yields);
    
    //print_r($compounds);
    //print_r($yields); 
    
    // Retrieve actual smiles
    foreach ($compounds as $compound){
        
        $rows = Database::query("SELECT * FROM `inthev8_main_rplanner`. `cmpds` WHERE id = ?", $compound);
        array_push($smiles_array, $rows[0]["smiles"]); 
        
    }
    
    //print_r($smiles_array); 
    
    // Test returning array. Note if any of the values are NULL ie username, then wil not return properly
    //$info = ["username" => $username, "smiles" => $smiles_array, "scheme_name" => $scheme_number]; 
    $info = ["smiles" => $smiles_array, "yields" => $yields, "steps" => $steps, "quantity" => $quantity, "units" => $units, "start" => $start, "scheme_name" => $scheme_number]; 
    //print_r($info); 
    
    header("Content-type: application/json");
    print(json_encode($info, JSON_PRETTY_PRINT));
   
 
?>