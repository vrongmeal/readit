window.addEventListener("load", function() {
    this.document.getElementsByClassName("press-enter-comment")[0].style.display = "none";
    this.document.getElementById("new-comment").addEventListener("focus", function() {
        document.getElementsByClassName("press-enter-comment")[0].style.display = "block";
    })
    this.document.getElementById("new-comment").addEventListener("blur", function() {
        document.getElementsByClassName("press-enter-comment")[0].style.display = "none";
    })
    document.getElementById("new-comment").addEventListener("keypress", function(e) {
        if (e.which === 13) {
            document.getElementById("new-comment").form.submit();
            e.preventDefault();
        }
    });
});