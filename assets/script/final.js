// Current image
var slideIndex;
// Show current image

slideIndex = 1;

// Shows the current image based on n parameter
function currentSlide(n) {
  showSlides((slideIndex = n));
}

function fadeIn(slide) {
  slide.style.opacity = parseFloat(slide.style.opacity) + 0.1;

  if (slide.style.opacity < 1) {
    timer = window.setTimeout(function () {
      fadeIn(slide);
    }, 50);
  }
}

// Function to show Slides based on whether the certain dot button is clicked
function showSlides(n) {
  var i; // Used to index through array
  var slides = document.getElementsByClassName("mySlides"); // Gets pictures of slides into an array

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  var presentSlide = slides[n - 1];
  presentSlide.style.display = "block";
  presentSlide.style.opacity = 0;
  fadeIn(presentSlide);
}

let map;

function makeInfoWindow(position, msg) {
  // Make a new InfoWindow
  infowindow = new google.maps.InfoWindow({
    map: map,
    position: position,
    content: "<b>" + msg + "</b>"
  });
}

function addMarker(latitude, longitude, title) {
  var position = { lat: latitude, lng: longitude };
  var marker = new google.maps.Marker({ position: position, map: map });
  marker.setTitle(title);
  google.maps.event.addListener(marker, "click", function (e) {
    makeInfoWindow(this.position, this.title);
  });
}

function initMap() {
  var mapLat = parseFloat(document.getElementById('gMap').getAttribute('maplat'));
  var mapLng = parseFloat(document.getElementById('gMap').getAttribute("maplng"));
  var zoomLevel = parseInt(document.getElementById('gMap').getAttribute("zoom"));
  var marker1Lat = parseFloat(document.getElementById('gMap').getAttribute("mk1lat"));
  var marker1Lng = parseFloat(document.getElementById('gMap').getAttribute("mk1lng"));
  var marker1Title = document.getElementById('gMap').getAttribute("mk1title");
  var marker2Lat = parseFloat(document.getElementById('gMap').getAttribute("mk2lat"));
  var marker2Lng = parseFloat(document.getElementById('gMap').getAttribute("mk2lng"));
  var marker2Title = document.getElementById('gMap').getAttribute("mk2title");

  map = new google.maps.Map(document.getElementById("gMap"), {
    center: { lat: mapLat, lng: mapLng },
    zoom: zoomLevel
  });

  var marker1 = addMarker(marker1Lat, marker1Lng, marker1Title);
  var marker2 = addMarker(marker2Lat, marker2Lng, marker2Title);
  window.initMap = initMap;
}

function validateForm() {
  var firstName = document.forms["TravelForm"]["fName"].value;
  var lastName = document.forms["TravelForm"]["lName"].value;

  if (firstName == null || firstName == "") {
    document.forms["TravelForm"]["fName"].style.backgroundColor = "pink";
    return false;
  } else {
    document.forms["TravelForm"]["fName"].style.backgroundColor = "white";
  }

  if (lastName == null || lastName == "") {
    document.forms["TravelForm"]["lName"].style.backgroundColor = "pink";
    return false;
  } else {
    document.forms["TravelForm"]["lName"].style.backgroundColor = "white";
  }
}