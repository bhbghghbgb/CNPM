function getValueColor() {
    // var form = document.getElementById("js-color");
    var radios = document.getElementsByName("color");
    var elemClicked = document.getElementsByClassName("color");

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) elemClicked[i].classList.add("clicked");
        else elemClicked[i].classList.remove("clicked");
    }
}
function getValueSize() {
    // var form = document.getElementById("js-color");
    var radios = document.getElementsByName("Size");
    var elemClicked = document.getElementsByClassName("size");

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) elemClicked[i].classList.add("clicked");
        else elemClicked[i].classList.remove("clicked");
    }
}
function getValueImgQuickview() {
    // var form = document.getElementById("js-color");
    var radios = document.getElementsByName("img-quickview");
    var elemClicked = document.getElementsByClassName("item");
    var largeImage = document.querySelector(".img-main img");
    var smallImage = document.querySelectorAll(".item label img");

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            elemClicked[i].classList.add("clicked");
            largeImage.src = smallImage[i].getAttribute("data-image");
        } else elemClicked[i].classList.remove("clicked");
    }
}
function addmess(text, bgcolor, textcolor, time) {
    var al = document.getElementById("message");
    var a = document.getElementById("content_mess");
    a.innerHTML = text;

    al.style.backgroundColor = bgcolor;
    al.style.opacity = 1;
    al.style.zIndex = 200;

    if (textcolor) al.style.color = textcolor;
    if (time)
        setTimeout(function () {
            al.style.display = "none";
            // al.style.opacity = 0;
            // al.style.zIndex = 200;
        }, time);
}
function addmessText(text) {
    addmess(text, "#434343", "white", 2000);
}
