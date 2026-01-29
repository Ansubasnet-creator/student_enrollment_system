document.getElementById("search")?.addEventListener("keyup", function(){
 fetch("search.php?q="+this.value)
  .then(r=>r.text())
  .then(d=>document.getElementById("result").innerHTML=d);
});
