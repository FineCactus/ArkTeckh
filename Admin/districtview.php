<?php
include("header.php");
include("../dboperation.php");
$obj = new dboperation();
$s = "select * from tbl_district";
$res = $obj->executequery($s);
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <div class="container">
          <div class="page-inner">
            <div class="page-header">
              <h3 class="fw-bold mb-3">DISTRICT VIEW PANEL</h3>
              <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                  <a href="#">District View</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h4 class="card-title m-0">Districts</h4>
                      <div class="ms-auto">
                      <input type="text" id="districtSearch" class="form-control" style="width: 250px;" placeholder="Search Districts...">
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table
                        id="basic-datatables"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                            <th>District ID</th>
                            <th>District</th>
                          </tr>
                        </thead>
            <tbody>
              <?php
              while ($r = mysqli_fetch_array($res)) {
              ?>
                <tr>
                  <td><?php echo $r["district_id"]; ?></td>
                  <td><?php echo $r["district_name"]; ?></td>
                  <td><button class="btn-delete"
                          data-id="<?php echo $r['district_id']; ?>"
                          style="background-color:rgb(180, 180, 180); color: black; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-weight: 500; display: inline-block;">Delete</button>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const districtId = this.getAttribute("data-id");

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
          if (result.isConfirmed) {
            // Redirect to deletion URL
            window.location.href = `district_delete.php?eid=${districtId}`;
          }
        });
      });
    });
  });
</script>


<?php
include_once("footer.php");
?>