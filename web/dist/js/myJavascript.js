var registration = document.getElementById("reg-response").innerHTML;
event = event || window.event;

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
    var result;
    
    if(check) {
        evt.style.border = "1px solid green";
        document.getElementById("reg-username-msg").style.display = "none";
        result = true;
    } else {
        evt.style.border = "1px solid red";
        document.getElementById("reg-username-msg").style.display = "table-row";
        result = false;
    }
    
    return result;
}

// check email input
function checkMail(evt) {
    var value = evt.value;
    var check = value.match(/^([a-zA-Z0-9._-]+)[@](\w+)[.](\w+)$/);
    var result;
    
    if(check) {
        evt.style.border = "1px solid green";
        document.getElementById("reg-mail-msg").style.display = "none";
        result = true;
    } else {
        evt.style.border = "1px solid red";
        document.getElementById("reg-mail-msg").style.display = "table-row";
        result = false;
    }
    
    return result;
}

// check password input
function checkPassword(evt) {
    var value = evt.value;
    var check = value.match(/^.{8,64}$/);
    var result;
    
    if(check) {
        evt.style.border = "1px solid green";
        document.getElementById("reg-password-msg").style.display = "none";
        result = true;
    } else {
        evt.style.border = "1px solid red";
        document.getElementById("reg-password-msg").style.display = "table-row";
        result = false;
    }
    
    return result;
}

function checkConfirmPassword(evt) {
    var thisValue = evt.value;
    var passValue = document.getElementById("reg-password").value;
    var result;
    
    if(thisValue.length !== 0 && thisValue === passValue) {
        evt.style.border = "1px solid green";
        document.getElementById("reg-check-msg").style.display = "none";
        result = true;
    } else {
        evt.style.border = "1px solid red";
        document.getElementById("reg-check-msg").style.display = "table-row";
        result = false;
    }
    
    return result;
}

// show/hide registration form
function overlay() {
    var el = document.getElementById("reg-container");

    document.getElementById("reg-response").innerHTML = registration;

    el.style.visibility = (el.style.visibility === "visible") ? "hidden" : "visible";
}

function signUp() {
    var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
    
    var username = document.getElementById("reg-username");
    var a = checkUsername(username);
    
    var mail = document.getElementById("reg-mail");
    var b = checkMail(mail);
    
    var password = document.getElementById("reg-password");
    var c = checkPassword(password);
    
    var confirmPassword = document.getElementById("reg-confPword");
    var d = checkConfirmPassword(confirmPassword);
    
    if(a && b && c && d) {
        xmlhttp.open("POST", "index.php/register", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("uname=" + username.value + "&mail=" + mail.value + "&password="
                        + password.value + "&checkPassword=" + confirmPassword.value);

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var status = JSON.parse(xmlhttp.response);

                var msg = "";

                if(status === '1') {
                    msg = "<span style='color: red;'>Congratulations!</span> You have registered successfully<br>\n\
                            <a href='#'>Click here</a> to sign in automatically<br>\n\
                            Or <a onclick='overlay();' style='cursor: pointer;'>close</a> this form";
                } else if(status === '2') {
                    msg = "<span style='color: red;'>Username is already taken.</span><br>\n\
                            Please, <a onclick='this.parentNode.innerHTML = registration;' style='cursor: pointer;'>try again</a> or<br>\n\
                            <a onclick='overlay();' style='cursor: pointer;'>Close this form</a>";
                } else if(status === '3') {
                    msg = "<span style='color: red;'>Password did not match!</span><br>\n\
                            Please, <a onclick='this.parentNode.innerHTML = registration;' style='cursor: pointer;'>try again</a> or<br>\n\
                            <a onclick='overlay();' style='cursor: pointer;'>Close this form</a>";
                } else {
                    msg = "<span style='color: red;'>Sorry... Something went wrong</span><br>\n\
                            Please, <a onclick='this.parentNode.innerHTML = registration;' style='cursor: pointer;'>try again</a> or<br>\n\
                            <a onclick='overlay();' style='cursor: pointer;'>Close this form</a>";
                }

                document.getElementById("reg-response").innerHTML = msg;
            }
        };
    } else {
        confirm("There are errors, please recorret them!");
    }
}

function signIn() {
    event.preventDefault();
    
    var xmlhttp = (new XMLHttpRequest) || (new ActiveXObject);
    
    var username = document.getElementById("sign-username").value;
    var password = document.getElementById("sign-password").value;

    xmlhttp.open("POST", "index.php/login", true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send("uname=" + username + "&password=" + password);
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var status = JSON.parse(xmlhttp.response);

            if(status === '1') {
                location.reload();
            } else {
                alert("zdaa");
            }
        }
    };
}

function hasClassName(domNode, className) {
    var names = domNode.className.split(" ");
    
    for(var i = 0; i<names.length; i++) {
        if(names[i] === className) {
            return true;
        }
    }
    
    return false;
}

function widgetButtonActions (e) {
    e = e || window.event;
    var source = e.target || e.srcElement;

    if(hasClassName(source, "remove")) {
        this.parentNode.removeChild(this);
    }
    
    if(hasClassName(source, "minimize")) {
        var children = this.children;
        
        source.innerHTML = (source.innerHTML === "▼") ? "▲" : "▼";

        for(var i = 1; i<children.length; i++) {
            children[i].style.display = (children[i].style.display === "none") ? "block" : "none";
        }
    }
}

function renderWidget() {
    var html = document.getElementById("w-tpl").innerHTML;
    var temp = document.createElement("div");
    temp.innerHTML = html.trim();
    var widget = temp.firstChild;
    
    var column = document.getElementsByClassName("column")[0];
    column.appendChild(widget);
    
    return widget;
}

var list = document.getElementById("widget-list");
list.onclick = function loadWidget(e) {    
    e = e || window.event;
    var source = e.target || e.srcElement;
    
    if(source.className === "widget-item") {
        var widget = renderWidget();
        
        var client = new XMLHttpRequest();
        
        client.open("GET", source.href, false);
        
        client.onreadystatechange = function() {
            var option = JSON.parse(this.responseText);
            
            widget.getElementsByClassName("widget-header-text")[0].innerHTML = option.header;
            widget.getElementsByClassName("widget-content")[0].innerHTML = option.content;
            widget.getElementsByClassName("widget-footer")[0].innerHTML = option.footer;
        };
        
        widget.onclick = widgetButtonActions;
        
        client.send(null);
    }
    
    return false;
};

function insertByPosition(elem, column) {
    var children = column.childNodes;
    var mouseY = event.pageY;
    var scrollY = document.body.scrollTop;
    
    for(var i = 1; i < children.length; i++) {
        var child = children[i];
        var childTop = child.getBoundingClientRect().top + scrollY;
        var childBottom = child.getBoundingClientRect().bottom + scrollY;
        var margin = window.getComputedStyle(child).marginBottom || child.currentStyle.marginBottom;
        margin = parseInt(margin, 10);
        
        if(mouseY < column.firstElementChild.getBoundingClientRect().top + scrollY) {
            src = column.firstElementChild;
        } else if(mouseY > column.lastElementChild.getBoundingClientRect().bottom + scrollY) {
            src = column.lastElementChild;
        }
        if(mouseY < childBottom + scrollY && mouseY > (childTop - margin)) {
            src = child;
        }
    }
    column.insertBefore(elem, src);
}

var content = document.getElementById("widget-container");
content.onmousedown = function(event) {
    event = event || window.event;
    var source = event.target || event.srcElement;
    
    if(source.className === "widget-header" || source.parentNode.className === "widget-header") {
        var mouseIsDown = true;
        
        while (source.className !== "widget" && source !== this) {
            source = source.parentNode;
        }
        
        if(source.className === "widget") {
            var srcRectangle = source.getBoundingClientRect();

            var srcX = srcRectangle.left + document.body.scrollLeft;
            var srcY = srcRectangle.top + document.body.scrollTop;

            var srcWidth = srcRectangle.right - srcRectangle.left;
            var srcHeight = srcRectangle.bottom - srcRectangle.top;

            var mouseX = event.pageX || (document.body.scrollLeft + event.clientX);
            var mouseY = event.pageY || (document.body.scrollTop + event.clientY);
            var div = document.createElement("div");
            
            div.className = "widget-shadow";
            div.style.width = srcWidth + "px";
            div.style.height = srcHeight + "px";
            
            source.parentNode.replaceChild(div, source);
            document.body.appendChild(source);
            
            source.style.position = "absolute";
            source.style.width = srcWidth + "px";
            source.style.left = srcX + "px";
            source.style.top = srcY + "px";
            source.style.zIndex = "6000";
            
            document.onmousemove = function(event) {
                if(mouseIsDown) {
                    event = event || window.event;

                    var changeX = event.pageX || (document.body.scrollLeft + event.clientX);
                    changeX -= mouseX;
                    var changeY = event.pageY || (document.body.scrollTop + event.clientY);
                    changeY -= mouseY;

                    var srcChangeX = srcX + changeX;
                    var srcChangeY = srcY + changeY;

                    source.style.left = srcChangeX + "px";
                    source.style.top = srcChangeY + "px";
                    
                    var cl;
                    var cl2 = document.getElementById("column-2");
                    var cl3 = document.getElementById("column-3");
                    
                    if(event.pageX > cl3.getBoundingClientRect().left) {
                        cl = cl3;
                    } else if(event.pageX > cl2.getBoundingClientRect().left) {
                        cl = cl2;
                    } else {
                        cl = document.getElementById("column-1");
                    }
                    
                    cl.appendChild(div);
                    
                    insertByPosition(div, cl);
                }
            };

            source.onmouseup = function() {
                if(mouseIsDown) {
                    div.parentNode.replaceChild(source, div);
                    source.style.position = "relative";
                    source.style.width = "100%";
                    source.style.top = "0px";
                    source.style.left = "0px";
                    source.style.zIndex = "0";
                    mouseIsDown = false;
                }
            };
        }
    }
};

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