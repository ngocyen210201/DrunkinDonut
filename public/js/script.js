function search() {
  $("#search").click(function () {
    var keyword = $("#search-box").val();
    window.location = "./include/search.php?keyword=" + keyword;
  });
}
function showPass() {
  var x = document.getElementById("pass");
  var y = document.getElementById("new_pass");
  var z = document.getElementById("new_pass1");
  if (x !== null) {
    if (x.type === "password") {
      x.type = "text";
      y.type = "text";
      z.type = "text";
    } else {
      x.type = "password";
      y.type = "password";
      z.type = "password";
    }
  } else {
    if (y.type === "password") {
      y.type = "text";
      z.type = "text";
    } else {
      y.type = "password";
      z.type = "password";
    }
  }
}

