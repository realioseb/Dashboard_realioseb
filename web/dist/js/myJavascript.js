var registration = document.getElementById("reg-response").innerHTML;

// minimize and maximize left sidebar
function sideBarMaximizeMinimize(evt) {
    var list = evt.parentNode.children;
    
    var title = evt.parentNode.children[0].children[0];
    
    title.innerHTML = (title.innerHTML === "▼") ? "▲" : "▼";
    
    for(var i = 1; i<list.length; i++) {
        list[i].style.display = (list[i].style.display === "none") ? "block" : "none";
    }
}

// check username input
function checkUsername(evt) {
    var value = evt.value;
    
    var check = value.match(/^[a-z0-9_-]{4,20}$/);
    
    if(check) {
        evt.style.border = "1px solid green";
    } else {
        evt.style.border = "1px solid red";
    }
}

// check email input
function checkMail(evt) {
    var value = evt.value;
    
    var check = value.match(/^([a-zA-Z0-9._-]+)[@](\w+)[.](\w+)$/);
    
    if(check) {
        evt.style.border = "1px solid green";
    } else {
        evt.style.border = "1px solid red";
    }
}

// check password input
function checkPassword(evt) {
    var value = evt.value;
    
    var check = value.match(/^.{8,64}$/);
    
    if(check) {
        evt.style.border = "1px solid green";
    } else {
        evt.style.border = "1px solid red";
    }
}

function confirmPassword(evt) {
    var thisValue = evt.value;
    
    var passValue = document.getElementById("reg-password").value;
    
    if(thisValue === passValue) {
        evt.style.border = "1px solid green";
    } else {
        evt.style.border = "1px solid red";
    }
}

// show/hide registration form
function overlay() {
    var el = document.getElementById("reg-container");

    document.getElementById("reg-response").innerHTML = registration;

    el.style.visibility = (el.style.visibility === "visible") ? "hidden" : "visible";
}

function signUp() {
    var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
    
    var username = document.getElementById("reg-username").value;
    var mail = document.getElementById("reg-mail").value;
    var password = document.getElementById("reg-password").value;
    var confirmPassword = document.getElementById("reg-confPword").value;
    
    xmlhttp.open("POST", "index.php/register", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("uname=" + username + "&mail=" + mail + "&password=" + password + "&checkPassword=" + confirmPassword);
    
    xmlhttp.onreadystatechange = function() {
        var status = JSON.parse(xmlhttp.response);
        
        var msg = "";
        
        if(status === 1) {
            msg = "<span style='color: red;'>Congratulations!</span> You have registered successfully<br>\n\
                    <a href='#'>Click here</a> to sign in automatically<br>\n\
                    Or <a onclick='overlay();' style='cursor: pointer;'>close</a> this form";
        } else if(status === 2) {
            msg = "<span style='color: red;'>Username is already taken.</span><br>\n\
                    Please, <a onclick='this.parentNode.innerHTML = registration;' style='cursor: pointer;'>try again</a> or<br>\n\
                    <a onclick='overlay();' style='cursor: pointer;'>Close this form</a>";
        } else if(status === 3) {
            msg = "<span style='color: red;'>Password did not match!</span><br>\n\
                    Please, <a onclick='this.parentNode.innerHTML = registration;' style='cursor: pointer;'>try again</a> or<br>\n\
                    <a onclick='overlay();' style='cursor: pointer;'>Close this form</a>";
        } else {
            msg = "<span style='color: red;'>Sorry... Something went wrong</span><br>\n\
                    Please, <a onclick='this.parentNode.innerHTML = registration;' style='cursor: pointer;'>try again</a> or<br>\n\
                    <a onclick='overlay();' style='cursor: pointer;'>Close this form</a>";
        }
        
        document.getElementById("reg-response").innerHTML = msg;
    };
}
















//function signIn() {
//    var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
//    
//    var username = document.getElementById("sign-username").value;
//    var password = document.getElementById("sign-password").value;
//
//    xmlhttp.open("POST", "index.php/sign", true);
//    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
//    xmlhttp.send("uname=" + username + "&password=" + password);
//    
//    xmlhttp.onreadystatechange=function()
//    {
//        var result = JSON.parse(xmlhttp.responseText);
//    };
//}


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