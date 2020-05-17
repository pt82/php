<?php
error_reporting(E_ALL);
include_once("pages/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tours site(site2)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/style.css">
  
 <style>

 </style>
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script type="text/javascript">
window.onload = function () {
        var scr = $(".scroll");
        scr.mousedown(function () {
            var startX = this.scrollLeft + event.pageX;
            var startY = this.scrollTop + event.pageY;
            scr.mousemove(function () {
                this.scrollLeft = startX - event.pageX;
                this.scrollTop = startY - event.pageY;
                return false;
            });
        });
        $(window).mouseup(function () {
            scr.off("mousemove");
        });

    }



</script>

</head>
<body>
   <div class="container">
       <div class="row">
           <header class="col-12">
               
           </header>
       </div>
       <div class="row">
           <nav class="col-12 mb-5">
              <?php include_once("pages/menu.php"); ?>               
           </nav>
       </div>
       <div class="row">
           <section class="col-12">
              <?php 
               if(isset($_GET['page'])) {
                   $page = $_GET['page'];
                   if($page == 1) {include_once('pages/tours.php');}
                   if($page == 2) {include_once('pages/comments.php');}
                   if($page == 3) {include_once('pages/registration.php');}
                   if($page == 4) {include_once('pages/admin.php');}
               }
               ?>               
           </section>
       </div>
       <footer class="row center">Step academy &copy; 2020</footer>
   </div>
    <script>

        
    (function() {
var inpElem = document.getElementById('upload'),
    divElem = document.getElementById('preview');
    inpElem.addEventListener("change", function(e) {
    for(i=0;i<this.files.length;i++){
    preview(this.files[i]);
}
divElem.inner.HTML="";
});
function preview(file) {
      var reader = new FileReader(), img;
      reader.addEventListener("load", function(event) {
      img = document.createElement('img');
      img.src = event.target.result;
      divElem.appendChild(img);
    });
    reader.readAsDataURL(file);
  
}
})();
    </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>