<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<div class="container mt-5">

    <h2 class="text-center mb-4" style="color:#667eea;">
        <i class="fas fa-list"></i> All Available Properties
    </h2>

    <div class="row">
        <?php
        // Fetch all available properties
        $query = "SELECT * FROM properties WHERE status='available' ORDER BY id DESC";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>

        <div class="col-md-4 mb-4">
            <div class="card shadow-lg border-0 card-hover">
                <img src="uploads/<?php echo $row['image']; ?>" 
                class="card-img-top" alt="Property Image" 
                style="height: 220px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="text-muted"><?php echo $row['description']; ?></p>

                    <p><i class="fas fa-map-marker-alt"></i> 
                        <?php echo $row['location']; ?>
                    </p>

                    <p class="fw-bold text-primary">
                        Price: $<?php echo $row['price']; ?>
                    </p>

                    <div class="d-flex justify-content-between">
                        <a href="inquiry.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-gradient-sm">
                           <i class="fas fa-envelope"></i> Inquire
                        </a>

                        <a href="purchase.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-success-sm">
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

</div>

<?php include 'includes/footer.php'; ?>
