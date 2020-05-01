
function navMenuDrop() {
  var x = document.getElementById("myLinks");
  var y = document.getElementById("topnav");
  if (x.style.display === "flex") {
    x.style.flexDirection = null;
    x.style.display = "none";
    y.style.top = "0%";
  } else {
    x.style.display = "flex";
    x.style.flexDirection = "column";
    y.style.top = "150%";
  }
}


function logIn() {
  document.getElementById('headerUsername').innerHTML = sessionStorage.getItem('username');
  document.getElementById('loginLinkWrapper').style.visibility ="hidden";
  document.getElementById('loginLink').style.visibility = "hidden";
  document.getElementById('headerDropDown').style.visibility = "visible";
  document.getElementById('headerUsername').style.visibility = "visible";
}

function removeTopNav() {
  document.getElementById('headerUsername').style.visibility="hidden";
  document.getElementById('headerDropDown').style.visibility = "hidden";
  document.getElementById('loginLinkWrapper').style.visibility = "visible";
  document.getElementById('loginLink').style.visibility = "visible";
}

document.write('\
  <link id="headerCSS" rel="stylesheet" type="text/css" href="../header/header.css">\
  <div class="flex-container" id="header">\
    <div id="searchWrapper">\
      <form action="../home/home.php" method="post">\
        <input id="search" type="text" name="headerSearch" placeholder="Search...">\
        <div class="hidden-submit"><input type="submit" id="searchSubmit" tabindex="-1"/></div>\
      </form>\
    </div>\
    <div id="logoWrapper">\
      <a id="logoLink" href="../home/home.php">\
        <img id="logo" border="0" alt="W3Schools" src="../header/logo.png" width="100" height="100">\
      </a>\
    </div>\
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">\
    <div id="topnav" class="topnav">\
      <a id="headerDropDown" href="javascript:void(0);" class="icon" onclick="navMenuDrop()">\
        <text id="headerUsername"></text>\
        <i class="fa fa-bars"></i>\
      </a>\
      <div id="myLinks">\
        <a href="../profilePage/profilePage.php">Profile</a>\
        <a id="logout" href="../header/logOut.php">Log Out</a>\
      </div>\
      <div id="loginLinkWrapper">\
        <a id="loginLink" href="../login/login.html">LogIn/SignUp</a>\
      </div>\
    </div>\
</div>\
');

if(sessionStorage.getItem('username')){
  window.addEventListener('load', (event) => {
  logIn();
  });
} else {
  window.addEventListener('load', (event) => {
  removeTopNav();
  });
}
