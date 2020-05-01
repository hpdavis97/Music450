
// Alex Bolsoy
// Music450

let restricted = true;
let pwCheck = false;

let songNameCheck = false;
let songRatingCheck = false;
let songCommentsCheck = false;

// This function brings the user to a different webpage.
function createAnotherReview() {
  window.location.href = "../review/createReview.html";
}

// This function brings the user to a different webpage.
function goHomeButton() {
  window.location.href = "../home/home.php";
}

// This function checks the user input for song name
function checkSongName() {
  var sName = document.getElementById("songName").value;
  sName = sName.trim();
  if (sName != "") {
    songNameCheck = true;
  } else {
    songNameCheck = false;
  }
  checkForm();
}

// This function checks the user input for song rating
function checkSongRating() {
  var sRating = document.getElementById("songRating").value;
  sRating = sRating.trim();
  if (sRating.length > 0 && sRating.length < 3) {
    if (sRating >= 0 && sRating <= 10) {
      songRatingCheck = true;
      document.getElementById("invalidRating").hidden = true;
    } else {
      songRatingCheck = false;
      document.getElementById("invalidRating").hidden = false;
    }
  } else {
    songRatingCheck = false;
    document.getElementById("invalidRating").hidden = false;
  }
  checkForm();
}

// This function checks the user input for song rating
function checkSongComments() {
  var sComments = document.getElementById("songComments").value;
  sComments = sComments.trim();
  if (sComments != "") {
    songCommentsCheck = true;
  } else {
    songCommentsCheck = false;
  }
  checkForm();
}

function noSpace(elementid) {
  var element = document.getElementById(elementid).value;
  document.getElementById(elementid).value = element.replace(/\s/g, '');
}

// This function checks all of the user input
function checkForm() {
  if (songNameCheck == true && songRatingCheck == true && songCommentsCheck == true) {
    document.getElementById("createButton").style["boxShadow"] = "5px 5px 10px #333333";
    document.getElementById("createButton").disabled = false;
  }
}
