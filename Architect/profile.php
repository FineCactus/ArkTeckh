<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($architect['name']) ?> - Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .profile-header {
            background: linear-gradient(to right, #0066cc, #00bfff);
            color: white;
            padding: 30px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .profile-pic {
            width: 130px; height: 130px;
            object-fit: cover;
            border: 4px solid white;
            border-radius: 50%;
            margin-top: -65px;
            background-color: #fff;
        }
        .skill-bar {
            height: 8px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
        }
        .skill-fill {
            height: 100%;
            background-color: #0066cc;
        }
        .project-card img {
            border-radius: 10px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

<div class="container my-5">

    <!-- Profile Header -->
    <div class="profile-header shadow">
        <h2><?= htmlspecialchars($architect['name']) ?></h2>
        <p><?= htmlspecialchars($architect['location']) ?></p>
    </div>

    <!-- Profile Picture & Info -->
    <div class="card shadow">
        <div class="card-body text-center">
            <img src="<?= htmlspecialchars($architect['profile_pic']) ?>" alt="Profile Picture" class="profile-pic shadow">
            <h4 class="mt-3"><?= htmlspecialchars($architect['name']) ?></h4>
            <p class="text-muted"><?= htmlspecialchars($architect['bio']) ?></p>

            <div class="mt-3">
                <p><i class="fas fa-envelope text-primary me-2"></i><?= htmlspecialchars($architect['email']) ?></p>
                <p><i class="fas fa-phone text-primary me-2"></i><?= htmlspecialchars($architect['phone']) ?></p>
            </div>
        </div>
    </div>

    <!-- Skills Section -->
    <?php if ($skills->num_rows > 0): ?>
    <div class="card shadow mt-4">
        <div class="card-body">
            <h5 class="mb-3"><i class="fas fa-lightbulb me-2"></i>Skills</h5>
            <?php while($skill = $skills->fetch_assoc()): ?>
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span><?= htmlspecialchars($skill['skill_name']) ?></span>
                        <span><?= (int)$skill['skill_level'] ?>%</span>
                    </div>
                    <div class="skill-bar">
                        <div class="skill-fill" style="width: <?= (int)$skill['skill_level'] ?>%;"></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Projects Section -->
    <?php if ($projects->num_rows > 0): ?>
    <div class="card shadow mt-4">
        <div class="card-body">
            <h5 class="mb-3"><i class="fas fa-briefcase me-2"></i>Projects</h5>
            <div class="row g-3">
                <?php while($project = $projects->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card project-card shadow-sm">
                            <img src="<?= htmlspecialchars($project['project_image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($project['project_title']) ?>">
                            <div class="card-body">
                                <h6 class="card-title"><?= htmlspecialchars($project['project_title']) ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
