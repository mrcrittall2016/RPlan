<!-- latest RPlan html - Re-write of RPlan using Bootstrap grid system to be more user friendly and mobile-first. Also includes full PHP back-end with database -->

<!DOCTYPE html>
<html lang = "en">
    <head>     
        
        <meta charset = "utf-8">  
        
        <!-- This tag ensures porper rendering and touch zooming of a page when on any device (ie mobile or tablet). The width=device-width part sets the width of the page to follow the screen-width of the device and the initial-scale sets the zoom when the page is first loaded by the browser -->
        
        <meta name="viewport" content = "width=device-width, initial-scale = 1">
        
        <!-- Javascript for drawing tool -->
        <script type="text/javascript" language="javascript" src="http://peter-ertl.com/jsme/JSME_2016-05-21/jsme/jsme.nocache.js"></script>
        
        <!-- Latest compiled and minified CSS for Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
        <!-- jquery -->
        <script src="/js/jquery-1.11.3.min.js"></script>
        
        <!-- Latest compiled JavaScript for Bootstrap -->
        <script src="/js/bootstrap.min.js"></script>
        
        <!--own style sheet -->
        <link href="/css/rplan.css" rel="stylesheet"/>  
          
        <script>
            
            // Object for generating html on page
            function pages(step){
                
                this.step_number = step; 
                
                // html to ask user how much material they wish to make
                this.quantity = function(){
                    
                    return '<div class="clearfix visible-xs"></div> <div class="col-xs-6 col-md-2 col-md-offset-6"> <div class="form-group"> <input autocomplete="off" autofocus="" class="form-control" name="Quantity" placeholder="Quantity required" type="text" id="quantity"> </div> </div> <div class="col-xs-6 col-md-1" style="padding:0;"> <div class="dropdown"> <button class="btn btn-primary dropdown-toggle" id="quantity_select" type="button" data-toggle="dropdown">Select Units <span class="caret"></span></button> <ul class="dropdown-menu start-quantity" id="menu"> <li><a href="#">milligrams </a></li> <li><a href="#">grams </a></li> <li><a href="#">kilograms </a></li> </ul> </div> </div>';  
                    
                }
                
                // html to ask user how many steps they require to make compound 
                this.step_generate = function(){
                  
                    return '<div class="clearfix visible-xs"></div><div class="col-xs-6 col-md-2 col-md-offset-6" id = "grid_remove1"> <div class="form-group"> <input type="text" class="form-control" autocomplete="off" autofocus="" name="steps" id="steps" placeholder="Number of Synthetic Steps to Target"> </div> </div> <div class="col-xs-6 col-md-1 text-left" id = "grid_remove2" style="padding:0;"> <button class="btn btn-default" type="submit" id="steps_submit"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Generate</button> </div>';
                  
                }
                
                // html for appending to target fields once deleted generate and steps field
                this.kick_off = function(){
                  
                  return '<div class="col-xs-6 col-md-offset-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control input-sm" id="moles_step_' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""> </div> </div><div class="clearfix visible-xs"></div><div class="col-xs-6 col-md-offset-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control input-sm" name="MW" placeholder="Molecular Weight" id = "MW_step_' + this.step_number + '"readonly=""> </div> </div>'; 
                  
                }
                
                
                // html for generating yield field 
                this.yield_field = function(){
                  
                  return '<div class="container-fluid spacer"> <div class="row"> <div class="col-xs-4 col-xs-offset-6 col-md-2 col-md-offset-6"> <div class="form-groups"> <input autocomplete="off" autofocus="" class="form-control" name="yield" id = "yield_step' + this.step_number + '"placeholder="yield" type="text"> </div> </div><div class="col-xs-2 col-md-1" style= "padding:0px;"><h5>Step ' + this.step_number + '</h5></div></div>';
                  
                }
                
                // html for generating molecule fields
                this.molecule = function(){
                  
                  return '<div class="container-fluid spacer"> <div class="row"> <div class="col-xs-12 col-md-3 col-md-offset-3 text-center"> <div id="jsme_container">This is where the drawing object will go</div> </div><div class="col-xs-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control" autocomplete="off" autofocus="" name="smiles" id="smiles_step' + + this.step_number + '"placeholder="Input smiles for intermediate' + this.step_number + '"> </div> </div><div class="col-xs-6 col-md-1 text-left" style="padding:0;"> <button class="btn btn-default" type="submit" id="smiles_transfer' + this.step_number + '"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Transfer</button> </div><div class="clearfix visible-xs"></div> <div class="col-xs-6 col-md-offset-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control input-sm" id="moles_step' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""> </div> </div> <div class="clearfix visible-xs"></div><div class="col-xs-6 col-md-2 col-md-offset-6"> <div class="form-group"> <input type="text" class="form-control input-sm" autocomplete="off" autofocus="" name="MW" placeholder="Molecular Weight" id = "MW_step' + this.step_number + '"readonly=""> </div> </div> </div></div>';
                  
                  
                }
                
                // html for generating how much material to begin with and save button
                this.cap = function(){
                  
                  return '<div class="container-fluid"> <div class="row"> <div class="col-xs-6 col-xs-offset-2 col-md-2 col-md-offset-5 text-center"> <div class="form-group"> <input autocomplete="off" autofocus="" class="form-control" id="start" name="Starting material" placeholder="Please start with" type="text" readonly=""> </div> </div> <div class="col-xs-2 col-md-2" style="padding:0;"> <div class="dropdown"> <button class="btn btn-primary dropdown-toggle" id="start_with" type="button" data-toggle="dropdown">grams <span class="caret"></span></button> <ul class="dropdown-menu begin_with" id="menu"> <li><a href="#">milligrams </a></li> <li><a href="#">grams </a></li> <li><a href="#">kilograms </a></li> </ul> </div> </div> </div></div><div class="container-fluid"> <div class="row spacer"> <div class="col-xs-6 col-xs-offset-2 col-md-2 col-md-offset-5 text-center"> <button class="btn btn-default" type="submit" id="calculate"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Calculate</button> </div> </div></div><div class="container-fluid"> <div class="row spacer"> <div class="col-xs-6 col-xs-offset-2 col-md-2 col-md-offset-5 text-center"> <button class="btn btn-default" type="submit" id="save"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Save Scheme</button> </div> </div></div>'; 
                  
                }
                
            }

            // Global for holding number of synthetic steps
            var steps; 
            
            // Global array for holding drawing objects (or in this simple case, 4 smiles examples)
            var drawing_objects = ["C2=Cc1ccccc1C2", "OC2Cc1ccccc1C2", "O=C2Cc1ccccc1C2","OC2Cc1ccccc1C2"];
            
            // Mock yields for fixed 3 step synthesis 
            var yields = [60, 50, 49]; 
            
            // Global for storing molecules masses and checking have returned all from AJAX call
            var molecular_weights = []; 
            
            // For storing value of button units
            var unit_id; 
            
            // Global for quantity of target required
            var starting_quantity; 
            
            
            $(function(){
  
                  // Here, need to have function that when page loads checks to see if user has any prevously saved reaction schemes
                  check()
                  
                  // Then need function to load schemes from scratch... possibly call bombs_away if calculate button does not exist
                  // OR if does, just fill in form fields with previously saved data
                  // if click on RPlan scheme_id, call load()
                 
                  
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
                  
                  
                  // When click transfer button...
                  $('#smiles_transfer_target').click(function(){
                        
                        // Check that smiles has actually been inputted and is valid 
                       if (smiles_check('#smiles_target')){;
                        
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
                                                      document.getElementById("steps").value = 3;
                                                      steps = 3; 
                                                      
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
                                                              
                                                              // Ensure pass id variables to click event - See http://stackoverflow.com/questions/3994527/passing-parameters-to-click-bind-event-in-jquery
                                                              $(id).bind('click', { id: id, smiles: smiles_id }, function(event){
                                                                  
                                                                  var data = event.data; 
                                                                  smiles_check(data.smiles);
                                                                
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
  
            }); 
            
            // Function to execute once user submits number of steps - essentially a callback
            function bombs_away(steps){
                
                
                // if quantity field is not there
                if ($('#quantity').get(0) == null){
                    
                    // append to row 1 also
                    var page = new pages(0);
                    var quantity = page.quantity();
                    
                    // Put quantity input after smiles input 
                    $('#row1').append(quantity); 
                    
                }
                
                // For Target - call step 0
                var page = new pages("target");
                var start = page.kick_off(); 
                
                // Append to row 1
                $('#row1').append(start);
                
                // Go through and append relevant html to body, id'ing up form fields 
                for (var i = steps; i > 0; i--){
                   
                    var page = new pages(i);
                    var yield_field = page.yield_field(); 
                    var molecules = page.molecule();
                    $('body').append(yield_field);
                    $('body').append(molecules);
                  
                }
                
                var end = page.cap();
                // Finally append quantity to begin with and save button
                $('body').append(end);
                
                // Enable user to change units of starting quantity
                start_quantity();
                
                // Enable user to save scheme in database
                save(); 
                
            }
            
            // Function to toggle units of starting quantity
            function start_quantity(){
              
                $('.begin_with li > a').click(function(){ 
                    
                    event.preventDefault();                 
                    
                    // variable for storing previous units
                    var units = $('#start_with').text(); 
                    console.log(units);
                    units = units.trim(); 
                    
                    // Sense what has changed/been clicked on. See http://stackoverflow.com/questions/19736008/twitter-bootstrap-how-do-i-get-the-selected-value-of-dropdown
                    // and http://stackoverflow.com/questions/18786050/how-to-get-the-innerhtml-of-selectable-jquery-element
                    console.log($(this).html());
                  	var descrip = $(this).html() + ' <span class="caret"></span>'; 	
                    
                    $('#start_with').html(descrip);
                    
                    // if change units...
                    if ($(this).html().trim() == "milligrams"){
                        
                        
                        if (units.match(/kilo/) !== null){
                            
                            console.log("previous was kilograms");
                            // Convert kilograms to milligrams
                            var x = $('#start').val() * 1000000; 
                            x = x.toPrecision(3);
                            $('#start').val(x);
                            units = "milligrams";
                            
                        }
                        
                        else if (units.match(/milli/) !== null){
                            
                            console.log("previous was milligrams");
                            // Leave alone
                            units = "milligrams";
                            
                        }
                        
                        
                        else {
                            
                            console.log("previous was grams");
                            // Convert grams to milligrams
                            var y = $('#start').val() * 1000;
                            y = y.toPrecision(3);
                            $('#start').val(y); 
                            units = "milligrams";
                            
                        }
                         
                           
                    }
                    
                    if ($(this).html().trim() == "kilograms"){
                        
                        if (units.match(/kilo/) !== null){
                            
                            console.log("previous was kilograms");
                            // Leave alone
                            units = "kilograms";
                            
                        }
                        
                        else if (units.match(/milli/) !== null){
                            
                            console.log("previous was milligrams");
                            // Convert milligrams to kilograms
                            var x = $('#start').val() / 1000000;
                            x = x.toPrecision(3);
                            $('#start').val(x); 
                            units = "kilograms";
                            
                        }
                        
                        
                        else {
                            
                            console.log("previous was grams");
                            // Convert grams to kilograms
                            var y = $('#start').val() / 1000;
                            y = y.toPrecision(3);
                            $('#start').val(y); 
                            units = "kilograms";
                            
                        }
                    }
                    
                    if ($(this).html().trim() == "grams"){
                        
                        
                        if (units.match(/kilo/) !== null){
                            
                            console.log("previous was kilograms");
                            // Convert kilograms to grams
                            var x = $('#start').val() * 1000;
                            x = x.toPrecision(3);
                            $('#start').val(x); 
                            units = "grams";
                            
                        }
                        
                        else if (units.match(/milli/) !== null){
                            
                            console.log("previous was milligrams");
                            // Convert milligrams to grams
                            var y = $('#start').val() / 1000;
                            y = y.toPrecision(3);
                            $('#start').val(y);
                            units = "grams";
                            
                        }
                        
                        else {
                            
                            console.log("previous was grams");
                            // Leave alone
                            units = "grams";
                            
                        }
                        
                    }
                    
                    
                }); 
              
            }
            
            // What happens when click calculate button
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
                
               
                // Algorithm for going through smiles array and inserting into correct field (for 3 steps only) as well as retrieving molecular weights
                for (var i = 0, j = steps; i < drawing_objects.length; i++, j--){
                    
                    //console.log(drawing_objects[i]);
                    
                    if (i == 0){
                        
                        var mw = '#MW_step_target';
                        
                        // Get Molecular Weight for first smiles
                        molecular_weight(drawing_objects[i], mw, function(data, mw){
                          
                            $(mw).val(data);
                            molecular_weights.push(mw);
                            // Check number of weights in array - if equal to steps + 1, then perform calculaton
                            add_up(quantity, steps);
                            
                        });
                        
                        // Smiles for target molecule 
                        $('#smiles').val(drawing_objects[i]);
                        j++; 
                      
                    }
                    
                    else if (i > 0){
                        
                        var weight = "#MW_step" + j; 
                        
                        // Get Molecular Weight for first smiles
                        molecular_weight(drawing_objects[i], weight, function(data, weight){
                            
                            $(weight).val(data);
                            molecular_weights.push(weight);
                            // Check number of weights in array - if equal to steps + 1, then perform calculaton
                            add_up(quantity, steps);
                          
                        });
                        
                        // Create correct id for jQuery statement 
                        var smiles = "#smiles_step" + j;
                        
                        // Add in smiles to correct field using jQuery
                        $(smiles).val(drawing_objects[i]); 
                    }
                
                }
               
                  
            }
            
            // Function to get molecular_weights for individual smiles 
            function molecular_weight(smiles, id, success){
              
              
                // See http://www.w3schools.com/jquery/jquery_ajax_get_post.asp for AJAX calls           
                var URL = "https://cactus.nci.nih.gov/chemical/structure/" + smiles +"/mw"; 
            
                // This seems to be more reliable form of AJAX call in terms of the callback working than that in Rplan4.js. See http://stackoverflow.com/questions/4988277/javascript-callback-functions-with-ajax
                $.ajax({
            
                    type:"GET",
                    url: URL,
                    success: function(data){
                        
                        //group.value = data;
                        
                        // Effectively a callback within a callback
                        success(data, id); 
                        
                    },
                    error: function(request, error){
            
                        alert("An error occurred attempting to obtain the molecular weight"); 
                    }
                });
              
            }
            
            // Function to use MWs for intermediates to evaluate moles and yields and determine starting mass to being with
            function add_up(quantity, steps){
              
                 // First calculate moles of target molecule based on mass given 
                
                // Ensure event handler has finished and all molecular weights returned from AJAX call 
                var count = 0; 
                
                for (var i in molecular_weights){
                  
                    count++;
                    console.log(count); 
                    
                }
                
                console.log(steps); 
                console.log(count); 
                
                count = steps + 1;
                console.log(count); 
                
                // If have collected correct number of molecular weights from AJAX call... perform calculation
                if (count == steps + 1){
                    
                    console.log("inside loop"); 
                    console.log("ready to calculate"); 
                    
                    // Starting MW
                    var target_MW = $('#MW_step_target').val(); 
                    
                    // Starting moles
                    var target_moles = quantity / target_MW;
                    var moles = target_moles; 
                    
                    $('#moles_step_target').val(target_moles);
                    
                    for (var i = steps; i > 0; i--){
                      
                        var yield_id = "#yield_step" + i; 
                        
                        // First obtain relevant yield for step
                        var step_yield = $(yield_id).val(); 
                        
                        moles = moles / (step_yield / 100);
                        
                        var moles_id = "#moles_step" + i; 
                        $(moles_id).val(moles); 
                      
                    }
                    
                    // Once finished calculation, obtain starting mass and insert into first field
                    var starting_MW = $('#MW_step1').val(); 
                    var start_with = (moles * starting_MW).toFixed(2);; 
                    $('#start').val(start_with); 
                  
                }
              
            }
            
            // Check validity of smiles in entry field then ultimately transpose to chemstructure
            function smiles_check(smiles){
              
                // Get current value of smiles field 
                var  str = $(smiles).val(); 
                
                // http://www.webdeveloper.com/forum/showthread.php?264705-Best-way-to-check-for-multiple-characters-in-a-string
                // gi refers to global case-insensitive search 
                
                // Need to improve the selecivity of this at later point 
                var smiles_chars = /[cno=]/gi;
    
                var result = str.match(smiles_chars);
    
                if (result == null){
                    
                  
                    alert("Please enter a valid smiles string");
                    // Clear all fields. See http://stackoverflow.com/questions/6364289/clear-form-fields-with-jquery
                    $(smiles).val("");
                    return false; 
    
                }        
    
    
                else if (str == ""){
                    
                    alert("Please enter smiles");
                    return false;  
                }           
    
    
                else {
    
                    
                    // Below add in code to create drawing object
                    /*
                    // First clear first jsme_container 
                    $("#jsme_container").html("");
      
                    // and replace with new parameters..
                    drawing_objects[0] = new JSApplet.JSME("jsme_container", "300px", "250px", {
      
                        "options":"edit,useopenchemlib", // depict in place of edit removes exterior editor window
                        "smiles": smiles
      
                    }); 
                      
                    drawing_objects[0]["step"] = 0; 
                    */
                    return true; 
                    
                }
                
              
            }
            
            // Once user clicks save button, the following function stores required information in back-end database
            function save(){
                
                $('#save').click(function(){
                    
                    console.log(drawing_objects); 
                    
                    // Open modal or pop-up in future.. use AJAX to go to separate PHP page that accepts data... return anything?
                    // Username associated with it? Data stored successfully? Use to add to table or dropdown menu. 
                    // Read-up on code used in history maps and/or mashup. 
                    
                    console.log (starting_quantity); 
                    
                    // Need to obtain amount user needs to begin with..
                    var begin = $('#start').val();
                    console.log(begin); 
                    
                    // Create JSON object to send to back-end
                    var smiles = {
                        
                        smiles: drawing_objects,
                        steps: steps,
                        yields: yields,
                        quantity: starting_quantity,
                        units: unit_id,
                        start: begin,
                        scheme: "RP106415"
                        
                    }; 
                    
                    $.getJSON("smiles_save.php", smiles).done(function(data, textStatus, jqXHR) {
                        
                          // Check data returned successfully 
                          console.log(data);
                          
                          // Need to write a function here to store scheme in dropdown menu
                          save_dropdown(data); 
                          alert("Scheme saved sucessfully! Check the dropdown menu above to access your reaction"); 
                          
                          
                    })
                        
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        // log error to browser's console
                        console.log(errorThrown.toString());
                        alert("Sorry, unable to save scheme at this time!");
                    });
                    
                    
                });
                
            }
            
            // Callback function to store reaction scheme for that user in dropdown menu
            function save_dropdown(data){
                
                console.log(data); 
                
                // Create dropdown if does not already exist ie if new user
                if ($('#rplan_schemes').html() == null){
                    
                    // Set attribute of rplan to have class "dropdown"
                    $('#rplan').attr("class","dropdown");
                    
                    // delete old html 
                    $('#rplan').html(""); 
                    
                    // Append relevant html
                    var html = '<a href="#" data-toggle = "dropdown" class = "dropdown-toggle">RPlan<b class="caret"></b></a> <ul class="dropdown-menu" id = "rplan_schemes"></ul>'; 
                    $('#rplan').append(html); 
                    
                    // Now append data.scheme_name returned from smiles_save
                    var scheme_id = '<li><a href="#">' + data.scheme_name + '</a></li>'; 
                    $('#rplan_schemes').append(scheme_id);
                    
                    
                }
                
                // else if dropdown exists ie if not a new user and have previously saved schemes 
                else {
                    
                    // Simply append data.scheme_name returned from smiles_save
                    var scheme_id = '<li><a href="#" class = "reaction">' + data.scheme_name + '</a></li>'; 
                    $('#rplan_schemes').append(scheme_id);
                    
                }
                
                // Create ability to load schemes
                $('.reaction').click(function(){
                            
                    console.log("inside");
                    console.log($(this).html()); 
                    
                    // Retrieve relevant compounds and conditions from back-end
                    load($(this).html()); 
                    
                }); 
                
            }
            
            // Checks to see if user has schemes already stored in database
            function check(){
                
                // What does user already have
                $.getJSON("retrieve.php").done(function(data, textStatus, jqXHR) {
                        
                    // Check data returned successfully 
                    console.log(data);
                    
                    // If there is actually something in returned array...
                    if (data.length !== 0){
                        
                        // Set attribute of rplan to have class "dropdown"
                        $('#rplan').attr("class","dropdown");
                        
                        // delete old html 
                        $('#rplan').html(""); 
                        
                        // Append relevant html
                        var html = '<a href="#" data-toggle = "dropdown" class = "dropdown-toggle">RPlan<b class="caret"></b></a> <ul class="dropdown-menu" id = "rplan_schemes"></ul>'; 
                        $('#rplan').append(html); 
                        
                        // Store schemes in dropdown menu
                        for (var i = 0; i < data.length; i++){
                            
                            // Now append data.scheme_name returned 
                            var scheme_id = '<li><a href="#" class = "reaction">' + data[i] + '</a></li>'; 
                            $('#rplan_schemes').append(scheme_id);
                            
                        }
                        
                        // If user clicks on any of scheme names in dropdown list
                        $('.reaction').click(function(){
                            
                            console.log("inside");
                            console.log($(this).html()); 
                            
                            // Retrieve relevant compounds and conditions from back-end
                            load($(this).html()); 
                            
                        }); 
                        
                        
                    }
                          
                })
                    
                .fail(function(jqXHR, textStatus, errorThrown) {
                    // log error to browser's console
                    console.log(errorThrown.toString());
                });
                
            }
            
            // Retrieve all reaction data based on scheme_number ie compounds and yields... 
            function load(scheme_number){
                
                console.log(scheme_number); 
                
                var scheme = {scheme:scheme_number}
                
                // What does user already have
                $.getJSON("smiles_load.php", scheme).done(function(data, textStatus, jqXHR) {
                        
                    // Check data returned successfully 
                    console.log(data);
                    
                    var steps = data.steps; 
                    var smiles = data.smiles; 
                    var yields = data.yields; 
                    var quantity = data.quantity;
                    var units = data.units;
                    var start = data.start; 
                    
                    // Now that have in theory data we need, either call bombs_away() or not depending on current
                    // page layout
                    
                    // If save button exists..
                    // Note: See here for explanation of jquery equiv of getelementbyid: http://stackoverflow.com/questions/4069982/document-getelementbyid-vs-jquery
                    
                    if ($('#save').get(0) == null){
                        
                        console.log("limited layout... call bombs_away then fill forms");
                        
                        // Remove any popups
                        pop_remove(); 
                        
                        // Render form fields
                        bombs_away(steps); 
                        
                        // Now fill in form fields
                        fill(smiles, steps, yields, quantity, units, start); 
                        
                        //reactivate previous page features ie dropdowns and buttons and ability to calculate and save
                        activate(steps); 
                        
                    }
                    
                    else {
                        
                        console.log("full layout... fill fields as is");
                        
                        // Just fill in fields 
                        fill(smiles, steps, yields, quantity, units, start); 
                        
                    }
                    
                    
                          
                })
                    
                .fail(function(jqXHR, textStatus, errorThrown) {
                    // log error to browser's console
                    console.log(errorThrown.toString());
                });
                
                
            }
            
            // Function to fill in all fields on a page
            function fill (smiles, steps, yields, quantity, units, start_with){
                
                console.log(quantity);
                console.log(units); 
                console.log(start_with); 
                
                $('#quantity').val(quantity);
                var html = units; 
                $('#quantity_select').html(html); 
                $('#start').val(start_with); 
                
                
                for (var i = 0, j = 0; i < smiles.length; i++, j++){
                    
                    console.log(smiles[i]); 
                    //console.log(yields[i]); 
                    
                    if (i== 0){
                        
                        // Enter first smiles into target field
                        $('#smiles_target').val(smiles[i]);
                        j--; 
                        
                    }
                    
                    else {
                        
                        var smiles_selector = "#smiles_step" + steps;
                        var yield_selector = "#yield_step" + steps;
                        $(smiles_selector).val(smiles[i]);
                        $(yield_selector).val(yields[j]);
                        steps--; 
                        
                    }
                    
                }
                
            }
            
            // Function to remove all popovers on a page
            function pop_remove(){
                
                var popovers = ['#smiles_target', '#quantity', '#steps'];
                
                for (var i = 0; i < popovers.length; i++){
                    
                    $(popovers[i]).popover('destroy');
                    
                }
                
            }
            
            // Function to activate key aspects of webpage if loaded from back-end
            function activate(steps){
                
                $('.start-quantity li > a').click(function(){ 
                                    
                    // Sense what has changed/been clicked on. See http://stackoverflow.com/questions/19736008/twitter-bootstrap-how-do-i-get-the-selected-value-of-dropdown
                    // and http://stackoverflow.com/questions/18786050/how-to-get-the-innerhtml-of-selectable-jquery-element
                    
                  	var descrip = $(this).html() + ' <span class="caret"></span>'; 	
                    $('#quantity_select').html(descrip);
                    unit_id = $(this).html(); 
                
                }); 
                
                // Runs calculation on data returned from database
                re_calculate(steps);
                
                
                // If user wants to change parameters and re-fill form 
                $('#calculate').click(function(){
                    
                    re_calculate(steps);
                    
                });
                
                 
            }
            
            // Used to re-fill and manipulate schemes loaded from the back-end
            function re_calculate(steps){
                
                // Re-obtain smiles and re-populate fields 
                var smiles = [];
                
                console.log(steps);
                
                // Push target molecule onto smiles array first
                smiles.push($('#smiles_target').val());
                
                // Then the rest
                for (var i = steps; i > 0; i--){
                    
                    var id = "#smiles_step" + i; 
                    smiles.push($(id).val()); 
                    
                }
                
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
                
                // Reset global array
                molecular_weights = []; 
                
                
                // Check smiles array and get molecular weights 
                for (var i = 0, j = steps; i < smiles.length; i++, j--){
                    
                    console.log(smiles[i]);
                    
                    if (i == 0){
                    
                        var mw = '#MW_step_target';
                        
                        // Get Molecular Weight for first smiles
                        molecular_weight(smiles[i], mw, function(data, mw){
                          
                            $(mw).val(data);
                            molecular_weights.push(mw);
                            // Check number of weights in array - if equal to steps + 1, then perform calculaton
                            add_up(quantity, steps);
                            
                        });
                        
                        j++; 
                  
                    }
                    
                    else if (i > 0){
                        
                        var weight = "#MW_step" + j; 
                        
                        // Get Molecular Weight for other smiles
                        molecular_weight(smiles[i], weight, function(data, weight){
                            
                            $(weight).val(data);
                            molecular_weights.push(weight);
                            // Check number of weights in array - if equal to steps + 1, then perform calculaton
                            add_up(quantity, steps);
                          
                        });
                        
                    }
            
                }
                
                
            }
            
        </script>  
        
    
    </head>
    <body>
    <!-- Note that the "navbar-toggle" button enables when the screen size is too small, for the navbar to callpse and only be accessible by a button in the top right hand corner of the screen -->   
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
              </button>
              <a class="navbar-brand" href="index.php">ChemMaster</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li id = "rplan"><a href="#">RPlan</a></li>
                <li><a href="#">RScheme</a></li> 
                <li><a href="#">Team Profile</a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container-fluid spacer"></div>
        <div class="container-fluid spacer">
           <div class="row" id = "row1">
           
              <div class="col-xs-12 col-md-3 col-md-offset-3 text-center">
                 
                 <div id="jsme_container">This is where the drawing object will go</div>
              </div>
              
              <div class="col-xs-6 col-md-2">
                 <div class="form-group">
                   <input type="text" class="form-control" autocomplete="off" autofocus="" name="smiles" id="smiles_target" placeholder="Input smiles for target">
                 </div>                
              </div>
              <div class="col-xs-6 col-md-1 text-left" style="padding:0;">
                 <button class="btn btn-default" type="submit" id="smiles_transfer_target"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Transfer</button>
              </div>
           </div>
        </div>

        <footer class="container-fluid footer">
          <p>Company Name <a href="#">Company Website</a></p> 
        </footer>
           
    </body>
</html>
        
        
        