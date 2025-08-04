<?php
include("header.php");
include("../dboperation.php");
$obj = new dboperation();

$sql = "SELECT * FROM tbl_architects";
$res = $obj->executequery($sql);
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">ARCHITECT VIEW PANEL</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title m-0">Registered Architects</h4>
            <input type="text" id="architectSearch" class="form-control" style="width: 250px;" placeholder="Search Architects...">
          </div>

          <div class="card-body">
            <div class="table-responsive">
              <table id="architect-table" class="display table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Username</th>
                    <th>Profile</th>
                    <th>Certificate</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_array($res)) { ?>
                    <tr>
                      <td><?=($row["arch_name"]) ?></td>
                      <td><?=($row["email"]) ?></td>
                      <td><?=($row["phone"]) ?></td>
                      <td><?=($row["username"]) ?></td>
                      <td>
                        <?php if (!empty($row["profiles"])): ?>
                          <img src="../uploads/<?= $row["profiles"] ?>" alt="Profile Pic" width="60" height="60" style="object-fit:cover;border-radius:50%;">
                        <?php else: ?>
                          N/A
                        <?php endif; ?>
                      </td>
                      <td>
                        <?php if (!empty($row["certificate_of_licensce"])): ?>
                          <a href="#" onclick="openPopup('../uploads/<?= $row['certificate_of_licensce'] ?>'); return false;">View</a>
                        <?php else: ?>
                          N/A
                        <?php endif; ?>
                      </td>

                      <td>
                        <?php
                          $status = $row["status"];
                          if ($status == 'Accepted') {
                            echo '<span class="badge bg-success">Accepted</span>';
                          } elseif ($status == 'Rejected') {
                            echo '<span class="badge bg-danger">Rejected</span>';
                          } else {
                            echo '<span class="badge bg-warning text-dark">Pending</span>';
                          }
                        ?>
                      </td>
                      <td>
                        <button class="btn-accept btn btn-success btn-sm" data-id="<?= $row['architect_id'] ?>">Accept</button><br></br>
                        <button class="btn-reject btn btn-danger btn-sm" data-id="<?= $row['architect_id'] ?>">Reject</button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  //SEARCH SECTION
  document.getElementById("architectSearch").addEventListener("keyup", function () {
    const input = this.value.toLowerCase();
    document.querySelectorAll("#architect-table tbody tr").forEach(function (row) {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(input) ? "" : "none";
    });
  });

//SWEET ALERT SECTION
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".btn-accept").forEach(function (btn) {
      btn.addEventListener("click", function () {
        const id = this.getAttribute("data-id");
        Swal.fire({
          title: 'Accept Architect?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Accept',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `architect_status_update.php?id=${id}&status=Accepted`;
          }
        });
      });
    });

    document.querySelectorAll(".btn-reject").forEach(function (btn) {
      btn.addEventListener("click", function () {
        const id = this.getAttribute("data-id");
        Swal.fire({
          title: 'Reject Architect?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Reject',
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `architect_status_update.php?id=${id}&status=Rejected`;
          }
        });
      });
    });
  });

function openPopup(url) {
    window.open(url, 'CertificateWindow', 'width=600,height=500,resizable=yes,scrollbars=yes');
  }
</script>

<?php include("footer.php"); ?>
