var header = document.getElementById('toolbar');
var btn = document.getElementsByClassName('btn');
var span = document.getElementById("span");
window.onscroll = function () {
    //document.documentElement.scrollTop||document.body.scrollTop;
    var scrollTop = document.body.scrollTop || document.documentElement.scrollTop;
    if (scrollTop > 354) {
        // btn.classList.remove('mdui-fab-hide');
        header.classList.add('mdui-color-theme');
    } else {
        // btn.classList.add('mdui-fab-hide');
        header.classList.remove('mdui-color-theme');
    }
}

