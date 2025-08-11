<?php include("header.php"); ?>

<link rel="stylesheet" href="style.css">

<div class="container py-5">
    <h2 class="mb-4 text-center">Add New Project</h2>
    <div class="card shadow p-4">
        <form action="save_project.php" method="POST" enctype="multipart/form-data">
            <!-- Project Title -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Project Title</label>
                <input type="text" name="project_title" class="form-control" placeholder="Enter project title" required>
            </div>

            <!-- Project Description -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="project_description" class="form-control" rows="4" placeholder="Enter project details" required></textarea>
            </div>

            <!-- Upload Images -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Upload Images (3 only)</label>
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="file" name="image1" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="image2" class="form-control" accept="image/*" required>
                    </div>
                    <div class="col-md-4">
                        <input type="file" name="image3" class="form-control" accept="image/*" required>
                    </div>
                </div>
            </div>

            <!-- Submit -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">Submit Project</button>
            </div>
        </form>
    </div>
</div>

<?php include("footer.php"); ?>
