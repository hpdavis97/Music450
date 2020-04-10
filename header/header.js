
function navMenuDrop() {
  var x = document.getElementById("myLinks");
  var y = document.getElementById("topnav");
  if (x.style.display === "block") {
    x.style.display = "none";
    y.style.top = "0%";
  } else {
    x.style.display = "block";
    y.style.top = "58%";
  }
}

function logOut() {

}

function removeTopNav() {
}

document.write('\
\
  <link rel="stylesheet" type="text/css" href="../header/header.css">\
  <div class="flex-container" id="header">\
    <div id="searchWrapper">\
      <input id="search" type="text" placeholder="Search...">\
    </div>\
    <div id="logoWrapper">\
      <a id="logoLink" href="https://www.w3schools.com">\
        <img id="logo" border="0" alt="W3Schools" src="../header/logo.png" width="100" height="100">\
      </a>\
    </div>\
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">\
    <div id="topnav" class="topnav">\
      <a id="headerDropDown" href="javascript:void(0);" class="icon" onclick="navMenuDrop()">\
        <text id="headerUsername">Username</text>\
        <i class="fa fa-bars"></i>\
      </a>\
      <div id="myLinks">\
        <a href="../index.html">Profile</a>\
        <a onclick="logOut()">Log Out</a>\
      </div>\
      <div id="loginLinkWrapper">\
        <a id="loginLink" href="../login/login.html">LogIn/SignUp</a>\
      </div>\
    </div>\
</div>\
\
');
