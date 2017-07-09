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
        <link href="/css/home.css" rel="stylesheet"/>  
      
    
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
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span>Login</a></li>
          </ul>
        </div>
      </div>
    </nav>       
    <div class = "container-fuid centre_height flex_display">   
        <!--<div class="container-fluid">-->
        <div class = "row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
            </ol>
            
            <!-- Wrapper for slides -->
            <div class="carousel-inner adjust" role="listbox">
              <div class="item active">
                <img class = "adjust" src="img/molecules.jpg" width="460" height="345">
                <div class="carousel-caption">
                    <h2>RPlan</h2>
                    <h3>Accurately plan your synthetic route to meet client demands<h3>
                </div> 
              </div>
              <div class="item">
                <img class = "adjust" src="img/reaction_scheme.jpg" alt="Chania" width="460" height="345">
                <div class="carousel-caption">
                    <h2>RScheme</h2>
                    <h3>Demonstrate synthetic progress to client and project managers<h3>
                </div> 
              </div>
              <br>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
            </div>
            </div>
        </div>
        <div class = "row">
              <h3 class="text-center">Contact</h3>
              <div class="row" style = "border:solid;">
                <div class="col-lg-4" style = "border:solid;">
                  <p>Fan? Drop a note.</p>
                  <p><span class="glyphicon glyphicon-map-marker"></span>Chicago, US</p>
                  <p><span class="glyphicon glyphicon-phone"></span>Phone: +00 1515151515</p>
                  <p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p> 
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-sm-6 form-group">
                      <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                    </div>
                    <div class="col-sm-6 form-group">
                      <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                    </div>
                  </div>
                  <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
                  <div class="row">
                    <div class="col-md-12 form-group">
                      <button class="btn pull-right" type="submit">Send</button>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
        </div>
    </div>
    <footer class="container-fluid bg-4 text-center">
        <div id = "text"><p>Company Name<a href="#"> Company Website</a></p>
    </div> 
    </footer>        
    </body>
</html>
        
        
        