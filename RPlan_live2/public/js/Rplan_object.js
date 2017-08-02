// Object for repeated building of structure and yield segments of page depending on how many steps the user inputs. Need to use OOP here as required to repeatedly reuse code to build html string within for loop below (ie proportionally to number of reaction steps)


// Note that in Bootstrap version, had to modify html for this.initial and this.html as class = ' + this.step + ' was not being transposed to actual html on page. Bootstrap seems to automatically group classes together and ditch ones that it sees as unnecessary. Thus grouped custom class with others below to preserve it ie class = 'form-control input-sm " + this.step + "'...

function pages(step){            

    this.step = step; 

    // Function to insert in JME window. Note, had to change id to jsme_container1 in html and script to enable function to place canvas in correct position.            

    this.draw = function jsmeOnLoad () {                

        document.JME2 = new JSApplet.JSME("jsme_container1", "300px", "250px");            


        // Add identifier to JME object 
        document.JME2["step"] = this.step; 

        // Push on to global array
        drawing_objects.push(document.JME2);                 

    }

    // html to display in place of generate button for first JME object 
    this.initial = function(){

        return "<div id='field-wrap'><div id='button'><div class='form-groups' style='padding-bottom:5px;'><input autocomplete='off' autofocus class='form-control' name='Quantity'placeholder='Quantity required' type='text' id='quantity' style='width:150px;'/></div><div class='dropdown' style='position:absolute; top:0px; right:0px;'><button class='btn btn-primary dropdown-toggle' id='touch' type='button' data-toggle='dropdown'>grams <span class='caret'></span></button><ul class='dropdown-menu' id='menu'><li><a href='#'>milligrams</a></li> <li><a href='#'>grams</a></li><li><a href='#'>kilograms</a></li></ul></div></div><form role='form'><div class='form-group'><input type='text' class='form-control input-sm 0' id='moles_start' autocomplete='off' autofocus class='form-control' name='moles' placeholder='Moles' readonly/></div><div id = 'button' style = 'width:320px;'><div class='form-group'><input type='text' class='form-control input-sm 0' autocomplete = 'off' autofocus class = 'form-control' name = 'smiles' id = 'smiles' placeholder = 'Input smiles for target' style = 'width: 200px;'/></div><button class='btn btn-default' style = 'position: absolute; width:100px; top:0px; right: 0px; padding:5px;' type='submit' id = 'smiles_transfer' style = 'margin-left:50px;'><span aria-hidden='true' class='glyphicon glyphicon-log-in' style = 'padding-right:5px;'></span>Transfer</button></div><div class='form-group'><input type='text' class='form-control input-sm 0' autocomplete='off' autofocus class='form-control' name='MW' placeholder='Molecular Weight' readonly/></div></form></div>";     
    }; 

    // html to be generated on the fly when user clicks generate button
    this.html = function(){
        
        return "<div class='container-fluid bg-1'><div id='wrapper'><div id='box'><div id='jsme_container1'></div></div><div id='field-wrap' style='height:130px;'><form role='form'><div class='form-group'><input type='text' class='form-control input-sm " + this.step + "' autocomplete='off' autofocus class='form-control' name='moles' placeholder='Moles' readonly/></div> <div class='form-group'><input type='text' class='form-control input-sm " + this.step + "' autocomplete='off' autofocus class='form-control' name='smiles' placeholder='Smiles' readonly/></div><div class='form-group'><input type='text' class='form-control input-sm " + this.step + "' autocomplete='off' autofocus class='form-control' name='MW' placeholder='Molecular Weight' readonly/></div></form></div></div></div>"; 

    };        

    this.arrow = function(){

        return "<div class='container-fluid bg-1'><div id='yield_wrap'><div id='field-wrap' style='height:40px;'><div class='form-groups'><input autocomplete='off' class =" + "'" + this.step + "'"  + "autofocus class='form-control' name='yield' placeholder='yield' type='text'/></div> </div></div></div>"; 
    };


    this.button = function(){

        return "<div class='container-fluid bg-1'> <div id='wrapper2'> <div class='form-inline' role='form'> <div class='form-group'><input autocomplete='off' autofocus class='form-control' id='start' name='Starting material' placeholder='Please start with' type='text' readonly/> grams </div></div><button class='btn btn-default' style='width:100px; margin-top:5px; margin-left:40px;' type='submit' id='calculate' style='margin-left:50px;'><span aria-hidden='true' class='glyphicon glyphicon-log-in' style='padding-right:5px;'></span>Calculate</button></div></div>"; 
    };

};         