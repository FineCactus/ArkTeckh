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

<!-- Image Slideshow Background -->
<div class="background-slideshow">
  <div class="slideshow-overlay"></div>
</div>

<!-- Centered Search Bar -->
<div class="container my-4 d-flex justify-content-center position-relative" style="z-index:10;">
    <div class="search-bar d-flex align-items-center p-2 shadow rounded-pill" style="max-width: 540px; width: 100%; background-color: rgba(255,255,255,0.85); backdrop-filter: saturate(180%) blur(20px);">
        <input type="text" placeholder="Where" class="form-control me-3" style="flex: 1; min-width: 90px; font-weight: 500; letter-spacing: 0.02em;">
        <input type="text" placeholder="Who" class="form-control me-3" style="flex: 1; min-width: 90px; font-weight: 500; letter-spacing: 0.02em;">
        <button class="btn btn-danger rounded-circle px-3 d-flex justify-content-center align-items-center" style="width: 46px; height: 46px; box-shadow: 0 4px 8px rgba(183,141,101,0.35); transition: background-color 0.3s ease;">
            <i class="fas fa-search" style="font-size: 1.2rem;"></i>
        </button>
    </div>
</div>

<!-- Projects Grid -->
<div class="container my-5 position-relative" style="z-index:10;">
    <div class="row g-4">
        <?php while($row = mysqli_fetch_assoc($res)) { ?>
        <div class="col-md-4">
            <div class="project-card shadow d-flex flex-column bg-white h-100 border border-transparent" style="cursor: pointer;">
                <div class="card-image-wrapper overflow-hidden">
                    <img src="../uploads/<?php echo $row['image1'] ?: 'default.png'; ?>" alt="Project Image" class="img-fluid w-100 h-100">
                </div>
                <div class="card-body d-flex flex-column flex-grow-1 gap-2 px-4 py-3">
                    <h5 class="card-title fw-semibold mb-1">
                        <?php echo htmlspecialchars($row['title'] ?: "Untitled Project"); ?>
                    </h5>
                    <div class="text-secondary small" style="line-height: 1.4;">
                        <p class="mb-1"><strong>Category:</strong> <?php echo htmlspecialchars($row['category_name'] ?: "N/A"); ?></p>
                        <p class="mb-1"><strong>District:</strong> <?php echo htmlspecialchars($row['district_name'] ?: "N/A"); ?></p>
                        <p class="mb-0"><strong>Location:</strong> <?php echo htmlspecialchars($row['location_name'] ?: "N/A"); ?></p>
                    </div>
                    <form action="customer_select_work.php" method="POST" class="mt-auto">
                        <input type="hidden" name="prev_work_id" value="<?php echo $row['prev_work_id']; ?>">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-semibold">
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
/* Background Slideshow */
.background-slideshow {
  position: fixed;
  top: 0; left: 0;
  width: 100vw;
  height: 100vh;
  z-index: -1;
  overflow: hidden;
}

.slideshow-overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(252, 252, 252, 0.5);
  pointer-events: none;
  z-index: 1;
}

.background-slideshow::before {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: url('img/project-1.jpg');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  animation: slideShow 9s linear infinite;
  z-index: 0;
  opacity: 1;
  transition: opacity 1s ease-in-out;
}

.background-slideshow::after {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: url('img/project-4.jpg');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  animation: slideShowAlt 9s linear infinite;
  z-index: 0;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}

@keyframes slideShow {
  0%, 33.333%, 100% { opacity: 1; }
  66.666% { opacity: 0; }
}

@keyframes slideShowAlt {
  0%, 33.333%, 100% { opacity: 0; }
  66.666% { opacity: 1; }
}

/* Project Card */
.project-card {
    cursor: pointer;
    border-radius: 20px;
    overflow: hidden;
    background: #fff;
    border: 1px solid rgba(183,141,101,0.2);
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
}

.project-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 24px 48px rgba(183,141,101,0.35);
    border-color: #B78D65;
}

.card-image-wrapper {
    max-height: 220px;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
}

.card-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease, filter 0.4s ease;
}

.project-card:hover img {
    transform: scale(1.1);
    filter: brightness(1.05);
}

.card-body {
    border-radius: 0 0 20px 20px;
    padding: 20px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2c2c2c;
}

.text-secondary p {
    margin-bottom: 4px;
    font-size: 0.9rem;
    color: #6b6b6b;
}

.btn-primary {
    background-color: #B78D65;
    border: none;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #B78D65;
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(183, 141, 101, 0.3);
}

/* Search Bar */
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
