<style type="text/css"> 

body {
  background-image: url('<?php echo $background_image; ?>'); 
  background-repeat: repeat-y;
  font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
  margin:0;
  padding:0;
  padding-left: 0px; 
}

#header {
  position: absolute;
  top: 0px;
  margin: 0px;
  height: 80px;
  text-align: left;
  font-size: 10pt; 
  font-family: "Trebuchet MS", Trebuchet, tahoma, verdana, arial, helvetica, sans-serif;
}

#main_container {
  position: absolute;
  top: 110px;
  left: 170px;
  margin: 10px;
  width: 75%;
}

.main_each {
  position: relative;
  top: 110px;
  left: 160px;
  margin: 5px 5px 10px 5px;
  background-color: white;
  border: solid #cccccc 1px;
  width: 75%;
  padding: 5px 10px 5px 10px;
}

#menu_container {
  position: absolute;
  width: 160px;
  top: 100px;
  left: 0px;
  margin: 10px 10px 10px 5px;
}

.menu_each {
  margin: 5px 5px 0px 0px;
  width: 150px;
  background-color: white;
  border: solid #cccccc 1px;
}

h1 {
  font-family: "Trebuchet MS", Trebuchet, tahoma, verdana, arial, helvetica, sans-serif;
  margin: 0 0 15px 0;
  padding: 0;
  color: <?php echo $h1; ?>;
  font-size: 1.4em; 
}

h2 {
  font-family: "Trebuchet MS", Trebuchet, tahoma, verdana, arial, helvetica, sans-serif;
  margin: 0 0 5px 0;
  padding: 0;
  font-size: 1.0em;
}


p {
  font-family: tahoma, verdana, arial, helvetica, sans-serif; 
  line-height: 16pt;
  margin: 0 0 16px 0;
  padding: 0;
}

a {
  COLOR: <?php echo $link_col; ?>;
  TEXT-DECORATION: none;
}

a:hover {
  color: red;
  text-decoration: none;
}

.header {
  FONT-SIZE: 7pt; 
  COLOR: black;
  FONT-FAMILY: "Trebuchet MS", Trebuchet, Verdana, Geneva, Arial, Helvetica, sans-serif; 
  TEXT-DECORATION: none;
}

a.header {
  COLOR: black;
  FONT-FAMILY: "Trebuchet MS", Trebuchet, Verdana, Geneva, Arial, Helvetica, sans-serif; 
  TEXT-DECORATION: none;
}

a.header:hover {
  color: red;
  FONT-FAMILY: "Trebuchet MS", Trebuchet, Verdana, Geneva, Arial, Helvetica, sans-serif;
  text-decoration: none;
}

.contenthead {
  FONT-SIZE: 12pt; 
  COLOR: #606060;
  LINE-HEIGHT: 16pt; 
  FONT-FAMILY: "Trebuchet MS", Trebuchet, Arial, Helvetica, sans-serif
}

.content {
  FONT-SIZE: 9pt; 
  COLOR: #606060; 
  LINE-HEIGHT: 12pt; 
  FONT-FAMILY: Verdana, Geneva, Arial, Helvetica, sans-serif; 
  TEXT-ALIGN: left; 
  TEXT-DECORATION: none;
}

a.content {
  COLOR: green;
  FONT-FAMILY: Verdana, Geneva, Arial, Helvetica, sans-serif; 
  TEXT-DECORATION: none;
}

a.content:hover {
  color: red;
  FONT-FAMILY: Verdana, Geneva, Arial, Helvetica, sans-serif;
  text-decoration: none;
}

.menuhead {
  FONT-SIZE: 12pt; 
  COLOR: #777777; 
  LINE-HEIGHT: 14pt; 
  FONT-FAMILY: Arial, Helvetica, sans-serif
}

a.menuhead {
  FONT-SIZE: 12pt; 
  COLOR: #777777; 
  LINE-HEIGHT: 14pt; 
  FONT-FAMILY: Arial, Helvetica, sans-serif
}

a.menuhead:hover {
  FONT-SIZE: 12pt; 
  COLOR: red; 
  LINE-HEIGHT: 14pt; 
  FONT-FAMILY: Arial, Helvetica, sans-serif
}

.menu {
  DISPLAY: block; 
  WIDTH: 100%; 
  COLOR: #404040; 
  FONT-SIZE: 8pt; 
  FONT-FAMILY: Verdana, Geneva, Arial, Helvetica, sans-serif; 
  LINE-HEIGHT: 14pt; 
  TEXT-ALIGN: left; 
  TEXT-DECORATION: none;
}

.menu:hover {
  COLOR: #000000; 
  BACKGROUND-COLOR: #<?php echo $menu_background; ?>
}

.menu_2 {
  DISPLAY: block; 
  FONT-SIZE: 8pt; 
  WIDTH: 100%; 
  COLOR: #000000; 
  FONT-FAMILY: Verdana, Geneva, Arial, Helvetica, sans-serif; 
  LINE-HEIGHT: 14pt; 
  TEXT-ALIGN: left; 
  TEXT-DECORATION: none
}

.menu_2:hover {
  COLOR: #000000; 
  BACKGROUND-COLOR: #F1F1F1
}
</style> 