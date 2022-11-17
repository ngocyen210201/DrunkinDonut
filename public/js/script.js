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

// view cart

// submit form khi nút "Lưu thay đổi" đc bấm
function saveChange() {
  document.getElementById("myForm").submit();
}

function checkout() {
  // thay đổi action của form
  document.getElementById("myForm").action = "../order/checkout.php";
  // thay đổi method của form
  document.getElementById("myForm").method = "get";
  // submit form
  document.getElementById("myForm").submit();
  e.preventDefault();
}
