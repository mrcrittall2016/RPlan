<!-- latest RPlan html - uses RPlan_Bootstrap2.js and styles7.css and Rplan_object.js in an attempt to build dynamic Bootstrap content -->

<!DOCTYPE html>
<html lang = "en">
    <head>     
        
        <meta charset = "utf-8">  
        
        <!-- This tag ensures porper rendering and touch zooming of a page when on any device (ie mobile or tablet). The width=device-width part sets the width of the page to follow the screen-width of the device and the initial-scale sets the zoom when the page is first loaded by the browser -->
        
        <meta name="viewport" content = "width=device-width, initial-scale = 1">
        
        <!-- Javascript for drawing tool -->
        <script type="text/javascript" language="javascript" src="http://peter-ertl.com/jsme/JSME_2016-05-21/jsme/jsme.nocache.js"></script>
        
        <!--<script type="text/javascript" language="javascript" src="/js/jsme.nocache.js"></script>-->
        
        
         <!-- Javascript object for generating required html -->
        <script src="/js/Rplan_object.js"></script>
        
        <!-- Javascript for page -->
        <script src="/js/Rplan_Bootstrap2.js"></script>
        
        <!-- Latest compiled and minified CSS for Bootstrap -->
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        
        <!-- jquery -->
        <script src="/js/jquery-1.11.3.min.js"></script>
        
        <!-- Latest compiled JavaScript for Bootstrap -->
        <script src="/js/bootstrap.min.js"></script>
        
        <!--own style sheet -->
        <link href="/css/styles_rplan.css" rel="stylesheet"/>  
      
    
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
          <a class="navbar-brand" href="index.php">RPlanner</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">RPlan</a></li>
            <li><a href="#">RScheme</a></li> 
            <li><a href="#">Team Profile</a></li> 
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span><?php echo $name ?></a></li>
          </ul>
        </div>
      </div>
    </nav>       
    
    <div class = "container-fluid">
        <div class="jumbotron">
            <h1>RPlanner</h1> 
            <p><b>Welcome to RPlanner! Draw your target molecule and input the number of reaction steps. Modify the intermediates as you see fit, provide yields for each step and then let RPlanner do the hardwork and calculate the quantity of starting material you need!</b></p>        
        </div>    
    </div>
    
    <div class = "container-fluid centre_height" style ="border:solid;">   
        <!--<h2> RPlanner Demo app6</h2>-->
        <div class = "row">
            <div class = "col-lg-4"></div>
            <div class = "col-lg-4" style ="border:solid;">
                <div id = "box">
                    <div id = "jsme_container"></div>  
                </div>
                             
                <div class="form-groups">
                    <input autocomplete="off" autofocus class="form-control" name="Steps" placeholder="Number of Steps" type="text" id = "steps"/>
                </div>
                <button class="btn btn-default" type="submit" id = "generate">
                    <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                    Generate
                </button>
            </div>
        </div>
    </div>
    <footer class="container-fluid bg-4 text-center">
        <div id = "text"><p>Company Name<a href="#"> Company Website</a></p>
    </div> 
    </footer>        
    </body>
</html>
        
        
        