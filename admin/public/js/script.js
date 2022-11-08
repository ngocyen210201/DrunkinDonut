// ẩn hiện menu
function toggleMenu() {
  let navigation = document.querySelector(".navigation");
  console.log("navigation", navigation);
  let toggle = document.querySelector(".toggle");
  console.log("toggle", toggle);
  let main = document.querySelector(".main");
  console.log("main", main);
  navigation.classList.toggle("active");
  toggle.classList.toggle("active");
  main.classList.toggle("active");
  $(document).ready(function () {
    if ($(".navigation").hasClass("active")) {
      document.querySelector(".role-name-a").style.margin = "0px";
      document.querySelector(".role-name-a").style.transition = ".5s";
    } else {
      document.querySelector(".role-name-a").style.margin = "20px";
    }
  });
}

// check all checkbox
function toggle(source) {
  checkboxes = document.getElementsByClassName("checkBox");
  for (var i = 0, n = checkboxes.length; i < n; i++) {
    checkboxes[i].checked = source.checked;
  }
}

// mở pop up box
function openModal(id) {
  // Get the modal
  var modalID = "myModal-" + id;
  var spanID = "close-" + id;
  var modal = document.getElementById(modalID);
  // Get the button that opens the modal
  // var btn = document.getElementById(id);
  // Get the <span> element that closes the modal
  var span = document.getElementById(spanID);
  // When the user clicks the button, open the modal
  modal.style.display = "block";

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  };

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
  return id;
}

// tìm id
function passSelect(id) {
  var url = window.location.href;
  var oringinalID = id;
  var split = oringinalID.split("-");
  var editID = split[2];
  var selectID = "role-list-" + editID;
  $(document).ready(function () {
    value = $("#" + selectID).val();
    window.location.href = url + "?edit-account=" + editID + "&role=" + value;
  });
}

// tìm id
function passIdProduct(id) {
  var url = window.location.href;
  var oringinalID = id;
  var split = oringinalID.split("-");
  var editID = split[2];
  var inputID = "#quantity" + (editID-1);
  // console.log(inputID);
  $(document).ready(function () {
    value = $(inputID).val();
    // console.log(value);
    window.location.href = url + "?edit-product=" + editID + "&quantity=" + value;
    
  });
}

// confirm xóa
function onDelete() {
  return confirm("Are you sure you want to delete this product?");
}

// preview ảnh
function imagePreview(fileInput) {
  if (fileInput.files && fileInput.files[0]) {
    var fileReader = new FileReader();
    fileReader.onload = function (event) {
      $("#preview-img").html('<img src="' + event.target.result + '" width="100%" height="auto"/>');
    };
    fileReader.readAsDataURL(fileInput.files[0]);
  }
}

// xóa ảnh preview
function delImage() {
  const image = document.getElementById(`image`);
  image.value = "";
  const preview = document.getElementById(`preview-img`);
  preview.innerHTML = "";
  var close = document.getElementById("close");
  close.style.display = "none";
}

// hiện nút close + preview ảnh
function displayPreview(){
  $("#image").change(function () {
    var close = document.getElementById("close");
    close.style.display = "block";
    imagePreview(this); //
  });
}


