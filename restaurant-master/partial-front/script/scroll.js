// Style of Windows 
window.onscroll = function() {
    if (pageYOffset > 1000) {
        header.style.position = "fixed";
        header.style.top = "0";
    } else {
        header.style.position = "";
        header.style.top = "";
    }
}

function textStyle() {
    text.style.background = "#fff";
    text.style.fontSize = "1rem";
    text.style.fontFamily = "Khmer OS Koulen";
}

function ereasetextStyle() {
    text.style.background = "";
    text.style.fontSize = "";
    text.style.fontFamily = "Khmer OS Koulen";
}

text.onmouseover = textStyle;
text.onmouseout = ereasetextStyle;