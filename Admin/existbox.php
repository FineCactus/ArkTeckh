<?php include('header.php');?>
<link rel="stylesheet" href="./css/errorbox.css" />


<div class="popup" id="popup">
          <img src="img/fail.png">
            <h5>Data Already Exist!</h5>
            <button type="button" onclick="closePopup()">OK</button>
        </div>


      <script>
function closePopup() {
  window.location.href = "district.php"; // redirect
}
</script>