<?php
include_once('header.php');
include_once("../dboperation.php");
$obj=new dboperation();
$sql="select * from tbl_district";
$res = $obj->executequery($sql);
?>

<form action="location_action.php" method="POST">
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <ul class="breadcrumbs mb-3">
          <li class="nav-item"><a href="#"></a></li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <div class="card-header">
              <div class="card-title">Location</div>
            </div>

            <div class="card-body">
              <div class="form">
                <div class="form-group form-show-notify row">
                  <div class="col-lg-3 col-md-3 col-sm-4 text-end">
                    <label>District:</label>
                  </div>
                  <div class="col-lg-4 col-md-9 col-sm-8">
                    <select class="form-select input-fixed" id="notify_state" name="districtid" id="districtid">
                      <option value="default">select District</option>
                      <?php while($r = mysqli_fetch_array($res)) { ?>
                        <option value="<?php echo $r["district_id"] ?>">
                          <?php echo $r["district_name"] ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group form-show-notify row mt-3">
                  <div class="col-lg-3 col-md-3 col-sm-4 text-end">
                    <label for="email2">Place</label>
                  </div>
                  <div class="col-lg-4 col-md-9 col-sm-8">
                    <input
                      type="text"
                      class="form-control"
                      name="location"
                      placeholder="Enter Your District"
                    />
                  </div>
                </div>
              </div>
            </div> <!-- card-body -->

            <div class="card-footer">
              <div class="form">
                <div class="form-group from-show-notify row">
                  <div class="col-lg-3 col-md-3 col-sm-12"></div>
                  <div class="col-lg-4 col-md-9 col-sm-12">
                    <button id="displayNotif" class="btn btn-success" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </div>
            </div> <!-- card-footer -->

          </div> <!-- card -->
        </div> <!-- col -->
      </div> <!-- row -->

    </div> <!-- page-inner -->
  </div> <!-- container -->
</form>

<?php if (isset($_GET['status'])): ?>
  <script>
    <?php if ($_GET['status'] == 'success'): ?>
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Location added successfully.',
        confirmButtonColor: '#3085d6'
      });
    <?php elseif ($_GET['status'] == 'exist'): ?>
      Swal.fire({
        icon: 'warning',
        title: 'Duplicate Entry',
        text: 'This location already exists for the selected district.',
        confirmButtonColor: '#f39c12'
      });
    <?php elseif ($_GET['status'] == 'empty'): ?>
      Swal.fire({
        icon: 'info',
        title: 'Missing Info',
        text: 'Please enter a location name.',
        confirmButtonColor: '#3498db'
      });
    <?php elseif ($_GET['status'] == 'error'): ?>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Something went wrong while saving the location.',
        confirmButtonColor: '#d33'
      });
    <?php endif; ?>
  </script>
<?php endif; ?>

<?php include('footer.php'); ?>
