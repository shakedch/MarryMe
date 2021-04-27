function clickForMore() {
  var x = document.getElementById("showTaskBank");
  var y = document.getElementById("taskNameInput");
  if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
  } else {
    x.style.display = "none";
    y.style.display = "block";
  }
}
