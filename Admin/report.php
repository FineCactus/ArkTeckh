<?php 
include('./header.php');
include("../dboperation.php");

// Database connection
$database = new dboperation();
$filter_month = $_GET['month'] ?? '';

// Debug: Check if filter is working (remove this later)
// echo "Debug: Filter month = '" . $filter_month . "'<br>";

// Dashboard card counts
$total_customers = 0;
$total_architects = 0;
$total_projects = 0;
$total_pending = 0;

// Count customers
$customer_query = "SELECT COUNT(*) as count FROM tbl_customer";
$customer_result = $database->executequery($customer_query);
$total_customers = mysqli_fetch_array($customer_result)['count'];

// Count architects
$architect_query = "SELECT COUNT(*) as count FROM tbl_architects";
$architect_result = $database->executequery($architect_query);
$total_architects = mysqli_fetch_array($architect_result)['count'];

// Count projects
$project_query = "SELECT COUNT(*) as count FROM tbl_previous_works";
$project_result = $database->executequery($project_query);
$total_projects = mysqli_fetch_array($project_result)['count'];

// Count pending architects
$pending_query = "SELECT COUNT(*) as count FROM tbl_architects WHERE status = 'Pending' OR status = ''";
$pending_result = $database->executequery($pending_query);
$total_pending = mysqli_fetch_array($pending_result)['count'];

// Category data for charts
$category_list = [];
$pie_chart_data = [];
$bar_chart_data = [];

// Build month filter condition
$month_condition = "";
if ($filter_month) {
    $month_condition = "AND DATE_FORMAT(p.created_at, '%Y-%m') = '$filter_month'";
}

// Get category work counts
$category_query = "SELECT c.category_name, COUNT(p.prev_work_id) as work_count 
                   FROM tbl_category c 
                   LEFT JOIN tbl_previous_works p ON c.category_id = p.category_id 
                   WHERE 1=1 $month_condition
                   GROUP BY c.category_id, c.category_name
                   ORDER BY work_count DESC";

$category_result = $database->executequery($category_query);
while ($category_row = mysqli_fetch_array($category_result)) {
    $category_list[] = $category_row;
    
    // Add to pie chart only if has works
    if ($category_row['work_count'] > 0) {
        $pie_chart_data[] = $category_row;
    }
}

// Bar chart uses all categories
$bar_chart_data = $category_list;

// Get available months for dropdown
$month_list = [];
$month_query = "SELECT DISTINCT DATE_FORMAT(created_at, '%Y-%m') as value, 
                DATE_FORMAT(created_at, '%M %Y') as display
                FROM tbl_previous_works ORDER BY created_at DESC";
$month_result = $database->executequery($month_query);
while ($month_row = mysqli_fetch_array($month_result)) {
    $month_list[] = $month_row;
}
?>
        <div class="container">
          <div class="page-inner">
            <div
              class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
            >
              <div>
                <h3 class="fw-bold mb-3">Reports</h3>
              </div>
              <div class="ms-md-auto py-2 py-md-0">
                <a href="index.php" class="btn btn-primary btn-round">Dashboard</a>
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
                          <h4 class="card-title"><?php echo $total_customers; ?></h4>
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
                          <h4 class="card-title"><?php echo $total_architects; ?></h4>
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
                          <h4 class="card-title"><?php echo $total_projects; ?></h4>
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
                          <h4 class="card-title"><?php echo $total_pending; ?></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Month Filter Section -->
            <div class="row mb-4">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-md-6">
                        <h5 class="mb-0">Works Analytics</h5>
                        <small class="text-muted">Filter by month to view detailed statistics</small>
                      </div>
                      <div class="col-md-6">
                        <form id="monthFilterForm" method="GET" class="d-flex justify-content-end">
                          <div class="input-group" style="max-width: 250px;">
                            <select name="month" class="form-control" onchange="document.getElementById('monthFilterForm').submit()">
                              <option value="">All Months</option>
                              <?php foreach ($month_list as $month_option): ?>
                                <option value="<?php echo $month_option['value']; ?>" <?php if($filter_month == $month_option['value']) echo 'selected'; ?>>
                                  <?php echo $month_option['display']; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" onclick="window.location.href='report.php'">
                                <i class="fa fa-refresh"></i>
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Charts Section -->
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Registered Users Distribution</div>
                  </div>
                  <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                      <canvas id="usersPieChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Works by Category</div>
                    <div class="card-category">
                      <?php if (!empty($filter_month)): ?>
                        <span class="badge badge-info">
                          <?php 
                            foreach ($month_list as $month_option) {
                              if ($month_option['value'] == $filter_month) {
                                echo $month_option['display'];
                                break;
                              }
                            }
                          ?>
                        </span>
                      <?php else: ?>
                        <span class="badge badge-secondary">All Time</span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                      <canvas id="categoryPieChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Works by Category</div>
                    <div class="card-category">
                      <?php if (!empty($filter_month)): ?>
                        <span class="badge badge-info">
                          <?php 
                            foreach ($month_list as $month_option) {
                              if ($month_option['value'] == $filter_month) {
                                echo $month_option['display'];
                                break;
                              }
                            }
                          ?>
                        </span>
                      <?php else: ?>
                        <span class="badge badge-secondary">All Time</span>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                      <canvas id="worksBarChart"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            

        <!-- Chart.js CDN -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <script>
        // Chart data and colors
        const colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF', '#4ECDC4', '#45B7D1', '#96CEB4'];
        
        // Users Distribution Chart
        new Chart(document.getElementById('usersPieChart'), {
            type: 'pie',
            data: {
                labels: ['Customers', 'Architects'],
                datasets: [{
                    data: [<?php echo $total_customers; ?>, <?php echo $total_architects; ?>],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true, text: 'Total: <?php echo $total_customers + $total_architects; ?> Users' }
                }
            }
        });

        // Category Pie Chart
        <?php 
        $chart1_labels = array_column($pie_chart_data, 'category_name');
        $chart1_values = array_column($pie_chart_data, 'work_count');
        $chart1_total = empty($pie_chart_data) ? 0 : array_sum($chart1_values);
        $chart1_title = empty($pie_chart_data) ? "No works found" : "Total: " . $chart1_total . " Works";
        ?>
        new Chart(document.getElementById('categoryPieChart'), {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($chart1_labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($chart1_values); ?>,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true, text: '<?php echo $chart1_title; ?>' }
                }
            }
        });

        // Category Bar Chart
        <?php 
        $chart2_labels = array_column($bar_chart_data, 'category_name');
        $chart2_values = array_column($bar_chart_data, 'work_count');
        ?>
        new Chart(document.getElementById('worksBarChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($chart2_labels); ?>,
                datasets: [{
                    label: 'Works',
                    data: <?php echo json_encode($chart2_values); ?>,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                    borderColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } },
                plugins: {
                    legend: { display: false },
                    title: { display: true, text: 'Works Distribution by Category' }
                }
            }
        });
        </script>

        <?php include('footer.php');?>