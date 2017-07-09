/* 

This version of Rplanner implements most of required features ie embedded drawing objects, ability to drag structures from object to object, smiles calculation and molecular weight retrieval via AJAX. Understanding of AJAX callbacks improved and thus refined here. Contains Bootsrap html

*/

// http://peter-ertl.com/jsme/JSME_2016-05-21/index.html (Link for JSME molecular editor)

// Globals for start and end molecular weights 
var weights = {};              

// Array for holding JME drawing objects
var drawing_objects = []; 

// Number of reaction steps
var steps;

// Quantity of final target required
var quantity; 

// Smiles array for constucting reaction scheme... 
var smiles = []; 

var reaction = 1;


// Technically should use function jsme OnLoad() here in place of jQuery's $(function(){}). This allows one to put everything from script tag in Rplan6.html into this file
function jsmeOnLoad(){
 
    
    document.JME = new JSApplet.JSME("jsme_container", "300px", "250px");
                
    // Add identifier to JME object
    document.JME["step"] = 0; 

    // Store in global object array
    drawing_objects.push(document.JME); 
    
    // How to modify pseudo elements ie bg-1:after. https://pankajparashar.com/posts/modify-pseudo-elements-css/ 
    // Use this to set background size
    
    // Get height of window
    var x = screen.height;
    console.log(x);
    
    //JQuery string
    var string = "<style>.bg-1:after{height:"+ x + "px}</style>";
    console.log(string);
        
    //$(string).appendTo('head');
    
    
    document.getElementById("generate").addEventListener("click", function(event){        
        
        // Get number of steps user has typed in
        steps = document.getElementById("steps").value;         
        
        if (steps == ""){
            
            alert("Please provide number of synthetic steps");
        }        
        
        // Once click generate button, delete it and steps field to prevent being clicked again.         
        if (steps != ""){            
            
            // Array of elements wish to remove
            var removal = ["#steps", "#generate", "#field-wrap"]; 

            for (var i in removal){            

                $(removal[i]).remove();

            }    
            
            var page = new pages(steps);
            
            // Obtain html to show in first wrapper 
            var initial_html = page.initial(); 
             
            
            // Put initial html after first box id
            $('#wrapper').append(initial_html);            
            
            
            // Obtain html for calculate button           
            var button = page.button();
            
          
            // Insert calculate button
            $(button).insertAfter('.insert');            
            
        }   
        
        
        
        var reaction = steps; 
        
        
        // Then add html for other intermediates, SM and yield arrows. Note that when creating variable to store object information, name of variable cannot be the same as the constructor 
        for (var i = 0; i < steps; i++){            
                        
            // JQuery to insert html after a certain tag... http://www.mkyong.com/jquery/jquery-after-and-insertafter-example/        
            var page = new pages(reaction);
                        
            var html = page.html();            
           
            $(html).insertAfter('.insert');
             
            var arrow = page.arrow();
            $(arrow).insertAfter('.insert');            
            page.draw();  
            reaction--;        
        }
        
        // Add dropdown options
        drop_down();        
 
        
        // Sorts JME object array so in correct order based on steps. From https://davidwalsh.name/array-sort
        drawing_objects.sort(function(obj1, obj2){

            return obj1.step - obj2.step;                

        })
        
         // Listen for smiles load button...    

         document.getElementById("smiles_transfer").addEventListener("click", function(event){

            event.preventDefault(); 

            // Get current value of smiles field 
            var  x = $('#smiles').get(0); 
            console.log(x.value);

            var str = x.value;

            // http://www.webdeveloper.com/forum/showthread.php?264705-Best-way-to-check-for-multiple-characters-in-a-string
            // gi refers to case-insensitive search 

            var smiles_chars = /[cno=-sp]/gi;

            var result = str.match(smiles_chars);
            console.log(result);

            if (result == null){
                
              
                alert("please enter a valid smiles string"); 
                //event.preventDefault();

            }        


            else if (str == ""){
                
                
                alert("Please enter smiles");
                //event.preventDefault();

            }           


            else {

              var smiles = str;               

              // First clear first jsme_container 
              $("#jsme_container").html("");

              // and replace with new parameters..
              drawing_objects[0] = new JSApplet.JSME("jsme_container", "300px", "250px", {

                  "options":"edit,useopenchemlib", // depict in place of edit removes exterior editor window
                  "smiles": smiles

              }); 
                
              drawing_objects[0]["step"] = 0; 
                
            }


            //event.preventDefault();                   

        });     
        
        
        
        // Now add event listener for calculate button 
        document.getElementById("calculate").addEventListener("click", function(event){        
           
            
            // Get value that user typed in for desired target compound mass 
            quantity = document.getElementById("quantity").value;              

            if (quantity == ""){
                alert("Please provide a desired final product mass");             
            }
            
            var units = get_units();                      

            // If user has selected milligram quantities, then convert units to grams. 
            if (units == "milligrams"){
                quantity = quantity/1000; 
            }
            
            if (units == "kilograms"){
                
                quantity = quantity * 1000; 
            }
           
            
            for (var i = 0 in drawing_objects){
                
                console.log(drawing_objects[i].step);                
                
            }
            
           
            // Also get smiles for each chemical structure and use to calculate/display molecular weight (saved in global variables)  
            getSmiles(steps, function(){
                
                var count = 0; 
                
                for (var i = 0 in weights){
                    
                    count++;                     
                    console.log(count); 
                    
                    // If have retrieved both mwfinal and mwstart from AJAX call...
                    if (count == 2){
                    
                        combine(weights.mwfinal, weights.mwstart, quantity);     
                    
                    }
                    
                }         
                
                
            }); 
                
            smiles_array();
            console.log(smiles); 
            
       }); 
       
        
    });   
    
}


// Function to get smiles and molecular weight from drawing object.. combine is a callback. Note 08-06-2016 currently a bug with regard to value of i which means values being inputted into wrong fields...
function getSmiles(steps, combine) {  
    
  
   console.log ("number of steps is:" + steps); 
   // For each smiles field 
   for (var i = 0; i <= steps; i++){
       
       console.log("drawing object step is:" + drawing_objects[i].step);
       console.log("index is:" + i); 
       
       // Get all fields
       var group = document.getElementsByClassName(i);      
       
       // Get smiles for that JME
       var smiles = drawing_objects[i].smiles(); 
       
       // Still going to have to include different paradigm for first step and then all rest, as first includes one less field (yield)
       
       if (drawing_objects[i].step == 0){
           
           group[1].value = smiles;
           
           // Pass group
           molecular_weight(smiles, group[2], i, function(data){
                            
                weights["mwfinal"] = data;                 
                            
           })
           
       }  
       
       else if (drawing_objects[i].step > 0){
           
           group[2].value = smiles;
           
           // Need to save variables: group[3] and i, to return in callback. Inside the callback is another world so need to keep track of variables in outer world. 
           molecular_weight(smiles, group[3], i, function(data, index){
               
               console.log(data); 
               console.log(index); 
               
               if (drawing_objects[index].step == index){
                   
                   weights["mwstart"] = data;
                   combine();                   
               }
               
           });   
           
       }   
    
    
   }

}

        
// Note success is a callback function executed on return of molecular weight value via AJAX
function molecular_weight(smiles, group, index, success){
    
    // Calculate the molecular weight from the following URL: https://cactus.nci.nih.gov/chemical/structure/NCc1ccccc1/mw (ie pass in SMILES then retrieve mw variable via AJAX call) 
    
    console.log(smiles); 
    // See http://www.w3schools.com/jquery/jquery_ajax_get_post.asp for AJAX calls           
    var URL = "https://cactus.nci.nih.gov/chemical/structure/" + smiles +"/mw"; 
    

    // This seems to be more reliable form of AJAX call in terms of the callback working than that in Rplan4.js. See http://stackoverflow.com/questions/4988277/javascript-callback-functions-with-ajax
    $.ajax({

        type:"GET",
        url: URL,
        success: function(data){
            
            group.value = data;
            
            // Effectively a callback within a callback
            success(data, index); 
            
        },
        error: function(request, error){

            alert("An error occurred attempting to obtain the molecular weight"); 
        }
    });
    
}

function combine(mwfinal, mwstart, quantity){ 
    

    var moles = quantity / mwfinal;    

    // Now insert moles into field 
    document.getElementById("moles_start").value = moles;

    // Counter to actually determine if work has been done on orginal moles value
    var count = 0;             

    var group = document.getElementsByClassName(steps);                                 

    for (var i = 1; i <= steps; i++){            

        // Group yield and moles together by class into array. 0 => yield, 1 => moles
        var group = document.getElementsByClassName(i);         

        var reaction_yield = group[0].value;                      

        if (reaction_yield == ""){
            alert("Please provide an estimated yield for each reaction"); 
        }

        if (reaction_yield != ""){

            // Now input moles value for that intermediate
            moles = moles / (reaction_yield/100);            
            group[1].value = moles; 
            count++; 
        }      

    }         


    // If do not check work has been done on first moles value, then program just inputs this into start field regardless 
    if (count > 0){

         moles = moles * mwstart;
         moles = moles.toFixed(2);
         document.getElementById("start").value = moles; 
    } 
    
  
}

    
// Push smiles to array and join with dot. Also include in here protocol for sending smiles array to back-end 
function smiles_array(){   
    
    //console.log(steps); 
    
    // Go backwards through steps so pick smiles of SM first 
    for (var i = steps; i >= 0; i--){
        
        //console.log(i); 
        
        var group = document.getElementsByClassName(i);        
    
        for (var j = 0; j < group.length; j++){
            

            if (group[j].name == "smiles"){                
                
                var smiles_entry = group[j].value;                
                smiles.push(smiles_entry); 
            }

        }
    }
    
    // Join smiles array with arrow
    //smiles = smiles.join(">>"); 
        
    
}

// Function to change value of Bootstrap dropdown menu
function drop_down(){
    
    var button = document.getElementById("touch");
    console.log(button); 
    
    var ul = button.parentNode.children[1];
    var menu = ul.children;   
    
    for (var i = 0; i < menu.length; i++){               
        
        menu[i].firstChild.addEventListener("click", function(){
                    
            // OK! Within the event listener you have to use 'this.innerHTML' instead of 'menu[i].firstChild.innerHTML'
            // Thus the below console.log gives undefined while the line below returns the desired result.
            // Apparently 'menu[i].firstChild' goes out of scope and becomes equal to 'this' instead.

            //console.log(menu[i].firstChild.innerHTML); 
            button.childNodes[0].nodeValue = this.innerHTML;

        })
    
    }
            
       
}

// Get value of dropdown
function get_units(){
    
    var button = document.getElementById("touch");
    var units = button.childNodes[0].nodeValue;
    return units;    
    
    
}


