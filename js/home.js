function showForm1() {
  var overlay = document.getElementById('formOverlay1');
  overlay.style.display = 'flex';
}

function showForm2() {
  var overlay = document.getElementById('formOverlay2');
  overlay.style.display = 'flex';
}

function showForm3() {
  var overlay = document.getElementById('formOverlay3');
  overlay.style.display = 'flex';
}

function showForm4() {
  var overlay = document.getElementById('formOverlay4');
  overlay.style.display = 'flex';
}

function hideForm() {
  var overlay1 = document.getElementById('formOverlay1');
  var overlay2 = document.getElementById('formOverlay2');
  var overlay3 = document.getElementById('formOverlay3');
  var overlay4 = document.getElementById('formOverlay4');
  overlay1.style.display = 'none';
  overlay2.style.display = 'none';
  overlay3.style.display = 'none';
  overlay4.style.display = 'none';
}

function outform() {
  var out = document.getElementById('out');
  window.location.href = "login.html";
}
