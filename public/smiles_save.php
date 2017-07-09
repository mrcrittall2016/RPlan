<?php

    // configuration
    require("../includes/config.php"); 
    
    /*Test database connection */
    $rows = Database::query("SELECT * FROM `main_rplanner`. `users` WHERE username = ?", "matthew");
    
    if (empty($_GET["smiles"]))
    {
        http_response_code(400);
        exit;
    }
    
    if (empty($_GET["steps"]))
    {
        http_response_code(400);
        exit;
    }
    
    if (empty($_GET["scheme"]))
    {
        http_response_code(400);
        exit;
    }
    
    if (empty($_GET["yields"]))
    {
        http_response_code(400);
        exit;
    }
    
    
    if (empty($_GET["quantity"]))
    {
        http_response_code(400);
        exit;
    }
    
    
    if (empty($_GET["units"]))
    {
        http_response_code(400);
        exit;
    }
    
    if (empty($_GET["start"]))
    {
        http_response_code(400);
        exit;
    }
    
    // Scheme_name from front-end
    $scheme = $_GET["scheme"]; 
    //$scheme = "RP108638"; 
    
    $smiles  = $_GET["smiles"]; 
    //$smiles = ["C2=Cc1ccccc1C2", "OC2Cc1ccccc1C2", "O=C2Cc1ccccc1C2","OC2Cc1ccccc1C2"];
    
    $steps = $_GET["steps"]; 
    //$steps = 3;
    
    $yields = $_GET["yields"];
    //$yields = [60, 50, 49]; 
    
    $quantity = $_GET["quantity"];
    //$quantity = 2;
    
    $units = $_GET["units"];
    //$units = "grams"; 
    
    $start = $_GET["start"];    
    
    // New array to store compounds by id which will be stored in reactions table with username and scheme name
    $smiles_id = [];
    //echo $smiles;
    
    // Get current username 
    $rows = Database::query("SELECT username FROM `main_rplanner` . `users` WHERE id = ?", $_SESSION["id"]);
    $username = $rows[0]["username"];
    
    // Need to iterate through smiles array and check if compound is already in compound database...
    foreach ($smiles as $value){
        
        //echo $value;
        //echo "  ";
        //echo "\r\n"; 
        
        // Check if is in database
        $rows = Database::query("SELECT id FROM `main_rplanner` . `cmpds` WHERE smiles = ?", $value);
        
        // Return true if found compound and hence get id
        if ($rows){
            
            //echo "Must have found compound..let's get the id";
            $id = $rows[0]["id"];
            //echo $id; 
            
            // Push on to smiles_id array
            array_push($smiles_id, $id); 
            
        } 
        
        // Need to store compound as unique
        else {
            
            //echo "Compound is not stored in database... inserting"; 
            
            // Store compound 
            $result = Database::query("INSERT IGNORE INTO `main_rplanner`. `cmpds` (smiles) 
            VALUES(?)", $value);
            
            if (!$result){
                
                //echo "Compound could not be inserted"; 
                
            }
            
            else {
                
                //echo "Compound inserted successfully!";
                $rows = Database::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                //echo $id; 
                
                // Push on to smiles_id array
                array_push($smiles_id, $id); 
                
            }
            
        }
        
    }
    
    //print_r($smiles_id);
    
    // Need to "serialize" arrays before can store in MySQL database... http://stackoverflow.com/questions/3413291/how-to-store-an-array-into-mysql
    $smiles = serialize($smiles_id);
    $yields = serialize($yields); 
    $test = "bobby wobby"; 
    
    // Now that we have a new array based on id we need to store in reactions table
    $result = Database::query("INSERT IGNORE INTO `main_rplanner`. `reactions` (cmpds_id, yields, steps, quantity, units, start, Scheme_name, username) 
    VALUES(?, ?, ?, ?, ?, ?, ?, ?)", $smiles, $yields, $steps, $quantity, $units, $start, $scheme, $username);
    
    //echo $result; 
    
    if (!$result){
        
        
        //echo "Sorry reaction data could not be stored!"; 
        
        // Error... how do we get the error info so can inform front-end? ie to choose a unique scheme_name.
        // Or, check if is already taken at front-end before going to server. 
        
    }
    
    else {
        
        //echo "Congratulations - data has been stored successfully!"; 
        
    }
    
    // Test returning array 
    $info = ["username" => $username, "smiles" => $smiles_id, "yields" => $yields, "quantity" => $quantity, "units" => $units, "begin" => $start, "steps" => $steps, "scheme_name" => $scheme]; 
    
    //print_r($info); 
    
    header("Content-type: application/json");
    print(json_encode($info, JSON_PRETTY_PRINT));
   
 
?>