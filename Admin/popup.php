<?php include('header.php');?>
<link rel="stylesheet" href="popup.css" />


<div class="popup" id="popup">
          <img src="img/tick.png">
            <h5>Data Entered Successfully</h5>
            <button type="button" onclick="closePopup()">OK</button>
        </div>


      <script>
function closePopup() {
  window.location.href = "district.php"; // redirect
}
</script>