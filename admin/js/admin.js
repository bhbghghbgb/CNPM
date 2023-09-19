function showmenu(){
    var btn=document.getElementById('show-icon-js');
    var menu=document.getElementById('menu-js');
    
    btn.onclick=function(){
        if( window.getComputedStyle(menu).display=="none")
        menu.style.setProperty('display', 'block', 'important');
        else
        menu.style.setProperty('display', 'none', 'important');
    }

}
function choosemenu(){
    // var ds = document.querySelectorAll('#ulMenu a li');
    // ds.forEach(function(item) {
    //     item.addEventListener("click", function() {
    //       ds.forEach(function(item) {
    //         item.style.backgroundColor = "white";
    //       });
    //       this.style.backgroundColor = "blue";
    //     });
    //   });

}