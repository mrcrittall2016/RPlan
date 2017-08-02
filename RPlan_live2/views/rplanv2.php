<!-- latest RPlan html - Re-write of RPlan using Bootstrap grid system to be more user friendly and mobile-first. Also includes full PHP back-end with database -->

<!DOCTYPE html>
<html lang = "en">
    <head>     
        
        <meta charset = "utf-8">  
        
        <!-- This tag ensures porper rendering and touch zooming of a page when on any device (ie mobile or tablet). The width=device-width part sets the width of the page to follow the screen-width of the device and the initial-scale sets the zoom when the page is first loaded by the browser -->
        
        <meta name="viewport" content = "width=device-width, initial-scale = 1">
        
        <!-- Javascript for drawing tool -->
        <script type="text/javascript" language="javascript" src="http://peter-ertl.com/jsme/JSME_2017-02-26/jsme/jsme.nocache.js"></script>
        
        <!-- Latest compiled and minified CSS for Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
        <!-- jquery -->
        <script src="/js/jquery-1.11.3.min.js"></script>
        
        <!-- Latest compiled JavaScript for Bootstrap -->
        <script src="/js/bootstrap.min.js"></script>
        
        <!--own style sheet -->
        <link href="/css/rplan.css?parameter=3" rel="stylesheet"/>  
          
        <script>
            
            // Object for generating html on page
            function pages(step){
                
                this.step_number = step; 
                
                
                this.draw = function jsmeOnLoad () {                

        			 var container = "jsme_container" + this.step_number; 
        			 
        			 document.JME2 = new JSApplet.JSME(container, "300px", "250px");            
					 
       				 // Add identifier to JME object 
       				 document.JME2["step"] = this.step_number; 

        			 // Push on to global array
        			 drawing_objects_test.push(document.JME2);                 

   				 }
                
                
                // html to ask user how much material they wish to make
                this.quantity = function(){
                    
                    //return '<div class="clearfix visible-xs"></div> <div class="col-xs-6 col-md-2 col-md-offset-6"> <div class="form-group"> <input autocomplete="off" autofocus="" class="form-control" name="Quantity" placeholder="Quantity required" type="text" id="quantity"> </div> </div> <div class="col-xs-6 col-md-1" style="padding:0;"> <div class="dropdown"> <button class="btn btn-primary dropdown-toggle" id="quantity_select" type="button" data-toggle="dropdown">Select Units <span class="caret"></span></button> <ul class="dropdown-menu start-quantity" id="menu"> <li><a href="#">milligrams </a></li> <li><a href="#">grams </a></li> <li><a href="#">kilograms </a></li> </ul> </div> </div>';  
                    
                    return '<div class = "row"> <div class="form-group col-md-8 col-xs-10"> <input autocomplete="off" autofocus="" class="form-control" name="Quantity" placeholder="Quantity required" type="text" id="quantity"> </div> <div class="col-md-3 col-xs-2" style="padding:0;"> <div class="dropdown"> <button class="btn btn-primary dropdown-toggle" id="quantity_select" type="button" data-toggle="dropdown">Select Units <span class="caret"></span></button> <ul class="dropdown-menu start-quantity" id="menu"> <li><a href="#">milligrams </a></li> <li><a href="#">grams </a></li> <li><a href="#">kilograms </a></li> </ul> </div> </div> </div>';  
                    
                }
                
                // html to ask user how many steps they require to make compound 
                this.step_generate = function(){
                  
                    //return '<div class="clearfix visible-xs"></div><div class="col-xs-6 col-md-2 col-md-offset-6" id = "grid_remove1"> <div class="form-group"> <input type="text" class="form-control" autocomplete="off" autofocus="" name="steps" id="steps" placeholder="Number of Synthetic Steps to Target"> </div> </div> <div class="col-xs-6 col-md-1 text-left" id = "grid_remove2" style="padding:0;"> <button class="btn btn-default" type="submit" id="steps_submit"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Generate</button> </div>';
                    return '<div class = "row" id = "grid_remove1"> <div class="form-group col-md-8 col-xs-10"> <input type="text" class="form-control" autocomplete="off" autofocus="" name="steps" id="steps" placeholder="Steps"> </div> <div class="col-md-3 col-xs-2 text-left" id = "grid_remove2" style="padding:0;"> <button class="btn btn-default" type="submit" id="steps_submit"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Generate</button> </div></div>'
                }
                
                // html for appending to target fields once deleted generate and steps field
                this.kick_off = function(){
                  
                    //return '<div class="col-xs-6 col-md-offset-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control input-sm" id="moles_step_' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""> </div> </div><div class="clearfix visible-xs"></div><div class="col-xs-6 col-md-offset-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control input-sm" name="MW" placeholder="Molecular Weight" id = "MW_step_' + this.step_number + '"readonly=""> </div> </div>'; 
                    //return '<div class="row"> <div class="form-group col-md-8"> <input type="text" class="form-control input-sm" id="moles_step_' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""></div> </div> <div class="form-group col-md-8 style="padding:0; margin-left:0"> <input type="text" class="form-control input-sm" id="moles_step_' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""></div> </div></div>' 
                    return '<div class="row"> <div class="form-group col-md-8 col-xs-10"> <input type="text" class="form-control input-sm" id="moles_step_' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""></div> </div> </div><div class = "row"> <div class="form-group col-md-8 col-xs-10"> <input type="text" class="form-control input-sm" autocomplete="off" autofocus="" name="MW" placeholder="Molecular Weight" id = "MW_step_' + this.step_number + '"readonly=""></div> </div> </div>' 
                }
                
                
                // html for generating yield field 
                this.yield_field = function(){
                  
                  return '<div class="container-fluid spacer remove_later"> <div class="row"> <div class="col-xs-4 col-xs-offset-6 col-md-2 col-md-offset-6"> <div class="form-groups"> <input autocomplete="off" autofocus="" class="form-control" name="yield" id = "yield_step' + this.step_number + '"placeholder="yield" type="text"> </div> </div><div class="col-xs-2 col-md-1" style= "padding:0px;"><h5>Step ' + this.step_number + '</h5></div></div>';
                  
                }
                
                // html for generating molecule fields
                this.molecule = function(){
                  
                  //return '<div class="container-fluid spacer"> <div class="row"> <div class="col-xs-12 col-md-3 col-md-offset-3 text-center"> <div id="jsme_container' + this.step_number + '"></div> </div><div class="col-xs-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control" autocomplete="off" autofocus="" name="smiles" id="smiles_step' + + this.step_number + '"placeholder="Input smiles for intermediate' + this.step_number + '"> </div> </div><div class="col-xs-6 col-md-1 text-left" style="padding:0;"> <button class="btn btn-default" type="submit" id="smiles_transfer' + this.step_number + '"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Transfer</button> </div><div class="clearfix visible-xs"></div> <div class="col-xs-6 col-md-offset-6 col-md-2"> <div class="form-group"> <input type="text" class="form-control input-sm" id="moles_step' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""> </div> </div> <div class="clearfix visible-xs"></div><div class="col-xs-6 col-md-2 col-md-offset-6"> <div class="form-group"> <input type="text" class="form-control input-sm" autocomplete="off" autofocus="" name="MW" placeholder="Molecular Weight" id = "MW_step' + this.step_number + '"readonly=""> </div> </div> </div></div>';
                  return '<div class="container-fluid spacer remove_later"> <div class="row"> <div class="col-xs-12 col-md-3 col-md-offset-3 text-center"> <div id="jsme_container' + this.step_number + '" style = "margin-bottom:5%;"></div> </div> <div class="col-xs-8 col-md-3"> <div class = "row"> <div class="form-group col-md-8 col-xs-10"> <input type="text" class="form-control" autocomplete="off" autofocus="" name="smiles" id="smiles_step' + + this.step_number + '"placeholder="Input smiles for intermediate' + this.step_number + '"> </div> <div class="col-md-3 col-xs-2 text-left" style="padding:0;"> <button class="btn btn-default" type="submit" id="smiles_transfer' + this.step_number + '"><span aria-hidden="true" class="glyphicon glyphicon-log-in"> </span> Transfer</button> </div> </div> <div class = "row"> <div class="form-group col-md-8 col-xs-10"> <input type="text" class="form-control input-sm" id="moles_step' + this.step_number + '"autocomplete="off" autofocus="" name="moles" placeholder="Moles" readonly=""> </div> </div> <div class = "row"> <div class="form-group col-md-8 col-xs-10"> <input type="text" class="form-control input-sm" autocomplete="off" autofocus="" name="MW" placeholder="Molecular Weight" id = "MW_step' + this.step_number + '"readonly=""> </div> </div> </div> </div></div>'
                  
                }
                
                // html for generating how much material to begin with and save button
                this.cap = function(){
                  
                  return '<div class="container-fluid remove_later"> <div class="row"> <div class="col-xs-6 col-xs-offset-2 col-md-2 col-md-offset-5 text-center"> <div class="form-group"> <input autocomplete="off" autofocus="" class="form-control" id="start" name="Starting material" placeholder="Please start with" type="text" readonly=""> </div> </div> <div class="col-xs-2 col-md-2" style="padding:0;"> <div class="dropdown"> <button class="btn btn-primary dropdown-toggle" id="start_with" type="button" data-toggle="dropdown">grams <span class="caret"></span></button> <ul class="dropdown-menu begin_with" id="menu"> <li><a href="#">milligrams </a></li> <li><a href="#">grams </a></li> <li><a href="#">kilograms </a></li> </ul> </div> </div> </div></div><div class="container-fluid remove_later"> <div class="row spacer"> <div class="col-xs-6 col-xs-offset-2 col-md-2 col-md-offset-5 text-center"> <button class="btn btn-default" type="submit" id="calculate"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Calculate</button> </div> </div></div><div class="container-fluid remove_later"> <div class="row spacer"> <div class="col-xs-6 col-xs-offset-2 col-md-2 col-md-offset-5 text-center"> <button class="btn btn-default" type="submit" id="save" data-toggle="modal" data-target="#myModal"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Save Scheme</button> </div> </div><!-- Modal --> <div id="myModal" class="modal fade" role="dialog"> <div class="modal-dialog"> <!-- Modal content--> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">×</button> <h4 class="modal-title">Save Scheme</h4> </div> <div class="modal-body"> <div class="form-group"> <label for="usrname">Please choose a name or ID for this scheme</label> <input type="text" class="form-control" id="scheme_id" placeholder="Scheme ID"> </div> <button type="submit" class="btn btn-primary btn-block" id="submit_scheme"><span class="glyphicon glyphicon-off"></span> Submit</button> </div> <div class="modal-footer" style = "text-align:center"> <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--> </div> </div> </div> </div> </div>'; 
                  
                }
                
            }

            // Global for holding number of synthetic steps
            var steps; 
            
            // Global array for holding drawing objects (or in this simple case, 4 smiles examples)
            var drawing_objects = ["C2=Cc1ccccc1C2", "OC2Cc1ccccc1C2", "O=C2Cc1ccccc1C2","OC2Cc1ccccc1C2"];
            
            // Actual array for holding all JSME objects
            var drawing_objects_test = []; 
            
            // Mock yields for fixed 3 step synthesis 
            //var yields = [60, 50, 49]; 
            var yields = []; 
            
            // Global for storing molecules masses and checking have returned all from AJAX call
            var molecular_weights = []; 
            
            // For storing value of button units
            var unit_id; 
            
            // Global for quantity of target required
            var starting_quantity; 
            
            
            //$(function(){
  			function jsmeOnLoad(){
  			
                    
                  // Changes nav bar to reflect user sign in  
                  menu_change();  
                   
                  // Here, need to have function that when page loads checks to see if user has any prevously saved reaction schemes
                  check();                                  
                  
                  // Then need function to load schemes from scratch... possibly call bombs_away if calculate button does not exist
                  // OR if does, just fill in form fields with previously saved data
                  // if click on RPlan scheme_id, call load()
                  
                  
                  // Insert first drawing object onto page                  
    			  document.JME = new JSApplet.JSME("jsme_container", "300px", "250px");
    			  document.JME["step"] = "target"; 
    			  drawing_objects_test.push(document.JME); 
                 
                  
                  /* Open popover on smiles input field. Note, specify container
                  to enable sizing of popover based on body, not on column. See http://stackoverflow.com/questions/19448902/changing-the-width-of-bootstrap-popover
                  Also ensure popover only opens on desktop, not mobile: http://stackoverflow.com/questions/11903001/hiding-bootstrap-tooltips-on-mobile-using-media-queries                  
                  */
                  
                  if (!window.matchMedia || !(window.matchMedia("(max-width: 767px)").matches)) {
                      
                      setTimeout(function(){$('#smiles_target').popover({
                                    
                          title:"Synthetic Target",
                          trigger:'click',
                          html:true,    
                          content:"Please draw the target molecule that you wish to synthesise. Or copy and paste its smiles into the above form and click transfer",
                          placement:'bottom',
                          container:'body'   
                    
                    
                      }).popover('show')}, 500);  
                 }
                  
                  
                  $('#smiles_transfer_target').click(function(){
                  
                        smiles_check("#smiles_target", "jsme_container");
                  
                  }); 
                  
                  
                  // When click submit button...
                  $('#submit_target').click(function(){
                        
                        
                       // Check that structure has been drawn
                       var smiles = drawing_objects_test[0].smiles(); 
                       console.log(smiles); 
                                                
                       // Check that smiles has actually been inputted and is valid 
                       if (smiles !== ""){
                        
                            $('#smiles_target').popover('destroy');
                            $('#smiles_target').val(smiles);  
                            
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
                                
                                
                                if (!window.matchMedia || !(window.matchMedia("(max-width: 767px)").matches)) {
                                    //Open popup on quantity input field
                                    setTimeout(function(){$('#quantity').popover({
                                            
                                      title:"How much would you like to make?",
                                      trigger:'click',
                                      html:true,    
                                      content:"Please enter a quantity for the amount of material required",
                                      placement:'bottom',
                                      container:'body'   
                                  
                                  
                                    }).popover('show')}, 500);
                                }
                                
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
                                             if (!window.matchMedia || !(window.matchMedia("(max-width: 767px)").matches)) {
                                                 setTimeout(function(){$('#steps').popover({
                                            
                                                      title:"Synthetic Steps",
                                                      trigger:'click',
                                                      html:true,    
                                                      content:"Please enter the number of steps required to make the target molecule and click the generate button",
                                                      placement:'bottom',
                                                      container:'body'   
                                                  
                                                
                                                  }).popover('show')}, 500);
                                             }
                                              
                                              // Click generate button
                                              $('#steps_submit').click(function(){
                                                  
                                                  // Close last popover 
                                                  $('#steps').popover('destroy');
                                                  
                                                  if ($('#steps').val() == ""){
                                                    
                                                      alert("Please provide a valid number of Steps");
                                                    
                                                  }
                                                  
                                                  else {
                                                    
                                                      // Store value of desired number of steps in global variable                                                    
                                                      
                                                      steps = $('#steps').val(); 
                                                      
                                                      // Remove generate button and steps field
                                                      $('#grid_remove1').remove();
                                                      $('#grid_remove2').remove();
                                                      $('#submit_target').remove(); 
                                                      
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
                      
                      else {
                      
                            alert("Please draw a valid structure!"); 
                      
                      }
                      
                                            
                        
                  });
  
            }; 
            
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
                
                // If moles and MW fields are not already there 
                if ($('#moles_step_target').get(0) == null){
                
                    var start = page.kick_off(); 
                    // Append to row 1
                    $('#row1').append(start);
                }        
                
                // Go through and append relevant html to body, id'ing up form fields 
                for (var i = steps; i > 0; i--){
                   
                    var page = new pages(i);
                    var yield_field = page.yield_field(); 
                    var molecules = page.molecule();                    
                    $('body').append(yield_field);
                    $('body').append(molecules);
                    page.draw(); 
                  
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
                
                
                var yield_check = 0; 
                
                // Re-set yields array 
                yields = []; 
                
                for (var i = steps; i > 0; i--){
                
                    var id = "#yield_step" + i;
                    var yield = $(id).val();
                    
                    if (yield == ""){
                    
                        yield_check++;
                        
                    }     
                    
                    else {
                    
                        // Push yield onto yields array... assuming in correct order. 
                        yields.push(yield); 
                    
                    }              
                
                }
                
                if (yield_check >= 1){
                
                    alert("Please ensure all yield fields are filled!");                 
                
                }
                
                else {
                
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
                                
                                
                            // Make sure drawing_objects array is in correct order
                            drawing_objects_test = sort(drawing_objects_test); 
                    
                            /* *** Check order of array - need to write sorting algorithm? ****
                            for (var i in drawing_objects_test){                    
                        
                                alert(drawing_objects_test[i].step);                                
                    
                            }*/
                    
                            //alert("correct number of structures!");              
                
                            // Algorithm for going through smiles array and inserting into correct field as well as retrieving molecular weights
                            for (var i = 0, j = steps; i < drawing_objects_test.length; i++, j--){
                    
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
                  
            }
            
            // Function to get molecular_weights for individual smiles 
            function molecular_weight(smiles, id, success){
              
                console.log("Inside molecular_weight function.. preparing ajax call")
                console.log("Smiles being sent is: " + smiles)

                // See http://www.w3schools.com/jquery/jquery_ajax_get_post.asp for AJAX calls. Note as of 22/07/2017, changed from http to https... see here: https://cactus.nci.nih.gov/. This may have been why AJAX call was previously failing.     
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
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(jqXHR.status); // Reads 0  "In my experience, you'll see a status of 0 when either doing cross-site scripting (where access is denied) or requesting a URL that is unreachable (typo, DNS issues, etc)". Seems particularly relevant: https://stackoverflow.com/questions/7685288/problems-reading-the-http-status-error-code-from-jquery-ajax AND http://jsfiddle.net/dhaXn/
                        console.log(errorThrown); // Reads blank  
                        console.log(textStatus); // Reads error
                        alert("An error occurred attempting to obtain the molecular weight"); 
                    }
                });
              
            }
            
            // Function to use MWs for intermediates to evaluate moles and yields and determine starting mass to being with
            function add_up(quantity, steps){
              
                // First calculate moles of target molecule based on mass given.
                 
                // **** Note if re_calculating from back-end, need to re-populate yields array otherwise will just use old global
                // values ***
                
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
            function smiles_check(smiles, container){
              
                console.log(smiles); 
                console.log(container);              
                
                // Get current value of smiles field 
                var  str = $(smiles).val(); 
                console.log(str); 
        
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
                
        
                    // First clear the relevant jsme_container 
                    var id = "#" + container; 
                    $(id).html("");
                    
                    
                    // and remove it from the drawing_objects_test array
                    if (container == "jsme_container"){
                
                        for (var i in drawing_objects_test){
                        
                            if (drawing_objects_test[i]["step"] == "target"){
                            
                                drawing_objects_test.splice($.inArray(drawing_objects_test[i], drawing_objects_test),1);
                            
                            }                        
                        
                        
                        }    
                        
                        document.JME2 = new JSApplet.JSME(container, "300px", "250px", {
        
                            "options":"edit,useopenchemlib", // depict in place of edit removes exterior editor window
                            "smiles": str
        
                        });                 
                    
                        document.JME2["step"] = "target"; 
                    
                        // Push onto drawing_objects array
                        drawing_objects_test.push(document.JME2);          
                
                
                    }
                    
                    else {
                        
                        // Get the number associated with the container name 
                        var number = container.replace(/[^0-9]/g,'');
                        console.log(number);
                        
                        for (var i in drawing_objects_test){
                        
                            if (drawing_objects_test[i]["step"] == number){
                            
                                drawing_objects_test.splice($.inArray(drawing_objects_test[i], drawing_objects_test),1);
                            
                            }                        
                        
                        
                         }   
                         
                         document.JME2 = new JSApplet.JSME(container, "300px", "250px", {
        
                            "options":"edit,useopenchemlib", // depict in place of edit removes exterior editor window
                            "smiles": str
        
                        });                 
                    
                        document.JME2["step"] = number; 
                    
                        // Push onto drawing_objects array
                        drawing_objects_test.push(document.JME2);                 
                    
                    }         
                    
                    
                    return true; 
        
                }        
                
              
            }
            
            // Once user clicks save button, the following function stores required information in back-end database
            function save(){
                
                $('#save').click(function(){
                    
                    //console.log(drawing_objects); 
                    
                    // Open modal or pop-up in future.. use AJAX to go to separate PHP page that accepts data... return anything?
                    // Username associated with it? Data stored successfully? Use to add to table or dropdown menu. 
                    // Read-up on code used in history maps and/or mashup. 
                    
                    // Now when click on "submit"
                     $('#submit_scheme').click(function(){
      
                      	
                      	//alert("submit button clicked"); 
                      	console.log($('#scheme_id').val());
                      	var scheme_tag = $('#scheme_id').val(); 
                      	var scheme_id = {scheme: scheme_tag} 
                      	
                      	// Once obtained scheme id that user wants to save as, need to check database of back-end to make sure not duplicated
                      	$.getJSON("scheme_check.php", scheme_id).done(function(data, textStatus, jqXHR){
                            
                              // Check data returned successfully 
                              console.log(data);
                              
                              // If scheme id does not already exist...
                              if (data.result == false){
                                  
                                    //alert("id does not already exist");
                                  
                                    // Save unique id and reaction details...
                                    var begin = $('#start').val();
                                    console.log(begin); 
                                    
                                    console.log("drawing_objects are:" + drawing_objects_test); 
                                    console.log("steps are:" + steps); 
                                    console.log("yields are:" + yields); 
                                    console.log("quantity is:" + starting_quantity); 
                                    console.log("units are:" + unit_id);
                                    console.log("scheme is:" + scheme_tag);  
                                    
                                   
                                    
                                    // Need to convert array of drawing objects to array of smiles... but first need to ensure 
                                    // drawing_objects are in correct order 
                                    
                                    var smiles_array = []; 
                                                                   
                                    
                                    drawing_objects_test = sort(drawing_objects_test); 
                                     
                                    
                                     // Ok this works, but saves things in completely the wrong order. Need to sort drawing_objects array 
                                     // before either calculate OR save. 
                                     for (var i in drawing_objects_test){
                                     
                                        
                                        //alert(drawing_objects_test[i].step); 
                                        smiles_array.push(drawing_objects_test[i].smiles()); 
                                     
                                     
                                     }                                    
                                    
                                   
                                    
                                    // Create JSON object to send to back-end
                                    var smiles = {
                                        
                                        smiles: smiles_array,
                                        steps: steps,
                                        yields: yields,
                                        quantity: starting_quantity,
                                        units: unit_id,
                                        start: begin,
                                        scheme: scheme_tag
                                        
                                    }; 
                                    
                                    $.getJSON("smiles_save.php", smiles).done(function(data, textStatus, jqXHR) {
                                        
                                          // Check data returned successfully 
                                          console.log(data);
                                          
                                          // Need to write a function here to store scheme in dropdown menu
                                          save_dropdown(data); 
                                          //alert("Scheme saved sucessfully! Check the dropdown menu above to access your reaction"); 
                                          var message = '<h5 id = "success">Congratulations, reaction scheme successfully saved! </h5>';
                                          
                                          // Clear all previous messages
                                          $('#fail').remove();
                                          $('#success').remove();
                                          
                                          $('.modal-footer').append(message);
                                          
                                    })
                                        
                                    .fail(function(jqXHR, textStatus, errorThrown) {
                                        // log error to browser's console
                                        console.log(errorThrown.toString());
                                    });
                                  
                              }
                              
                              else if (data.result == true){
                                  
                                  alert("sorry, id already taken!"); 
                                  var message = '<h5 id = "fail">Sorry, reaction id already exists! Please choose another </h5>';
                                  
                                  // Clear all previous messages
                                  $('#fail').remove();
                                  $('#success').remove();
                                  
                                  $('.modal-footer').append(message);
                                  
                              }
                              
                              
                        })
                            
                        .fail(function(jqXHR, textStatus, errorThrown) {
                            // log error to browser's console
                            console.log(errorThrown.toString());
                        });
                      
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
                    console.log("error " + textStatus);
                    console.log("incoming Text " + jqXHR.responseText);
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
                    
                    steps = data.steps; 
                    var smiles = data.smiles; 
                    //alert(smiles); 
                    yields = data.yields; 
                    starting_quantity = data.quantity;
                    unit_id = data.units;
                    var quantity = data.start; 
                    
                    // Now that have in theory data we need, either call bombs_away() or not depending on current
                    // page layout
                    
                    // If save button does not exist
                    // Note: See here for explanation of jquery equiv of getelementbyid: http://stackoverflow.com/questions/4069982/document-getelementbyid-vs-jquery
                    
                    if ($('#save').get(0) == null){
                        
                        console.log("limited layout... call bombs_away then fill forms");
                        
                        // Remove any popups
                        pop_remove(); 
                        
                        // Remove submit button
                        $('#submit_target').remove(); 
                        
                        // Render form fields
                        bombs_away(steps); 
                        
                        // Now fill in form fields
                        fill(smiles, steps, yields, starting_quantity, unit_id, quantity); 
                        
                        //reactivate previous page features ie dropdowns and buttons and ability to calculate and save
                        activate(steps); 
                        
                    }
                    
                    // If save button does exist ie bombs_away has already been called...
                    else {
                        
                        console.log("full layout... fill fields as is");
                        
                        
                        // Need to remove everything from page first then call bombs_away()             
                       
                        
                        // Removes all html below target molecule
                        $('.remove_later').remove(); 
                        
                        //Replaces with correct #steps                                             
                        
                        // Remove any popups
                        pop_remove(); 
                        
                        // Render form fields
                        bombs_away(steps);
                        
                        // Just fill in fields 
                        fill(smiles, steps, yields, starting_quantity, unit_id, quantity); 
                        
                        activate(steps); 
                        
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
                
                //** It turns out that depict mode puts all molecules into view so do not need to zoom or resize drawing object **//
                
                for (var i in drawing_objects_test){                
                                  
                    drawing_objects_test[i].options("depict,useopenchemlib");             
                
                }                
                
                // Re-activate smiles transfer buttons
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
                
                // If user wants to change parameters and re-fill form 
                $('#calculate').click(function(){
                    
                    re_calculate(steps);
                    
                });          
              
                
                 
            }
            
            // Used to re-fill and manipulate schemes loaded from the back-end
            function re_calculate(steps){
                
                var yield_check = 0; 
                
                // Re-set yields array 
                yields = []; 
                
                for (var i = steps; i > 0; i--){
                
                    var id = "#yield_step" + i;
                    var yield = $(id).val();
                    
                    if (yield == ""){
                    
                        yield_check++;
                        
                    }     
                    
                    else {
                    
                        // Push yield onto yields array... assuming in correct order. 
                        yields.push(yield); 
                    
                    }              
                
                }
                
                if (yield_check >= 1){
                
                    alert("Please ensure all yield fields are filled!");                 
                
                }
                
                else {       
                
                
                
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
                    
                    
                            smiles_check("#smiles_target", "jsme_container");
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
                        
                            var smiles_id = "#smiles_step" + i; 
                            var container_id = "jsme_container" + i; 
                        
                            smiles_check(smiles_id, container_id);
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
                
                
            }
            
            // Function to change name of user in nav bar.  
            function menu_change(){
                
                // Get PHP variables ie username if signed in 
                var name = "<?php echo $name ?>"
                
                console.log(name); 
                
                // If $name is not empty or undefined... ie if someone is logged in. 
                if (name !== "undefined"){
                    
                    // Need to create dropdown in nav bar in place of login
                    var login = document.getElementById("login");  
                
                    //var login = document.getElementsByClassName("navbar-right")[0].children[1].innerHTML; 
                    console.log(login);
                
                    // Change attribute of login id to dropdown menu
                    login.setAttribute("class", "dropdown");  
               
                    // Now change innerHTML to be dropdown menu. See http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/bootstrap-dropdowns.php
                    //login.innerHTML = '<a href="#" data-toggle="dropdown" class="dropdown-toggle">' + name + '<b class="caret"></b></a> <ul class="dropdown-menu"> <li><a href="#">Inbox</a></li> <li><a href="#">Drafts</a></li> <li><a href="#">Sent Items</a></li> <li class="divider"></li> <li><a href="logout.php"> Logout</a></li></ul>'
                    login.innerHTML = '<a href="#" data-toggle="dropdown" class="dropdown-toggle">' + name + '<b class="caret"></b></a> <ul class="dropdown-menu"><li><a href="History.php">Reaction Schemes</a></li> <li class="divider"></li> <li><a href="logout.php"> Logout</a></li></ul>'
                
                    // Remove sign up button on nav bar if are logged in
                    var register = document.getElementById("register");
                    console.log(register); 
                    register.innerHTML = ""; 
                    
                }
                
                
            }         
            
            // Write function here to sort drawing_object_array before calculate/re_calculate or save
            function sort(array){
                
                // Sub-arrays for storing separate components of larger array
                var sorted_array = []; 
                var intermediates = []; 
                
                for (var i in array){
                                    
                    if (array[i].step == "target"){
                    
                        console.log("inside target loop"); 
                        sorted_array.push(array[i]);
                
                    }
                
                
                    else if (array[i].step !== "target"){
                    
                        console.log("inside intermediate loop"); 
                        intermediates.push(array[i]);  
                    
                    }                                                                 
            
                 }
                 
                 /*
                 // Now sort intermediates based on step#
                 intermediates.sort(function(obj1, obj2){

                    return obj1.step + obj2.step;                

                 }) 
                 */      
                             
                 intermediates.sort(function(a, b){return b.step - a.step});          
                                     
             
                 // Now join arrays
                 for (var i in intermediates){
             
                
                    sorted_array.push(intermediates[i]); 
             
             
                 }   
                 
                 for (var i in sorted_array){
                 
                 
                    //alert(sorted_array[i].step); 
                    console.log(sorted_array[i].step); 
                 
                 
                 }
                 
                 
                
                 return sorted_array; 
            
            
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
                <!--<li class="active"><a href="#">Home</a></li>-->
                <li id = "rplan"><a href="#">RPlan</a></li>
                <li><a href="#">RScheme</a></li> 
                <li><a href="#">Team Profile</a></li> 
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li id = "register"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li id = "login"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container-fluid spacer"></div>
        <div class="container-fluid spacer">
           <div class="row"> <!--id = "row1">-->
           
                  <div class="col-xs-12 col-md-3 col-md-offset-3">                 
                     <div id="jsme_container" style = "margin-bottom: 2.5%;"></div>
                     
                     <button class="btn btn-primary" type="submit" id="submit_target" style = "margin-bottom:2.5%;"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Submit</button>
                  </div>           
              
              
                  <div class="col-xs-8 col-md-3" id = "row1" >
                    <div class = "row">
                         <div class="form-group col-md-8 col-xs-10">
                           <input type="text" class="form-control" autocomplete="off" autofocus="" name="smiles" id="smiles_target" placeholder="Input smiles for target">
                         </div> 
                         <div class="col-md-3 col-xs-2 text-left" style="padding:0;">
                            <button class="btn btn-default" type="submit" id="smiles_transfer_target"><span aria-hidden="true" class="glyphicon glyphicon-log-in"></span> Transfer</button>
                         </div>                 
                    </div>           
        	      </div>
        	    
            </div>
           
        </div>

        <footer class="container-fluid footer flex">
          <p>Company Name <a href="#">Company Website</a></p> 
        </footer>
           
    </body>
</html>
        
        
        