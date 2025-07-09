<?php
require_once __DIR__ . '/includes/auth.php';

if (!is_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

// Get stats from database
global $pdo;
$services_count = $pdo->query("SELECT COUNT(*) FROM services")->fetchColumn();
$contacts_count = $pdo->query("SELECT COUNT(*) FROM contacts")->fetchColumn();
$recent_contacts = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">
                            <i class="bi bi-list-ul me-2"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacts.php">
                            <i class="bi bi-envelope me-2"></i> Contacts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Services</h5>
                            <h2 class="card-text"><?= $services_count ?></h2>
                            <a href="services.php" class="text-white">Manage services</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Contact Submissions</h5>
                            <h2 class="card-text"><?= $contacts_count ?></h2>
                            <a href="contacts.php" class="text-white">View submissions</a>
                        </div>
                    </div>
                </div>
            </div>

            <h4>Recent Contact Submissions</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_contacts as $contact): ?>
                        <tr>
                            <td><?= htmlspecialchars($contact['id']) ?></td>
                            <td><?= htmlspecialchars($contact['first_name'] . ' ' . $contact['last_name']) ?></td>
                            <td><?= htmlspecialchars($contact['email']) ?></td>
                            <td><?= htmlspecialchars($contact['subject']) ?></td>
                            <td><?= date('M j, Y', strtotime($contact['created_at'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>