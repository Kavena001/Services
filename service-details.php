<?php 
require_once 'config.php';
require_once 'db_functions.php';

// Get service ID from URL
$service_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch service from database
$service = getServiceById($service_id);

// Handle invalid service
if (!$service) {
    http_response_code(404);
    include('404.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($service['title']) ?> | Business Solutions</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= asset_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>">
                <img src="<?= asset_url('images/logo.png') ?>" alt="Logo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= asset_url('contact.php') ?>">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Service Details Content -->
    <section class="service-details py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="service-content">
                        <h2 class="mb-4"><?= htmlspecialchars($service['title']) ?></h2>
                        
                        <?php if (!empty($service['image_path'])): ?>
                        <img src="<?= asset_url('images/' . htmlspecialchars($service['image_path'])) ?>" 
                             alt="<?= htmlspecialchars($service['title']) ?>" 
                             class="img-fluid rounded mb-4">
                        <?php endif; ?>
                        
                        <div class="service-description">
                            <?= nl2br(htmlspecialchars($service['details'])) ?>
                        </div>
                        
                        <?php if (!empty($service['features'])): ?>
                        <h4 class="mt-4">Key Features</h4>
                        <ul>
                            <?php 
                            $features = explode(',', $service['features']);
                            foreach ($features as $feature): 
                                if (trim($feature)): ?>
                                <li><?= htmlspecialchars(trim($feature)) ?></li>
                                <?php endif;
                            endforeach; ?>
                        </ul>
                        <?php endif; ?>
                        
                        <a href="<?= asset_url('contact.php?service=' . urlencode($service['title'])) ?>" 
                           class="btn btn-primary mt-3">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer py-3 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?= date("Y") ?> Business Solutions. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-2">Privacy Policy</a>
                    <a href="#" class="text-white">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset_url('js/script.js') ?>"></script>
</body>
</html>