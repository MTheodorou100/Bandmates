<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 16px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  -webkit-animation: fadeEffect 1s;
  animation: fadeEffect 1s;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}

@keyframes fadeEffect {
  from {opacity: 0;}
  to {opacity: 1;}
}
</style>
</head>
<body>

<h3>Search For Musician or Bands</h3>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">Looking for a Band? Click Here!</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Looking for a Musician? Click Here!</button>
</div>

<div id="London" class="tabcontent">
  <h3>Band Search</h3>
  <form action='search.php' method='GET'>
              <label class='white'>Search:</label> <input type='text' name='item' /><br />
              <input type='submit' name='submit' value='Submit' />
              </form> 
</div>

<div id="Paris" class="tabcontent">
  <h3>Musician Search</h3>
  <form action='search.php' method='GET'>
              <label class='white'>Search:</label> <input type='text' name='item' /><br />
              <input type='submit' name='submit' value='Submit' />
              </form> 
</div>

<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
   
</body>
</html> 
