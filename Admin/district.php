
<?php include('header.php');?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<form action="districtaction.php" method="POST">

<div class="container" >
          <div class="page-inner">
            <div class="page-header">
              <ul class="breadcrumbs mb-3">
                <li class="nav-item">
                  <a href="#"></a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">District</div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-lg-4">
                        <div class="form-group">
                          <label for="email2">District</label>
                          <input
                            type="text"
                            class="form-control"
                            name="district"
                            placeholder="Enter Your District"
                          />
                        </div><br>
                    <button class="btn btn-success" type="submit" name="submit">Submit</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</form>

<!-- FORM ending -->

<!-- Sweet Alert -->
 
<?php if (isset($_GET['status'])): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      let status = "<?php echo $_GET['status']; ?>";

      if (status === "success") {
        Swal.fire({
          icon: 'success',
          title: 'Category Added!',
          text: 'District has been successfully added.',
        });
      } else if (status === "exist") {
        Swal.fire({
          icon: 'warning',
          title: 'Already Exists',
          text: 'District already exists!',
        });
      } else if (status === "empty") {
        Swal.fire({
          icon: 'info',
          title: 'Empty Field',
          text: 'Please enter a district name!',
        });
      } else if (status === "error") {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Something went wrong while adding the district.',
        });
      }

      // Remove status from URL
      window.history.replaceState({}, document.title, "category.php");
    });
  </script>
<?php endif; ?>



<!-- Footer -->

<?php include('footer.php');?>