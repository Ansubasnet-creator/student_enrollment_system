document.addEventListener("DOMContentLoaded", () => {
    const search = document.getElementById("search");

    search.addEventListener("keyup", () => {
        fetch("search.php?term=" + search.value)
            .then(res => res.text())
            .then(data => {
                console.log(data);
            });
    });
});
