<?php include('header.php'); ?>
<link href="css/booking.css" rel="stylesheet">
<?php
include_once("../dboperation.php");
$obj = new dboperation();
// Fetch all previous works
$sql = "SELECT pw.*, c.category_name, l.location_name, d.district_name 
        FROM tbl_previous_works pw
        LEFT JOIN tbl_category c ON pw.category_id = c.category_id
        LEFT JOIN tbl_location l ON pw.location_id = l.location_id
        LEFT JOIN tbl_district d ON l.district_id = d.district_id
        ORDER BY pw.created_at DESC";
$res = $obj->executequery($sql);
?>
<!-- Centered Search Bar -->
<div class="container my-4 d-flex justify-content-center">
    <div class="search-bar d-flex align-items-center p-2 shadow rounded-pill" style="max-width: 540px; width: 100%;">
        <input type="text" placeholder="Where" class="form-control me-3" style="flex: 1; min-width: 90px; font-weight: 500; letter-spacing: 0.02em;">
        <input type="text" placeholder="Who" class="form-control me-3" style="flex: 1; min-width: 90px; font-weight: 500; letter-spacing: 0.02em;">
        <button class="btn btn-danger rounded-circle px-3 d-flex justify-content-center align-items-center" style="width: 46px; height: 46px; box-shadow: 0 4px 8px rgba(183,141,101,0.35); transition: background-color 0.3s ease;">
            <i class="fas fa-search" style="font-size: 1.2rem;"></i>
        </button>
    </div>
</div>

<!-- Projects Grid -->
<div class="container my-5">
    <div class="row g-4">
        <?php while($row = mysqli_fetch_assoc($res)) { ?>
        <div class="col-md-4">
            <div class="project-card shadow-sm rounded overflow-hidden h-100 position-relative bg-white" style="transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer;">
                <img src="../uploads/<?php echo $row['image1'] ?: 'default.png'; ?>" alt="Project Image" class="card-img-top img-fluid" style="height: 200px; object-fit: cover; width: 100%; transition: transform 0.3s ease;">
                <div class="card-body d-flex flex-column justify-content-between px-4 py-3">
                    <h5 class="card-title fw-semibold" style="font-size: 1.15rem; letter-spacing: 0.02em; color: #2c2c2c;">
                        <?php echo htmlspecialchars($row['title'] ?: "Untitled Project"); ?>
                    </h5>
                    <div class="mb-3 text-secondary" style="font-size: 0.9rem; line-height: 1.35;">
                        <p class="mb-1"><strong>Category:</strong> <?php echo htmlspecialchars($row['category_name'] ?: "N/A"); ?></p>
                        <p class="mb-1"><strong>District:</strong> <?php echo htmlspecialchars($row['district_name'] ?: "N/A"); ?></p>
                        <p class="mb-0"><strong>Location:</strong> <?php echo htmlspecialchars($row['location_name'] ?: "N/A"); ?></p>
                    </div>
                    <form action="customer_select_work.php" method="POST" class="mt-auto">
                        <input type="hidden" name="prev_work_id" value="<?php echo $row['prev_work_id']; ?>">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold" style="background-color: #B78D65; border: none; transition: background-color 0.3s;">
                            Book Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<style>
.project-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 28px rgba(183, 141, 101, 0.35);
}
.project-card:hover img {
    transform: scale(1.05);
}
.search-bar input {
    border: none;
    border-radius: 50px;
    padding: 10px 18px;
    outline: none;
    font-size: 1rem;
    color: #484848;
    font-weight: 500;
    background-color: #fafafa;
    transition: background-color 0.3s ease;
}

.search-bar input:focus {
    background-color: #fff;
    box-shadow: 0 0 8px rgba(183, 141, 101, 0.5);
}

.search-bar button:hover {
    background-color: #a55e51;
}

@media (max-width: 576px) {
    .search-bar {
        flex-direction: column !important;
        gap: 12px;
        padding: 1rem 1.5rem !important;
        max-width: 100% !important;
    }
    .search-bar input {
        margin-right: 0 !important;
        width: 100% !important;
        min-width: auto !important;
    }
    .search-bar button {
        width: 100% !important;
        height: 45px !important;
    }
}
</style>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<?php include('footer.php'); ?>
