<?php
include("header.php");
include_once("../dboperation.php");
$obj = new dboperation();
$sql = "select * from tbl_district";
$result = $obj->executequery($sql);
?>

<script src="../jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function () {
    $("#districtid").change(function () {
      var district_id = $(this).val();
      $.ajax({
        url: "getlocation.php",
        method: "POST",
        data: { districtid: district_id },
        success: function (response) {
          $("#location").html(response);
        },
        error: function () {
          $("#location").html("<tr><td colspan='3'>Error loading locations</td></tr>");
        }
      });
    });

    // Location search filter
    $("#locationSearch").on("keyup", function () {
      var input = $(this).val().toLowerCase();
      $("#location tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1)
      });
    });
  });
</script>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">LOCATION VIEW PANEL</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="index.php"><i class="icon-home"></i></a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Location View</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Select District</h4>
            <div class="ms-auto">
              <input type="text" id="locationSearch" class="form-control" style="width: 250px;" placeholder="Search Locations...">
            </div>
          </div>

          <div class="card-body">
            <div class="form-group mb-4">
              <label>Select a District</label>
              <select class="form-control" name="districtid" id="districtid">
                <option value="" disabled selected hidden>--------Select District-----------</option>
                <?php while ($r = mysqli_fetch_array($result)) { ?>
                  <option value="<?php echo $r["district_id"]; ?>"><?php echo $r["district_name"]; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="table-responsive">
              <table class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Sl.No</th>
                    <th>Location Name</th>
                    <th>Actions</th>.n++++++
                  </tr>
                </thead>
                <tbody id="location">
                </tbody>
              </table>
            </div>

          </div> <!-- card-body -->
        </div> <!-- card -->
      </div> <!-- col -->
    </div> <!-- row -->
  </div> <!-- page-inner -->
</div> <!-- container -->


<?php include("footer.php"); ?>
