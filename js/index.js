function getValueColor() {
    // var form = document.getElementById("js-color");
    var radios = document.getElementsByName('color');
    var elemClicked = document.getElementsByClassName("color")

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked)
            elemClicked[i].classList.add("clicked");
        else
            elemClicked[i].classList.remove("clicked");

    }
}
function getValueSize() {
    // var form = document.getElementById("js-color");
    var radios = document.getElementsByName('Size');
    var elemClicked = document.getElementsByClassName("size")

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked)
            elemClicked[i].classList.add("clicked");
        else
            elemClicked[i].classList.remove("clicked");
    }
}
function getValueImgQuickview() {
    // var form = document.getElementById("js-color");
    var radios = document.getElementsByName('img-quickview');
    var elemClicked = document.getElementsByClassName("item")
    var largeImage = document.querySelector(".img-main img");
    var smallImage = document.querySelectorAll(".item label img");

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            elemClicked[i].classList.add("clicked");
            largeImage.src = smallImage[i].getAttribute("data-image");
        }
        else
            elemClicked[i].classList.remove("clicked");
    }
}



