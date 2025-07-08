<?php 
require_once 'db_functions.php';

// Get featured services from database
$services = getFeaturedServices();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... head content ... -->
</head>
<body>
    <!-- ... navigation and banner ... -->

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
                                <a href="service-details.php?id=<?= $service['id'] ?>" 
                                   class="btn btn-outline-primary">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- ... rest of page ... -->
</body>
</html>