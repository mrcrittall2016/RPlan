<!-- Home-page for ChemMaster -->

<!DOCTYPE html>
<html lang = "en">
    <head>     
        
        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title)?></title>
        <?php else: ?>
            <title>ChemMaster</title>
        <?php endif ?>
        
        <meta charset = "utf-8">  
        
        <!-- This tag ensures porper rendering and touch zooming of a page when on any device (ie mobile or tablet). The width=device-width part sets the width of the page to follow the screen-width of the device and the initial-scale sets the zoom when the page is first loaded by the browser -->
        
        <meta name="viewport" content = "width=device-width, initial-scale = 1">
        
        <!--
        <!-- Javascript for drawing tool 
        <script type="text/javascript" language="javascript" src="http://peter-ertl.com/jsme/JSME_2016-05-21/jsme/jsme.nocache.js"></script>
        
        <!--<script type="text/javascript" language="javascript" src="/js/jsme.nocache.js"></script>-->
        
        
         <!-- Javascript object for generating required html 
        <script src="/js/Rplan_object.js"></script>
        
        <!-- Javascript for page 
        <script src="/js/Rplan_Bootstrap2.js"></script>
        
        <!-- Latest compiled and minified CSS for Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
        <!-- jquery -->
        <script src="/js/jquery-1.11.3.min.js"></script>
        
        <!-- Latest compiled JavaScript for Bootstrap -->
        <script src="/js/bootstrap.min.js"></script>
        
        <!--own style sheet. Note in order to see CSS changes need to change number. Seems to cache on client side for some reason-->
        <link href="/css/index.1.css?parameter=3" rel="stylesheet"/>  
        
        <script>
          
          $(function(){
            
                console.log("DOM ready!"); 
                
                // Get PHP variables ie username if signed in 
                var name = "<?php echo $name ?>"
                
                //var name = "Rodger"; 
                
                console.log(name); 
                
                // If $name is not empty or undefined... ie if someone is logged in. 
                if (name !== "undefined"){
                    
                    // Need to create dropdown in nav bar in place of login
                    var login = document.getElementById("login");  
                    
                    //var login = document.getElementsByClassName("navbar-right")[0].children[1].innerHTML; 
                    console.log(login);
                    
                    console.log(name);
                    
                    // Change attribute of login id to dropdown menu
                    login.setAttribute("class", "dropdown");  
                   
                    // Now change innerHTML to be dropdown menu. See http://www.tutorialrepublic.com/twitter-bootstrap-tutorial/bootstrap-dropdowns.php
                    //login.innerHTML = '<a href="#" data-toggle="dropdown" class="dropdown-toggle">' + name + '<b class="caret"></b></a> <ul class="dropdown-menu"> <li><a href="#">Inbox</a></li> <li><a href="#">Drafts</a></li> <li><a href="#">Sent Items</a></li> <li class="divider"></li> <li><a href="logout.php"> Logout</a></li></ul>'
                    login.innerHTML = '<a href="#" data-toggle="dropdown" class="dropdown-toggle">' + name + '<b class="caret"></b></a> <ul class="dropdown-menu"><li><a href="#">Messages</a></li> <li class="divider"></li> <li><a href="logout.php"> Logout</a></li></ul>'
                    
                    // Remove sign up button on nav bar if are logged in
                    var register = document.getElementById("register");
                    console.log(register); 
                    register.innerHTML = ""; 
                    
                }
                
                
                
                retrieve(name); 
                
              
                
                
            
          });
          
          function retrieve(name){               
				
		
				var username = {user:name}
		
				// What does user already have
				$.getJSON("get_schemes.php", username).done(function(data, textStatus, jqXHR) {
					
					//console.log(data); 		
					
					// Go through Schemes array and append to table html
					
					var row_number = 1;  
					
					for (var i in data){
					
					
						console.log(data[i]);
						
						var entry = "<tr class = '" + row_number + "'><th scope='row'>" + row_number + "</th><td id = '" + row_number + "'>" + data[i] + "</td><td>Short description</td><td><button type='button' id = '" + row_number + "' class='btn btn-primary' aria-label='Left Align' data-toggle='modal' data-target='#myModal'><span class='glyphicon glyphicon-remove-circle glyphicon-align-left' aria-hidden='true'></span></button></td></tr>"; 
						
						$('#table_body').append(entry);  
					
						row_number++; 
					
					}
					
					  // If click on delete button get row and scheme_number that this corresponds to 
					  $('.btn').click(function(){
							
						  
						  //alert("button clicked"); 				
						  
						  var number = $(this).closest('button').attr('id'); 
						  
						  // http://stackoverflow.com/questions/10260667/jquery-get-parent-parent-id    
						  var id_number = "#" + $(this).closest('button').attr('id');   						  
						  
						  console.log("something clicked"); 
						  
						  console.log(id_number); 
						  
						  // Now have the id, need to get scheme to delete			  
						  var delete_id = {id: $(id_number).html()}; 
						  console.log(delete_id);						  
						  
						  // If click "yes" button in modal, delete scheme
							
						  $('#delete').click(function(){
						  
							  // Send to back-end to remove. If return from getJSON as successfully removed, then remove html from page
							  remove(delete_id, number); 
							  
						  }); 
						   
			
					  });
			
				  
				})
			
				.fail(function(jqXHR, textStatus, errorThrown) {
					// log error to browser's console
					console.log(errorThrown.toString());
				});
				
			
		 }
		 
		 // function to remove scheme from database and history 
         function remove(id, identifier){
         
         	$.getJSON("delete_schemes.php", id).done(function(data, textStatus, jqXHR) {
					
				console.log(data);
				console.log(identifier);  
				
				var row_remove = "." + identifier; 
				
				// if scheme successfully deleted.. remove html 
				if (data.result == true){
				
					 // Delete relevant row from table 
					 $(row_remove).remove(); 
					
					 // Provide message in modal to say scheme deleted... then ideally close modal 
					 var message = '<h5 id = "success" style = "text-align:center;">Congratulations, reaction scheme successfully deleted! </h5>';
                                          
					 // Clear all previous messages
					 $('#fail').remove();
					 $('#success').remove();
				  
					 $('.modal-footer').append(message);
					 
					 // Close modal after timeout
					 setTimeout(function(){$('#myModal').modal('hide');}, 1500);
					
								
				
				}	
				
				else if (data.result == false){
				
					
					 // Provide message in modal to say scheme deleted... then ideally close modal 
					 var message = '<h5 id = "fail" style = "text-align:center;">Apologies, reaction scheme could not be saved. Please try again later! </h5>';
                                          
					 // Clear all previous messages
					 $('#fail').remove();
					 $('#success').remove();
				  
					 $('.modal-footer').append(message);
					 
					 // Close modal after timeout
					 setTimeout(function(){$('#myModal').modal('hide');}, 1000);
					
					
				
				}
			
				
				  
			})
		
			.fail(function(jqXHR, textStatus, errorThrown) {
				// log error to browser's console
				console.log(errorThrown.toString());
			});
         
         
         
         
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
              <!--<li class="active"><a href="index.php">Home</a></li>-->
              <li><a href="rplan.php">RPlan</a></li>
              <li><a href="#">RScheme</a></li> 
              <li><a href="#">Team Profile</a></li> 
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li id = "register"><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
              <li id = "login"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <!--<div class = "container-fluid">-->
      <div class = "container-fluid" style = "margin-top: 5%">
      	<div class = "row">
      		<div class = "col-md-offset-1 col-md-10">
			  <table class="table table-hover">
				  <thead>
					<tr>
					  <th class = "col-md-1"></th>
					  <th class = "col-md-4">Scheme</th>
					  <th class = "col-md-4">Description</th>
					  <th class = "col-md-3">Delete Scheme</th>
					</tr>
				  </thead>
				  <tbody id = "table_body">
				  
				  </tbody>
			  </table>
			</div>
		</div>
	  </div>
	  <!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">x</button>
				<h4 class="modal-title">Delete Scheme</h4>
			  </div>
			  <div class="modal-body">
					
					<div class = "row">
						<h5 class = "col-md-offset-2 col-md-8" style = "text-align:center;">Are you sure you wish to delete this scheme?</h5>
					</div>
					
					<div class = "row">					
						<!--<div class="col-md-offset-3 col-md-3">-->
							<button type="button" class="btn btn-primary col-md-offset-3 col-md-3" id = "delete" style = "margin-right:2%;">Yes</button>							
							<button type="button" class="btn btn-primary col-md-3" id = "no_delete" data-dismiss="modal" style = "margin-right:5%;">No</button>
						<!--</div>-->
					</div>
			  
			  </div>
			  <div class="modal-footer">
				<!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
			  </div>
			</div>

		  </div>
		</div>
	  
	    <!--<input type="text" class="form-control" id="scheme_id" placeholder="Scheme ID"> </div> <button type="submit" class="btn btn-primary btn-block" id="submit_scheme"><span class="glyphicon glyphicon-off"></span> Submit</button> </div> <div class="modal-footer" style = "text-align:center"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
	  
	  
	  
      <!--</div>-->
      <footer class="container-fluid footer flex">
        <p>Company Name <a href="#"> Company Website</a></p> 
      </footer>              
    </body>
</html>
        
        
        