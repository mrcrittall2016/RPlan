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
        <link href="/css/styles_login.1.css" rel="stylesheet"/> 
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
                <li class="active"><a href="index.php">Home</a></li>
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
        
        <div class = "container-fluid" style = "margin-top: 15%;">
          <form action = "login.php" method ="post">
            <div class = "row">
              <div class = "col-md-offset-5 col-md-2">
                <div class="form-group">
                  <label for="email">Username:</label>
                  <input type="text" class="form-control" id="username" name = "username">
                </div>
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" id="password" name = "password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </div>
          </form>
        </div>
       
        <!--</div>-->
        <footer class="container-fluid footer flex">
          <p>Company Name <a href="#">Company Website</a></p> 
        </footer>              
    </body>
</html>
 