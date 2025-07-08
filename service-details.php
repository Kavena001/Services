<?php 
require_once 'db_functions.php';

// Get service ID from URL
$service_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch service from database
$service = getServiceById($service_id);

// Handle invalid service
if (!$service) {
    header("HTTP/1.0 404 Not Found");
    include('404.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= htmlspecialchars($service['title']) ?> | Business Solutions</title>
    <!-- ... head content ... -->
</head>
<body>
    <!-- ... navigation ... -->

    <section class="service-details py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="service-content">
                        <h2 class="mb-4"><?= htmlspecialchars($service['title']) ?></h2>
                        
                        <?php if (!empty($service['image_path'])): ?>
                        <img src="images/<?= htmlspecialchars($service['image_path']) ?>" 
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
                            ?>
                                <li><?= htmlspecialchars(trim($feature)) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                        
                        <a href="contact.php?service=<?= urlencode($service['title']) ?>" 
                           class="btn btn-primary mt-3">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ... footer ... -->
</body>
</html>