<?php include("header.php"); ?>

<style>
    /* Background image with cover and fixed positioning */
    body, html {
        height: 100%;
        margin: 0;
        font-family: "Segoe UI", sans-serif;
        position: relative;
        overflow-x: hidden;
        overflow: hidden;
    }

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

    /* White transparent overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: -1;
    }

        main {
            position: relative;
            padding: 30px 0 40px 0;   /* slightly reduced padding */
            height: 100vh;            /* fill viewport height */
            display: flex;
            justify-content: center;
            align-items: flex-start;  /* align top, allow scrolling */     /* enable vertical scroll inside main */
            -webkit-overflow-scrolling: touch; /* smooth scrolling on iOS */
        }

        .project-card {
            width: 90%;
            max-width: 700px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.07);
            padding: 36px 30px 40px 30px;
            margin-bottom: 30px;       /* spacing to prevent cutoff */
            box-sizing: border-box;
        }


    h2 {
        text-align: center;
        color: #3e3127;
        font-weight: 700;
        margin-bottom: 28px;
        font-size: 28px;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        color: #5a4a39;
    }

    input[type="text"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background-color: #fafafa;
        box-sizing: border-box;
        font-size: 15px;
        color: #3e3127;
        resize: vertical;
        transition: border-color 0.3s ease;
        font-family: "Segoe UI", sans-serif;
    }

    input[type="text"]:focus,
    textarea:focus,
    input[type="file"]:focus {
        border-color: #B78D65;
        outline: none;
        background-color: #fff;
    }

    .file-row {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .file-col {
        flex: 1;
        min-width: 30%;
    }

    button[type="submit"] {
        background: #B78D65;
        color: white;
        padding: 14px 0;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: background 0.3s ease;
        width: 100%;
        margin-top: 30px;
    }

    button[type="submit"]:hover {
        background: #a6784f;
    }

    @media (max-width: 600px) {
        .file-row {
            flex-direction: column;
        }
        .file-col {
            min-width: 100%;
        }
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
