function jsmeOnLoad(){
  			
      // Here, need to have function that when page loads checks to see if user has any prevously saved reaction schemes
      check()    
                        
      
      // Then need function to load schemes from scratch... possibly call bombs_away if calculate button does not exist
      // OR if does, just fill in form fields with previously saved data
      // if click on RPlan scheme_id, call load()
      
      
      // Insert first drawing object onto page                  
	  document.JME = new JSApplet.JSME("jsme_container", "300px", "250px");
	  document.JME["step"] = "target"; 
	  drawing_objects_test.push(document.JME); 
     
      
      /* Open popover on smiles input field. Note, specify container
      to enable sizing of popover based on body, not on column. See http://stackoverflow.com/questions/19448902/changing-the-width-of-bootstrap-popover
      */
      
      setTimeout(function(){$('#smiles_target').popover({
                        
          title:"Synthetic Target",
          trigger:'click',
          html:true,    
          content:"Please draw the target molecule that you wish to synthesise. Or copy and paste its smiles into the above form and click transfer",
          placement:'bottom',
          container:'body'   
        
        
      }).popover('show')}, 500);  
      
      
      // When click submit button...
      $('#submit_target').click(function(){
            
            
           // Check that structure has been drawn
            
                                    
           // Check that smiles has actually been inputted and is valid 
           if (smiles_check('#smiles_target', 'jsme_container')){
            
                $('#smiles_target').popover('destroy'); 
                
                // if quantity field has not been already added
                //var quantity = document.getElementById('quantity');
               
                // ie if can't already find quantity field...
                if ($('#quantity').get(0) == null){
                
                    // Obtain html for quantity and steps field. 
                    var page = new pages(0);
                    var quantity = page.quantity();
                    var step_number = page.step_generate();
                    
                    // Put quantity input after smiles input 
                    $('#row1').append(quantity); 
                    
                    //Open popup on quantity input field
                    setTimeout(function(){$('#quantity').popover({
                                
                      title:"How much would you like to make?",
                      trigger:'click',
                      html:true,    
                      content:"Please enter a quantity for the amount of material required",
                      placement:'bottom',
                      container:'body'   
                      
                      
                    }).popover('show')}, 500);
                    
                    // Get button based on unique id
                    //var button = document.getElementById("quantity_select");
                    
                    // Delete previous popover when click on button
                    $('#quantity_select').click(function(){
                        
                        // Delete quantity popover...
                        $('#quantity').popover('destroy');
                        
                    });
                    
                    // Add click event to all elements within drop-down list
                    $('.start-quantity li > a').click(function(){ 
                        
                        //Check previous value of dropdown
                      	console.log($('#quantity_select').text());
                        
                        // Sense what has changed/been clicked on. See http://stackoverflow.com/questions/19736008/twitter-bootstrap-how-do-i-get-the-selected-value-of-dropdown
                        // and http://stackoverflow.com/questions/18786050/how-to-get-the-innerhtml-of-selectable-jquery-element
                        console.log($(this).html());
                      	var descrip = $(this).html() + ' <span class="caret"></span>'; 	
                        $('#quantity_select').html(descrip); 
                        
                        unit_id = $(this).html(); 
                        
                        // When select units, after fillling form, want to add steps field.. but only once.
                        //var step_id = document.getElementById("steps");
                        //var start = document.getElementById("start"); 
                        
                        if ($('#start').get(0) == null){
                          
                            // Make sure quantity field is filled in...
                            if ($('#quantity').val() == ""){
                              
                                alert("Please input a valid quantity");
                                // Reset button html
                                $('#quantity_select').html('Select Units <span class="caret"></span>'); 
                              
                            }
                            
                            else {  
                              
                                // Store value of quantity field in global variable
                                starting_quantity = $('#quantity').val(); 
                                
                                // Append steps field to current row
                                $('#row1').append(step_number);
                                
                                //.. and add a popover to explain to the user what to do
                                 setTimeout(function(){$('#steps').popover({
                                
                                      title:"Synthetic Steps",
                                      trigger:'click',
                                      html:true,    
                                      content:"Please enter the number of steps required to make the target molecule and click the generate button",
                                      placement:'bottom',
                                      container:'body'   
                                      
                                    
                                  }).popover('show')}, 500);
                                  
                                  // Click generate button
                                  $('#steps_submit').click(function(){
                                      
                                      // Close last popover 
                                      $('#steps').popover('destroy');
                                      
                                      if ($('#steps').val() == ""){
                                        
                                          alert("Please provide a valid number of Steps");
                                        
                                      }
                                      
                                      else {
                                        
                                          // Store value of desired number of steps in global variable
                                          //steps = document.getElementById("steps").value; 
                                          
                                          // For now, fix number of steps to 3
                                          //document.getElementById("steps").value = 3;
                                          //steps = 3; 
                                          
                                          steps = $('#steps').val(); 
                                          
                                          // Remove generate button and steps field
                                          $('#grid_remove1').remove();
                                          $('#grid_remove2').remove();
                                          
                                          // Check if generate button has already been clicked
                                          //var generate = document.getElementById("start");
                                          
                                          if ($('#start').get(0) == null){
                                            
                                              // Render page based on number of steps
                                              bombs_away(steps); 
                                              
                                              // Catch any smiles_transfer errors for each step
                                              for (var i = steps; i > 0; i--){
                                                
                                                  var id = "#smiles_transfer" + i;
                                                  var smiles_id = "#smiles_step" + i; 
                                                  var container_id = "jsme_container" + i; 
                                                  
                                                  // Ensure pass id variables to click event - See http://stackoverflow.com/questions/3994527/passing-parameters-to-click-bind-event-in-jquery
                                                  $(id).bind('click', { id: id, smiles: smiles_id, container: container_id }, function(event){
                                                      
                                                      var data = event.data; 
                                                      smiles_check(data.smiles, data.container);
                                                    
                                                  })
                                                
                                              }
                                              
                                              // If click calculate button...
                                              $('#calculate').click(function(){
                                                
                                                  console.log("calculate button clicked"); 
                                                  // Below, need to populate smiles fields from mock array, then call AJAX function to determine molecular weights...
                                                  
                                                  calculate(); 
                                                
                                              });
                                            
                                          }
                                      }
                                    
                                  })
                              
                            }
                                  
                                  
                                  
                        }
                        
                    });
                    
                }
          
          }  
           
            
      });

}; 

function calculate(){
                
    //"C2=Cc1ccccc1C2", "OC2Cc1ccccc1C2", "O=C2Cc1ccccc1C2","OC2Cc1ccccc1C2"
    
    // Add in mock yields... remove this later on
    for (var i = 0, j = steps; i < yields.length; i++, j--){
      
        var id = "#yield_step" + j;
        $(id).val(yields[i]); 
      
    }
    
    // Get quantity 
    var quantity = $('#quantity').val(); 
    
    unit_id = $('#quantity_select').html();
    // Get units of quantity...
    console.log("unit_id is " + unit_id); 
    
    // if units are milligrams
    if (unit_id.match(/milli/) !== null){
      
        // Replace local variable quantity with new value from field 
        var quantity = $('#quantity').val();
        quantity = quantity / 1000; 
      
    }
    
    // if units are kilograms
    else if (unit_id.match(/kilo/) !== null){
        
        // Replace local variable quantity with new value from field 
        var quantity = $('#quantity').val(); 
        quantity = quantity * 1000;
        
    }
    
    // Re-set global molecular weights array (so that do not keep pushing on to it)
    molecular_weights = []; 
    
    var blank_count = 0;
    var smiles_count = 0; 
    
    // Check contents of drawing_objects_test array and make sure no blanks
    for (var i in drawing_objects_test){
    
        console.log(drawing_objects_test[i].smiles()); 
        var smiles = drawing_objects_test[i].smiles();                    
        
        
        if (smiles == ""){
        
            blank_count++; 
            
        }
        
        else {
        
            smiles_count++; 
        
        }
        
                        
    }
    
    if (blank_count >= 1){
    
        alert("Please draw valid structure(s)"); 
    
    }
    
    console.log(blank_count); 
    console.log(smiles_count); 
    console.log(steps); 

    // Ensure that steps is an integer 
    var a = parseInt(steps);
    var addition = a + 1;
    console.log(addition); 
    
    // Make sure have all smiles in place and in correct order ie "target", "3", "2", "1"
    if (smiles_count == addition){
        
        console.log("Inside smiles_count == addition loop"); 
        
        /*
        // Check order of array - need to write sorting algorithm? 
        for (var i in drawing_objects_test){                    
            
            console.log(drawing_objects_test[i]); 
        
        }
        */
        //alert("correct number of structures!");              
    
        // Algorithm for going through smiles array and inserting into correct field (for 3 steps only) as well as retrieving molecular weights
        for (var i = 0, j = steps; i < drawing_objects_test; i++, j--){
        
            //console.log(drawing_objects_test[i].smiles());
            console.log("Inside calculate algorithm loop"); 
            
            if (i == 0){
            
                var mw = '#MW_step_target';
            
                // Get Molecular Weight for first smiles
                molecular_weight(drawing_objects_test[i].smiles(), mw, function(data, mw){
              
                    $(mw).val(data);
                    molecular_weights.push(mw);
                    // Check number of weights in array - if equal to steps + 1, then perform calculaton
                    add_up(quantity, steps);
                
                });
            
                // Smiles for target molecule 
                $('#smiles').val(drawing_objects_test[i].smiles());
                j++; 
          
            }
        
            else if (i > 0){
            
                var weight = "#MW_step" + j; 
            
                // Get Molecular Weight for first smiles
                molecular_weight(drawing_objects_test[i].smiles(), weight, function(data, weight){
                
                    $(weight).val(data);
                    molecular_weights.push(weight);
                    // Check number of weights in array - if equal to steps + 1, then perform calculaton
                    add_up(quantity, steps);
              
                });
            
                // Create correct id for jQuery statement 
                var smiles = "#smiles_step" + j;
            
                // Add in smiles to correct field using jQuery
                $(smiles).val(drawing_objects_test[i].smiles()); 
            }
    
        }
    
    }
   
      
}