fadeCounter = 2;
setInterval(
    function() {
        $(".fade-" + fadeCounter).toggle(0, "linear");
        fadeCounter--;
        if (fadeCounter < 0) {
            fadeCounter = 2;
        }
        $(".fade-" + fadeCounter).fadeToggle("slow", "linear");
    }, 3000);