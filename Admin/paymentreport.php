<?php 
include('./header.php');
include("../dboperation.php");

// Database connection
$database = new dboperation();

// Get filter parameters
$filter_month = $_GET['month'] ?? '';
$filter_plan = $_GET['plan'] ?? '';

// Debug mode - set to true to see debug information
$debug_mode = false;

if ($debug_mode) {
    echo "<div class='alert alert-info'>";
    echo "Debug Info:<br>";
    echo "Filter Month: " . ($filter_month ?: 'None') . "<br>";
    echo "Filter Plan: " . ($filter_plan ?: 'None') . "<br>";
    echo "</div>";
}

// Build filter conditions
$filter_conditions = "WHERE s.status = 'Paid'";

if ($filter_month) {
    $filter_conditions .= " AND DATE_FORMAT(s.regdate, '%Y-%m') = '$filter_month'";
}

if ($filter_plan) {
    $filter_conditions .= " AND s.plan_id = '$filter_plan'";
}

// Get premium subscription data with architect details and total amount
$premium_query = "SELECT 
    a.arch_name,
    a.email, 
    a.phone,
    p.plan_name,
    s.amount,
    s.status,
    s.regdate,
    s.renewaldate,
    a.arch_locations,
    s.payid
    FROM tbl_subscriptionplan s 
    JOIN tbl_architects a ON s.architect_id = a.architect_id 
    JOIN tbl_plan p ON s.plan_id = p.plan_id 
    $filter_conditions
    ORDER BY s.regdate DESC";

$premium_result = $database->executequery($premium_query);
$total_revenue = 0;
$premium_architects = [];

// Check if query executed successfully
if ($premium_result) {
    while ($premium_row = mysqli_fetch_array($premium_result)) {
        $premium_architects[] = $premium_row;
        $total_revenue += $premium_row['amount'];
    }
} else {
    // Handle query error
    echo "<div class='alert alert-danger'>Error executing query: " . mysqli_error($database->conn) . "</div>";
}

// Get available months for dropdown
$month_list = [];
$month_query = "SELECT DISTINCT DATE_FORMAT(regdate, '%Y-%m') as value, 
                DATE_FORMAT(regdate, '%M %Y') as display
                FROM tbl_subscriptionplan WHERE status = 'Paid' ORDER BY regdate DESC";
$month_result = $database->executequery($month_query);
if ($month_result) {
    while ($month_row = mysqli_fetch_array($month_result)) {
        $month_list[] = $month_row;
    }
}

// Get available plans for dropdown
$plan_list = [];
$plan_query = "SELECT plan_id, plan_name FROM tbl_plan ORDER BY plan_name";
$plan_result = $database->executequery($plan_query);
if ($plan_result) {
    while ($plan_row = mysqli_fetch_array($plan_result)) {
        $plan_list[] = $plan_row;
    }
}
?>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Payment Reports</h3>
                <h6 class="op-7 mb-2">Premium Subscription Payments and Revenue Analytics</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="report.php" class="btn btn-secondary btn-round me-2">
                    <i class="fas fa-chart-bar"></i> Main Reports
                </a>
                <a href="index.php" class="btn btn-primary btn-round">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">Payment Filters</h5>
                                <small class="text-muted">Filter payments by month and subscription plan</small>
                            </div>
                            <div class="col-md-6">
                                <form id="paymentFilterForm" method="GET" class="d-flex justify-content-end gap-2">
                                    <select name="month" class="form-control" style="max-width: 180px;" onchange="document.getElementById('paymentFilterForm').submit()">
                                        <option value="">All Months</option>
                                        <?php foreach ($month_list as $month_option): ?>
                                            <option value="<?php echo $month_option['value']; ?>" <?php if($filter_month == $month_option['value']) echo 'selected'; ?>>
                                                <?php echo $month_option['display']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <select name="plan" class="form-control" style="max-width: 150px;" onchange="document.getElementById('paymentFilterForm').submit()">
                                        <option value="">All Plans</option>
                                        <?php foreach ($plan_list as $plan_option): ?>
                                            <option value="<?php echo $plan_option['plan_id']; ?>" <?php if($filter_plan == $plan_option['plan_id']) echo 'selected'; ?>>
                                                <?php echo ucfirst($plan_option['plan_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button class="btn btn-outline-secondary" type="button" onclick="window.location.href='paymentreport.php'">
                                        Reset
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="numbers">
                            <p class="card-category">Total Revenue</p>
                            <h4 class="card-title">₹<?php echo number_format($total_revenue); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="numbers">
                            <p class="card-category">Total Payments</p>
                            <h4 class="card-title"><?php echo count($premium_architects); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="numbers">
                            <p class="card-category">Average Payment</p>
                            <h4 class="card-title">₹<?php echo count($premium_architects) > 0 ? number_format($total_revenue / count($premium_architects)) : '0'; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="numbers">
                            <p class="card-category">Active Subscribers</p>
                            <h4 class="card-title"><?php 
                                $active_count = 0;
                                foreach($premium_architects as $arch) {
                                    if(strtotime($arch['renewaldate']) > time()) {
                                        $active_count++;
                                    }
                                }
                                echo $active_count;
                            ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Details Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Premium Subscription Payments</h4>
                            <div class="card-tools">
                                <?php if (!empty($filter_month) || !empty($filter_plan)): ?>
                                    <span class="badge badge-info">
                                        <?php 
                                        $filter_text = [];
                                        if (!empty($filter_month)) {
                                            foreach ($month_list as $month_option) {
                                                if ($month_option['value'] == $filter_month) {
                                                    $filter_text[] = $month_option['display'];
                                                    break;
                                                }
                                            }
                                        }
                                        if (!empty($filter_plan)) {
                                            foreach ($plan_list as $plan_option) {
                                                if ($plan_option['plan_id'] == $filter_plan) {
                                                    $filter_text[] = ucfirst($plan_option['plan_name']) . ' Plan';
                                                    break;
                                                }
                                            }
                                        }
                                        echo implode(' | ', $filter_text);
                                        ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">All Payments</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="card-category mt-2">Complete list of premium subscription payments received</p>
                    </div>
                    <div class="card-body">
                        <?php if (count($premium_architects) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Payment ID</th>
                                        <th>Architect Name</th>
                                        <th>Location</th>
                                        <th>Plan Type</th>
                                        <th>Amount</th>
                                        <th>Payment Date</th>
                                        <th>Renewal Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($premium_architects as $architect): ?>
                                    <tr>
                                        <td>
                                            #<?php echo str_pad($architect['payid'], 4, '0', STR_PAD_LEFT); ?>
                                        </td>
                                        <td>
                                            <strong><?php echo htmlspecialchars($architect['arch_name']); ?></strong>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($architect['arch_locations']); ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">
                                                <?php echo ucfirst(htmlspecialchars($architect['plan_name'])); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <strong>₹<?php echo number_format($architect['amount']); ?></strong>
                                        </td>
                                        <td>
                                            <?php echo date('M d, Y', strtotime($architect['regdate'])); ?>
                                        </td>
                                        <td>
                                            <?php echo date('M d, Y', strtotime($architect['renewaldate'])); ?>
                                            <?php if(strtotime($architect['renewaldate']) > time()): ?>
                                                <small class="badge badge-success ms-1">Active</small>
                                            <?php else: ?>
                                                <small class="badge badge-danger ms-1">Expired</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Paid</span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Summary Footer -->
                        <div class="card-footer bg-light">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div>
                                        <strong><?php echo count($premium_architects); ?></strong><br>
                                        <small class="text-muted">Total Payments</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <strong>₹<?php echo number_format($total_revenue); ?></strong><br>
                                        <small class="text-muted">Total Revenue</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <strong><?php echo $active_count; ?></strong><br>
                                        <small class="text-muted">Active Subscribers</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <strong>₹<?php echo count($premium_architects) > 0 ? number_format($total_revenue / count($premium_architects)) : '0'; ?></strong><br>
                                        <small class="text-muted">Average Payment</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php else: ?>
                        <div class="text-center py-5">
                            <h5 class="text-muted">No Payment Records Found</h5>
                            <p class="text-muted">
                                <?php if (!empty($filter_month) || !empty($filter_plan)): ?>
                                    No payments found matching your filter criteria.
                                <?php else: ?>
                                    No premium subscription payments have been received yet.
                                <?php endif; ?>
                            </p>
                            <?php if (!empty($filter_month) || !empty($filter_plan)): ?>
                                <a href="paymentreport.php" class="btn btn-primary">View All Payments</a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
