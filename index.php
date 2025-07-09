<?php 
require_once 'config.php';
require_once 'db_functions.php';

// Get featured services from database
$services = getFeaturedServices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Solutions | Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
                        <a class="nav-link active" href="<?= BASE_URL ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= asset_url('contact.php') ?>">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner (1/3 less than typical height) -->
    <div class="banner-container">
        <div class="banner-overlay"></div>
        <div class="banner-content text-center text-white">
            <h1 class="display-4">Your Business Growth Partners</h1>
            <p class="lead">Comprehensive solutions to help your business thrive</p>
        </div>
    </div>

    <!-- Services Section -->
    <section class="services py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Services</h2>
            <?php if (empty($services)): ?>
                <div class="alert alert-info text-center">
                    <p>Our services are currently being updated. Please check back soon!</p>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($services as $service): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow">
                            <div class="card-body text-center">
                                <div class="service-icon mb-3">
                                    <i class="bi <?= htmlspecialchars($service['icon_class']) ?> text-primary fs-1"></i>
                                </div>
                                <h3 class="card-title"><?= htmlspecialchars($service['title']) ?></h3>
                                <p class="card-text"><?= htmlspecialchars($service['description']) ?></p>
                                <a href="<?= asset_url('service-details.php?id=' . $service['id']) ?>" 
                                   class="btn btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer (half the typical height) -->
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= asset_url('js/script.js') ?>"></script>
</body>
</html>