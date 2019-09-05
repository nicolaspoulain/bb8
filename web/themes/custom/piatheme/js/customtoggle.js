function myToggleA(id) {
  var x = document.getElementById(id);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
function myToggle(cl) {
  var x = document.getElementsByClassName(cl);
  for (i = 0; i < x.length; i++) {
  if (x[i].style.display === "none") {
    x[i].style.display = "block";
  } else {
    x[i].style.display = "none";
  }
}
}
