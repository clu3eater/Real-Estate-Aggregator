<?php
include 'includes/header.php';
include 'includes/db.php';
//session_start();

// Search feature (safe)
$search = $_GET['search'] ?? '';
$search = $conn->real_escape_string($search);
?>

<!-- Hero Section -->
<div class="hero-section text-center py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <div class="container">
        <h1 class="display-4"><i class="fas fa-home"></i> Welcome to Real Estate Aggregator</h1>
        <p class="lead">Find your dream property or list yours today!</p>
        
        <a href="add_property.php" class="btn btn-gradient btn-lg"><i class="fas fa-plus"></i> Add Property</a>
        <a href="view_properties.php" class="btn btn-outline-light btn-lg ms-3"><i class="fas fa-list"></i> View All</a>
    </div>
</div>

<div class="container mt-5">
    
    <!-- Search Bar -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <form method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2"
                       placeholder="Search by title or location..."
                       value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-gradient"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>

    <!-- Available Properties -->
    <h2 class="text-center mb-4" style="color: #667eea;">
        <i class="fas fa-building"></i> Available Properties
    </h2>

    <div class="row">

        <?php
        // Fetch all available properties
        $query = "
            SELECT * FROM properties 
            WHERE status='available' 
            AND (title LIKE '%$search%' OR location LIKE '%$search%')
        ";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 card-hover">
                <img src="uploads/<?php echo $row['image']; ?>" 
                     class="card-img-top" style="height: 200px; object-fit: cover;">
                
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text text-muted"><?php echo $row['description']; ?></p>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $row['location']; ?></p>
                    <p class="fw-bold text-primary">Price: $<?php echo $row['price']; ?></p>

                    <div class="d-flex justify-content-between">
                        <a href="inquiry.php?id=<?php echo $row['id']; ?>" class="btn btn-gradient-sm">
                            <i class="fas fa-envelope"></i> Inquire
                        </a>
                        <a href="purchase.php?id=<?php echo $row['id']; ?>" class="btn btn-success-sm">
                            <i class="fas fa-shopping-cart"></i> Purchase
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php
            endwhile;
        else:
            echo "<p class='text-center'>No available properties found.</p>";
        endif;
        ?>
    </div>

    <!-- If user is logged in, show inquired + purchased sections -->
    <?php if (isset($_SESSION['user_id'])):
        $user_id = $_SESSION['user_id'];
    ?>

    <!-- Inquired Properties -->
    <hr class="my-5">
    <h2 class="text-center mb-4" style="color: #28a745;">
        <i class="fas fa-question-circle"></i> Your Inquired Properties
    </h2>
    <div class="row">
        <?php
        $inq = "
            SELECT p.* FROM properties p
            JOIN inquiries i ON p.id = i.property_id
            WHERE i.user_id = $user_id
        ";
        $inq_res = $conn->query($inq);

        if ($inq_res && $inq_res->num_rows > 0):
            while ($row = $inq_res->fetch_assoc()):
        ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 card-hover">
                <img src="uploads/<?php echo $row['image']; ?>" 
                     class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5><?php echo $row['title']; ?></h5>
                    <p class="text-muted"><?php echo $row['location']; ?></p>
                    <span class="badge bg-warning">Inquired</span>
                </div>
            </div>
        </div>

        <?php endwhile; else: ?>
            <p class="text-center">No inquired properties.</p>
        <?php endif; ?>
    </div>

    <!-- Purchased Properties -->
    <hr class="my-5">
    <h2 class="text-center mb-4" style="color: #dc3545;">
        <i class="fas fa-check-circle"></i> Your Purchased Properties
    </h2>
    <div class="row">
        <?php
        $pur = "
            SELECT p.* FROM properties p
            JOIN purchases pu ON p.id = pu.property_id
            WHERE pu.user_id = $user_id
        ";
        $pur_res = $conn->query($pur);

        if ($pur_res && $pur_res->num_rows > 0):
            while ($row = $pur_res->fetch_assoc()):
        ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 card-hover">
                <img src="uploads/<?php echo $row['image']; ?>" 
                     class="card-img-top" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5><?php echo $row['title']; ?></h5>
                    <p class="text-muted"><?php echo $row['location']; ?></p>
                    <span class="badge bg-success">Purchased</span>
                </div>
            </div>
        </div>

        <?php endwhile; else: ?>
            <p class="text-center">No purchased properties.</p>
        <?php endif; ?>
    </div>

    <?php endif; ?>

    <!-- Call to Action -->
    <div class="text-center mt-5 py-4" 
         style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color:white; border-radius:10px;">
        
        <h3>Ready to Find Your Perfect Home?</h3>
        <p>Explore more properties or contact us for assistance.</p>
        <a href="view_properties.php" class="btn btn-light btn-lg">
            <i class="fas fa-arrow-right"></i> Explore More
        </a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
