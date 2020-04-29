let restricted = true;
let pwCheck = false;

let songNameCheck = false;
let songRatingCheck = false;
let songCommentsCheck = false;

// How does it know current user
// Edit reviews
// What if the song has not been added to the database yet?
// What happens if the button is clicked?

function createAnotherReview() {
  window.location.href = "http://satoshi.cis.uncw.edu/~ab2700/Proj450/createReview.html";
}

function goHomeButton() {
  window.location.href = "http://satoshi.cis.uncw.edu/~ab2700/Proj450/index.html";
}

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

function checkSongRating() {
  // alert('hey');
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

function checkForm() {
  if (songNameCheck == true && songRatingCheck == true && songCommentsCheck == true) {
    document.getElementById("createButton").style["boxShadow"] = "5px 5px 10px #333333";
    document.getElementById("createButton").disabled = false;
  }
}
