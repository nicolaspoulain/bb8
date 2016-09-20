var aElems = document.getElementsByClassName('delAlertJs');

for (var i = 0, len = aElems.length; i < len; i++) {
  aElems[i].onclick = function() {
    var check = confirm("Confirmez-vous la suppression ?");
    if (check == true) {
      return true;
    }
    else {
      return false;
    }
  };
}
