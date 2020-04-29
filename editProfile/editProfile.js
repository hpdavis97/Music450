let restricted = true;
let pwCheck = false;
let fNameCheck = false;
let lNameCheck = false;
let dobCheck = false;
let emailCheck = false;
let userCheck = false;
let monthCheck = false;
let dayCheck = false;
let yearCheck = false;



function passwordChecking() {
  var oldPassword = document.getElementById("passwordo").value;
  var password = document.getElementById("password1").value;
  var confirmPassword = document.getElementById("password2").value;
  passwordTrim = password.trim();
  confirmPasswordTrim = confirmPassword.trim();

  /* add if statement old password is correct

  var correctPassword = retrieve old password from database;
  if (old passwrod != correct password) {
  document.getElementById("notVerified").innerHTML = "Your old password is incorrect.";
  document.getElementById("notVerified").hidden = false;
  pwCheck = false;
  }
  */
  if (password != confirmPassword) {
    document.getElementById("notVerified").innerHTML = "Your passwords do not match.";
    document.getElementById("notVerified").hidden = false;
    pwCheck = false;
  } else if (password != passwordTrim) {
    document.getElementById("notVerified").innerHTML = "Your password cannot have spaces.";
    document.getElementById("notVerified").hidden = false;
    pwCheck = false;
  } else if (password == "") {
    document.getElementById("notVerified").innerHTML = "Your password cannot be empty.";
    document.getElementById("notVerified").hidden = false;
    pwCheck = false;
  } else if (passwordTrim != "" && password == passwordTrim && password == confirmPassword) {
    document.getElementById("notVerified").hidden = true;
    pwCheck = true;
  }
  checkForm();
}

function checkFName() {
  var fName = document.getElementById("fName").value;
  fName = fName.trim();
  if (fName != "") {
    fNameCheck = true;
  } else {
    fNameCheck = false;
  }
  checkForm();
}

function checkLName() {
  var lName = document.getElementById("lName").value;
  lName = lName.trim();
  if (lName != "") {
    lNameCheck = true;
  } else {
    lNameCheck = false;
  }
  checkForm();
}


function noSpace(elementid) {
  var element = document.getElementById(elementid).value;
  document.getElementById(elementid).value = element.replace(/\s/g, '');
}

function checkEmail() {
  var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  var email = document.getElementById("email").value;
  if (email.match(mailformat)) {
    emailCheck = true;
    document.getElementById("invalidEmail").hidden = true;
  } else if (email == '') {
    emailCheck = false;
    document.getElementById("invalidEmail").hidden = true;
  } else {
    emailCheck = false;
    document.getElementById("invalidEmail").hidden = false;
  }
  checkForm();
}

function checkUsername() {
  var userName = document.getElementById("userName").value;
  userName = userName.trim();
  if (userName != "") {
    userCheck = true;
  } else {
    userCheck = false;
  }
  checkForm();
}

function checkMonth() {
  var month = document.getElementById("monthDOB").value;
  month = month.trim();
  if (month.length == 1) {
    document.getElementById("monthDOB").value = `0${month}`;
  }
  if (month != "") {
    monthCheck = true;
  } else {
    monthCheck = false;
  }
  checkDOB();
  checkForm();
}

function checkDay() {
  var day = document.getElementById("dayDOB").value;
  day = day.trim();
  if (day.length == 1) {
    document.getElementById("dayDOB").value = `0${day}`;
  }
  if (day != "") {
    dayCheck = true;
  } else {
    dayCheck = false;
  }
  checkDOB();
  checkForm();
}

function checkYear() {
  var year = document.getElementById("yearDOB").value;
  year = year.trim();
  if (year != "") {
    yearCheck = true;
  } else {
    yearCheck = false;
  }
  checkDOB();
  checkForm();
}

// make sure date is not moe than current date
function checkDOB() {
  var d =  new Date();
  if (yearCheck == true && dayCheck == true && monthCheck == true) {
    dobCheck = true;
    document.getElementById("invalidDOB").hidden = true;
    var year = document.getElementById("yearDOB").value;
    var day = document.getElementById("dayDOB").value;
    var month = document.getElementById("monthDOB").value;
  //  var d = new Date();
    var ListofDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    if (month == 1 || month > 2) {
      // if month is 1 or greater than 2 and the ListofDays[month-1] is less than day
      if (day > ListofDays[month - 1]) {
        dobCheck = false;
        document.getElementById("invalidDOB").hidden = false;
      }
    }
    if (month == 2) {
      var lyear = false;

      // setting leap year
      if (year % 4 == 0 && year % 100 != 0 || year % 400 == 0) {
        lyear = true;
      }
      // if not leap year and day is greater or equal to 29
      if ((lyear == false) && (day >= 29)) {
        dobCheck = false;
        document.getElementById("invalidDOB").hidden = false;
      }
      // if leap year and day is greater than 29
      if ((lyear == true) && (day > 29)) {
        dobCheck = false;
        document.getElementById("invalidDOB").hidden = false;
      }
    }
    // if month is not a real month
    if (month > 12 || month < 1) {
      dobCheck = false;
      document.getElementById("invalidDOB").hidden = false;
    }
    // if year is later than current date
    if (d.getFullYear() < year) {
      dobCheck = false;
      document.getElementById("invalidDOB").hidden = false;
    }
    // if month is later than current date
    if (d.getFullYear() <= year && (1 + d.getMonth()) < month) {
      dobCheck = false;
      document.getElementById("invalidDOB").hidden = false;
    }
    // if day is later than current date
    if (d.getFullYear() <= year && (1 + d.getMonth()) <= month && d.getDate() < day) {
      dobCheck = false;
      document.getElementById("invalidDOB").hidden = false;
    }
    // if year is 125 years ago
    if ((d.getFullYear() - 125) > year) {
      dobCheck = false;
      document.getElementById("invalidDOB").hidden = false;
    }
    // if the checks are not true then dobCheck is false
  } else {
    dobCheck = false;
    document.getElementById("invalidDOB").hidden = false;
  }
}

function checkForm() {
  if (pwCheck == true && fNameCheck == true && lNameCheck == true && dobCheck == true && emailCheck == true && userCheck == true) {
    document.getElementById("createButton").style["boxShadow"] = "5px 5px 10px #333333";
    document.getElementById("createButton").disabled = false;
  }
}
