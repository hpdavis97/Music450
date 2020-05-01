
// Alex Bolsoy
// Music450

let restricted = true;
let pwCheck = false;

let songNameCheck = false;
let artistNameCheck = false;
let albumNameCheck = false;

// TODO FOR HUNTER: CHANGE THE URL
// This function brings the user to a different webpage.
function createAnotherReview() {
  window.location.href = "../review/createReview.html";
}

// TODO FOR HUNTER: CHANGE THE URL
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
    document.getElementById("invalidSong").hidden = false;
  }
  checkForm();
}

// This function checks the user input for artist name
function checkArtistName() {
  // alert('hey');
  var aName = document.getElementById("artistName").value;
  aName = aName.trim();
  artistNameCheck = true;
  checkForm();
}

// This function checks the user input for album name
function checkAlbumName() {
  var aName = document.getElementById("albumName").value;
  aName = aName.trim();
  albumNameCheck = true;
  checkForm();
}

function noSpace(elementid) {
  var element = document.getElementById(elementid).value;
  document.getElementById(elementid).value = element.replace(/\s/g, '');
}

// This function checks all of the user input
function checkForm() {
  if (songNameCheck == true && artistNameCheck == true && albumNameCheck == true) {
    document.getElementById("addButton").style["boxShadow"] = "5px 5px 10px #333333";
    document.getElementById("addButton").disabled = false;
  }
}
