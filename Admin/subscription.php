<?php
include_once('header.php');
include_once("../dboperation.php");
$obj=new dboperation();
$sql="select * from tbl_plan ORDER BY plan_id";
$res = $obj->executequery($sql);
?>

  <div class="container">
    <div class="page-inner">

      <div class="row">
        <div class="col-md-12">
          <div class="card">

            <div class="card-header">
              <div class="card-title">Manage Subscription Plan Amounts</div>
              <div class="card-category">Update the pricing for existing subscription plans</div>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Plan ID</th>
                      <th>Plan Name</th>
                      <th>Current Amount (₹)</th>
                      <th>Duration (Days)</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while($r = mysqli_fetch_array($res)) { ?>
                    <tr>
                      <td><?php echo $r['plan_id']; ?></td>
                      <td><span class="badge badge-info"><?php echo ucfirst($r['plan_name']); ?></span></td>
                      <td>₹<?php echo $r['amount']; ?></td>
                      <td><?php echo $r['duration']; ?> days</td>
                      <td>
                        <button class="btn btn-primary btn-sm" onclick="editPlan(<?php echo $r['plan_id']; ?>, '<?php echo $r['plan_name']; ?>', <?php echo $r['amount']; ?>, <?php echo $r['duration']; ?>)">
                          <i class="fas fa-edit"></i> Edit Amount
                        </button>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div> <!-- card-body -->

          </div> <!-- card -->
        </div> <!-- col -->
      </div> <!-- row -->

    </div> <!-- page-inner -->
  </div> <!-- container -->

<!-- Edit Plan Modal -->
<div class="modal fade" id="editPlanModal" tabindex="-1" role="dialog" aria-labelledby="editPlanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="action_pages/subscription_action.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="editPlanModalLabel">Update Plan Amount</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit_plan_id" name="plan_id">
          
          <div class="form-group">
            <label>Plan Name</label>
            <input type="text" class="form-control" id="edit_plan_name" readonly>
          </div>
          
          <div class="form-group">
            <label>Duration</label>
            <div class="input-group">
              <input type="number" class="form-control" id="edit_duration" readonly>
              <div class="input-group-append">
                <span class="input-group-text">days</span>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="edit_amount">New Amount <span class="text-danger">*</span></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">₹</span>
              </div>
              <input type="number" class="form-control" id="edit_amount" name="amount" required min="1" step="0.01">
            </div>
            <small class="form-text text-muted">Enter the new amount for this subscription plan</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="update_amount" class="btn btn-primary">Update Amount</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function editPlan(planId, planName, currentAmount, duration) {
    document.getElementById('edit_plan_id').value = planId;
    document.getElementById('edit_plan_name').value = planName.charAt(0).toUpperCase() + planName.slice(1);
    document.getElementById('edit_duration').value = duration;
    document.getElementById('edit_amount').value = currentAmount;
    
    $('#editPlanModal').modal('show');
}
</script>

<?php if (isset($_GET['status'])): ?>
  <script>
    <?php if ($_GET['status'] == 'success'): ?>
      Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: 'Plan amount updated successfully.',
        confirmButtonColor: '#3085d6'
      });
    <?php elseif ($_GET['status'] == 'invalid'): ?>
      Swal.fire({
        icon: 'warning',
        title: 'Invalid Amount',
        text: 'Please enter a valid amount greater than 0.',
        confirmButtonColor: '#f39c12'
      });
    <?php elseif ($_GET['status'] == 'empty'): ?>
      Swal.fire({
        icon: 'info',
        title: 'Missing Info',
        text: 'Please enter an amount.',
        confirmButtonColor: '#3498db'
      });
    <?php elseif ($_GET['status'] == 'error'): ?>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Something went wrong while updating the plan amount.',
        confirmButtonColor: '#d33'
      });
    <?php endif; ?>
  </script>
<?php endif; ?>

<?php include('footer.php'); ?>
