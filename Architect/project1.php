<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

$sql="select* from tbl_architects";
$res=$obj->executequery($sql);
$display=mysqli_fetch_array($res);
?>

<link href="css/project1.css" rel="stylesheet">

<style>
  
    .background-image {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background: url('img/project-1.jpg') no-repeat center center fixed;
        background-size: cover;
        z-index: -2;
    }


</style>

<form action="get_locationaction.php" method="POST">

<input type="hidden" name="architect_id" value="<?php echo $display['architect_id']; ?>">

<div class="background-image"></div>
<div class="overlay"></div>
<main>
  <div class="project-card">
    <h2>Select Details</h2>
      <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
          <option value="" selected disabled>-- Select Category --</option>
          <?php 
          $locs = $obj->executequery("SELECT * FROM tbl_category");
          while ($row = mysqli_fetch_assoc($locs)) {
            echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
          }?>
        </select>
      </div>

        <div class="form-group">
        <label for="district_id">District</label>
        <select name="district_id" id="district_id" required>
            <option value="" selected disabled>-- Select District --</option>
            <?php 
          $locs = $obj->executequery("SELECT * FROM tbl_district");
          while ($row = mysqli_fetch_assoc($locs)) {
            echo "<option value='{$row['district_id']}'>{$row['district_name']}</option>";
          }?>
        </select>
        </div>

        <div class="form-group">
        <label for="location_id">Location</label>
        <select name="location_id" id="location_id" required>
            <option value="">-- Select Location --</option>
        </select>
        </div>


      <button type="submit" class="next-btn" name="submit">Next</button>
  </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#district_id').on('change', function() {
    var districtid = $(this).val();
    $.ajax({
        type: 'POST',
        url: 'get_locations.php',
        data: {districtid: districtid},
        success: function(html) {
            $('#location_id').html(html);
        }
    });
});
</script>
</form>
<?php include("footer.php"); ?>
