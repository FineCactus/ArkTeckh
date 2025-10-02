<?php 
include('./header.php');
include("../dboperation.php");

// Get total number of customers
$obj = new dboperation();
$customer_sql = "SELECT COUNT(*) as total_customers FROM tbl_customer";
$customer_res = $obj->executequery($customer_sql);
$customer_count = mysqli_fetch_array($customer_res)['total_customers'];

// Get total number of registered architects
$architect_sql = "SELECT COUNT(*) as total_architects FROM tbl_architects";
$architect_res = $obj->executequery($architect_sql);
$architect_count = mysqli_fetch_array($architect_res)['total_architects'];

// Get total number of projects uploaded
$projects_sql = "SELECT COUNT(*) as total_projects FROM tbl_previous_works";
$projects_res = $obj->executequery($projects_sql);
$projects_count = mysqli_fetch_array($projects_res)['total_projects'];

// Get number of pending architects
$pending_sql = "SELECT COUNT(*) as pending_architects FROM tbl_architects WHERE status = 'Pending' OR status = ''";
$pending_res = $obj->executequery($pending_sql);
$pending_count = mysqli_fetch_array($pending_res)['pending_architects'];
?>
        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="../Guest/index.php" class="btn btn-primary btn-round">Home Page</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-primary bubble-shadow-small"
                        >
                          <i class="fas fa-users"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Visitors</p>
                          <h4 class="card-title"><?php echo $customer_count; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-info bubble-shadow-small"
                        >
                          <i class="fas fa-user-check"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Subscribers</p>
                          <h4 class="card-title"><?php echo $architect_count; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-success bubble-shadow-small"
                        >
                          <i class="fas fa-luggage-cart"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Projects</p>
                          <h4 class="card-title"><?php echo $projects_count; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-icon">
                        <div
                          class="icon-big text-center icon-secondary bubble-shadow-small"
                        >
                          <i class="far fa-check-circle"></i>
                        </div>
                      </div>
                      <div class="col col-stats ms-3 ms-sm-0">
                        <div class="numbers">
                          <p class="card-category">Pending</p>
                          <h4 class="card-title"><?php echo $pending_count; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                      <!-- Projects table -->
                      <?php
                        $sql = "SELECT * FROM tbl_architects";
                        $res = $obj->executequery($sql);
                        ?>

                        <table class="table align-items-center mb-0">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col">Architect Name</th>
                              <th scope="col" class="text-end">Email</th>
                              <th scope="col" class="text-end">Phone</th>
                              <th scope="col" class="text-end">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while ($row = mysqli_fetch_array($res)) { ?>
                              <tr>
                                <th scope="row">
                                  <?php if (!empty($row['profiles'])): ?>
                                    <img src="../uploads/<?= $row['profiles'] ?>" alt="Profile" width="50" height="50" style="object-fit:cover; border-radius:50%; margin-right:10px;">
                                  <?php else: ?>
                                    <i class="fa fa-user-circle fa-2x text-muted me-2"></i>
                                  <?php endif; ?>
                                  <?= $row['arch_name'] ?>
                                </th>
                                <td class="text-end"><?= $row['email'] ?></td>
                                <td class="text-end"><?= $row['phone'] ?></td>
                                <td class="text-end">
                                  <?php
                                    $status = $row["status"];
                                    if ($status == 'Accepted') {
                                      echo '<span class="badge badge-success">Accepted</span>';
                                    } elseif ($status == 'Rejected') {
                                      echo '<span class="badge badge-danger">Rejected</span>';
                                    } else {
                                      echo '<span class="badge badge-warning text-dark">Pending</span>';
                                    }
                                  ?>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                  </div>
                </div>
              </div>
        <?php include('footer.php');?>