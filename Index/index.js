function show() {
    var x = document.getElementById("dropdown-content");

    if (x.style.display == "none") {
        x.style.display = "block";
    }
    else{
        x.style.display = "none";
    }
}

function openPage(url){
    window.open(url);
}