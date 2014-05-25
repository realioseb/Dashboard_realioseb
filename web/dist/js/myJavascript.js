// minimize and maximize left sidebar
function sideBarMaximizeMinimize(evt) {
    var list = evt.parentNode.children;
    
    var title = evt.parentNode.children[0].children[0];
    
    title.innerHTML = (title.innerHTML === "▼") ? "▲" : "▼";
    
    for(var i = 1; i<list.length; i++) {
        list[i].style.display = (list[i].style.display === "none") ? "block" : "none";
    }
}

// show/hide registration form
function overlay() {
	el = document.getElementById("reg-container");
	el.style.visibility = (el.style.visibility === "visible") ? "hidden" : "visible";
}

function signUp() {
    var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
    
    var username = document.getElementById("reg-username").value;
    var mail = document.getElementById("reg-mail").value;
    var password = document.getElementById("reg-password").value;
    var confirmPassword = document.getElementById("reg-confPword").value;
    
    xmlhttp.open("POST", "index.php/register", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("uname=" + username + "&mail=" + mail + "&password=" + password + "&checkPassword=" + confirmPassword);
    
    
    
    xmlhttp.onreadystatechange=function()
    {
        var result = JSON.parse(xmlhttp.responseText);
        
        if(result) {
            document.getElementById("reg-response").innerHTML = "gilocav shen daregistrirdi!";
        } else {
            document.getElementById("reg-response").innerHTML = "Xelaxla scade! -_-";
        }
    };
}
//    <!DOCTYPE html>
//    <html>
//    <head>
//    </head>
//    <body>
//
//    <ul id="item-list">
//      <li class="item">
//        <span>Item 1</span>
//      </li>
//      <li>Item 2</li>
//      <li>Item 3</li>
//      <li>Item 4</li>
//    </ul>
//
//    <script type="text/javascript">
//    var ul = document.getElementById("item-list");
//
//    ul.onclick = function(event) {
//      event = event || window.event;
//      var source = event.target || event.srcElement;
//
//      while (source.nodeName !== "LI" && source !== this) {
//        source = source.parentNode;
//      }
//
//      if (source.className === "item") {
//        alert(source.nodeName + ": " + source.innerHTML);
//      }
//    }
//
//    </script>
//
//    </body>
//    </html>