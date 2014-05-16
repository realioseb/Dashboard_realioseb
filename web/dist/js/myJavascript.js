// minimize and maximize left sidebar
function sideBarMaximizeMinimize(evt) {
    var list = evt.parentNode.children;
    
    if(list[1].style.display === "none") {
        for(var i = 0; i<list.length; i++) {
            if(i === 0) {
                list[i].children[0].innerHTML = "&#x25BC";
            } else {
                list[i].style.display = "block";
            }
        }
    } else {
        for(var i = 0; i<list.length; i++) {
            if(i === 0) {
                list[i].children[0].innerHTML = "&#x25B2";
            } else {
                list[i].style.display = "none";
            }
        }
    }
}