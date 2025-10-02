<?php include('./header.php');?>
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
                          <h4 class="card-title">1,294</h4>
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
                          <h4 class="card-title">1303</h4>
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
                          <p class="card-category">Sales</p>
                          <h4 class="card-title">$ 1,345</h4>
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
                          <p class="card-category">Order</p>
                          <h4 class="card-title">576</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                      <!-- Projects table -->
                      <?php
                        include("../dboperation.php");
                        $obj = new dboperation();
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