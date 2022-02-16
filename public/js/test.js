"use strict";
window.addEventListener("DOMContentLoaded", (event) => {


    var forScroll = document.getElementById("Emoji");
    // const buttonScroll = document.getElementById('lienAPropos');
    //
    // buttonScroll.onclick = function () {
    //     document.querySelector('html').scrollTop += 700;
    // };
    window.addEventListener("scroll", function() {
        forScroll.style.transform = "rotate("+window.pageYOffset+"deg)";

    });

});