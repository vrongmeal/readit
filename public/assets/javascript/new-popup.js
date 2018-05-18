var alpha = [
                '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
                'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            ];
function load_url() {
    var x = "";
    for (var i = 0; i < 10; i++) {
        x += alpha[Math.floor(Math.random()*36)];
    }
    document.getElementById("url").value = x;
}
window.addEventListener("load", function() {
    this.console.log(document.getElementById("new-popup").style.display);
    load_url();
    this.document.getElementById("new-button").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("new-popup").style.display = "block";
        document.getElementById("main-content").style.overflow = "hidden";
    })
    this.document.getElementById("close-new-popup").addEventListener("click", function() {
        document.getElementById("new-popup").style.display = "none";
        document.getElementById("main-content").style.overflow = "scroll";
    });
});
