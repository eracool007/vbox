//Gets elements for print recipe modal

var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

//Gets elements for add ingredients modal
var modal2 = document.getElementById("myModal2");
var span2 = document.getElementsByClassName("close2")[0];

span2.onclick = function() {
  modal2.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal2) {
    modal2.style.display = "none";
   
  }
}

function showModal2(){
  modal2.style.display = "block";
}