function drop() {
    var menu = document.getElementById("dropdown");
    var img = document.getElementById("dropimage");
    var create = document.getElementById("create");
    menu.style.height = "15px";
    img.style.mozTransform = "scaleY(-1)";
    img.style.oTransform = "scaleY(-1)";
    img.style.webkitTransform = "scaleY(-1)";
    img.style.transform = "scaleY(-1)"; 
    create.style.display = "block";
}
function raise(){
    var menu = document.getElementById("dropdown");
    var img = document.getElementById("dropimage");
    var create = document.getElementById("create");
    menu.style.height = "10px";
    img.style.mozTransform = "scaleY(1)";
    img.style.oTransform = "scaleY(1)";
    img.style.webkitTransform = "scaleY(1)";
    img.style.transform = "scaleY(1)";
    create.style.display = "none";
}