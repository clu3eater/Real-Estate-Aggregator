<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'includes/header.php';
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle purchase if property ID is provided
if (isset($_GET['id'])) {
    $property_id = (int)$_GET['id'];
    
    // Check if property exists and is available
    $stmt = $conn->prepare("SELECT id, status FROM properties WHERE id = ? AND status = 'available'");
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Check if already purchased by this user
        $stmt2 = $conn->prepare("SELECT id FROM purchases WHERE property_id = ? AND user_id = ?");
        $stmt2->bind_param("ii", $property_id, $user_id);
        $stmt2->execute();
        if ($stmt2->get_result()->num_rows == 0) {
            // Insert purchase and update property status
            $conn->query("INSERT INTO purchases (property_id, user_id) VALUES ($property_id, $user_id)");
            $conn->query("UPDATE properties SET status='purchased' WHERE id=$property_id");
            $success = "Property purchased successfully!";
        } else {
            $error = "You have already purchased this property.";
        }
        $stmt2->close();
    } else {
        $error = "Property not available for purchase.";
    }
    $stmt->close();
}
?>

<h2>Your Purchased Properties</h2>

<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<div class="row">
    <?php
    // Fetch purchased properties for the user
    $stmt = $conn->prepare("SELECT p.* FROM properties p JOIN purchases pu ON p.id = pu.property_id WHERE pu.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='col-md-4 mb-4'>
                    <div class='card'>
                        <img src='uploads/{$row['image']}' class='card-img-top' alt='Property'>
                        <div class='card-body'>
                            <h5>{$row['title']}</h5>
                            <p>{$row['description']}</p>
                            <p><strong>Price: \${$row['price']}</strong></p>
                            <p><em>Location: {$row['location']}</em></p>
                            <span class='badge bg-success'>Purchased</span>
                        </div>
                    </div>
                  </div>";
        }
    } else {
        echo "<p>You have not purchased any properties yet.</p>";
    }
    $stmt->close();
    ?>
</div>

<?php include 'includes/footer.php'; ?>