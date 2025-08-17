<?php include("header.php"); ?>

<link href="css/projects.css" rel="stylesheet">
<style>
    
    .background-image {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background: url('img/project-1.jpg') no-repeat center center fixed;
        background-size: cover;
        z-index: -2;
    }

</style>

<div class="background-image"></div>
<div class="overlay"></div>

<main>
    <div class="project-card">
        <h2>Add New Project</h2>
        <form action="save_project.php" method="POST" enctype="multipart/form-data">
            <!-- Project Title -->
            <label for="project_title">Project Title</label>
            <input type="text" id="project_title" name="project_title" placeholder="Enter project title" required>

            <!-- Project Description -->
            <label for="project_description">Description</label>
            <textarea id="project_description" name="project_description" rows="5" placeholder="Enter project details" required></textarea>

            <!-- Upload Images -->
            <label>Upload Images (3 only)</label>
            <div class="file-row">
                <div class="file-col">
                    <input type="file" name="image1" accept="image/*" required>
                </div>
                <div class="file-col">
                    <input type="file" name="image2" accept="image/*" required>
                </div>
                <div class="file-col">
                    <input type="file" name="image3" accept="image/*" required>
                </div>
            </div>

            <!-- Submit -->
            <button type="submit">Submit Project</button>
        </form>
    </div>
</main>

<?php include("footer.php"); ?>
