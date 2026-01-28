document.getElementById("search").addEventListener("keyup", function () {
    fetch("search.php?q=" + this.value)
        .then(res => res.text())
        .then(data => {
            document.getElementById("result").innerHTML = data;
        });
});
