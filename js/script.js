//Load background image in a div
//@param linK: image name
//@param elementID: div element id
function loadImage(link, elementID) {
  
  if (elementID == "recipe-main") {
    document.getElementById(
      `${elementID}`
    ).style.backgroundImage = `linear-gradient(to bottom, rgba(2, 2, 2, 0.9), rgb(49, 49, 48, 0.2)), url('images/assets/${link}')`;
  } else {
    document.getElementById(
      `${elementID}`
    ).style.backgroundImage = `url('images/assets/${link}')`;
  }
}
function printList(){
  window.print();
  window.location.href = "index.php?clear=1";
}
function loadCollapse(){
var acc = document.getElementsByClassName("collapse");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
  
    this.classList.toggle("active");

    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
}



