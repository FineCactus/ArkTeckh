<?php 
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();

$categories = [];
$res_cat = $obj->executequery("SELECT category_id, category_name FROM tbl_category ORDER BY category_name ASC");
while ($row = mysqli_fetch_assoc($res_cat)) {
    $categories[] = $row;
}

$districts = [];
$res_dist = $obj->executequery("SELECT district_id, district_name FROM tbl_district ORDER BY district_name ASC");
while ($row = mysqli_fetch_assoc($res_dist)) {
    $districts[] = $row;
}

?>

<link href="project1.css" rel="stylesheet">
<form action="get_locationaction.php" method="POST">
<div class="background-image"></div>
<div class="overlay"></div>
<main>
  <div class="project-card">
    <h2>Select Details</h2>
      <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" required>
          <option value="" selected disabled>-- Select Category --</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?= $category['category_id']; ?>">
              <?= ($category['category_name']); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

        <div class="form-group">
        <label for="district_id">District</label>
        <select name="district_id" id="district_id" required>
            <option value="" selected disabled>-- Select District --</option>
            <?php foreach ($districts as $district): ?>
            <option value="<?= $district['district_id']; ?>">
                <?= ($district['district_name']); ?>
            </option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="form-group">
        <label for="location_id">Location</label>
        <select name="location_id" id="location_id" required>
            <option value="">-- Select Location --</option>
        </select>
        </div>


      <button type="submit" class="next-btn">Next</button>
    </form>
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
