<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) header('Location: login.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $location = $_POST['location'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/$image");
    $user_id = $_SESSION['user_id'];
    $conn->query("INSERT INTO properties (title, description, price, location, image, user_id) VALUES ('$title', '$description', '$price', '$location', '$image', '$user_id')");
    header('Location: index.php');
}
?>

<h2>Add Property</h2>
<form method="POST" enctype="multipart/form-data">
    <div class="mb-3"><input type="text" name="title" class="form-control" placeholder="Title" required></div>
    <div class="mb-3"><textarea name="description" class="form-control" placeholder="Description"></textarea></div>
    <div class="mb-3"><input type="number" name="price" class="form-control" placeholder="Price" required></div>
    <div class="mb-3"><input type="text" name="location" class="form-control" placeholder="Location" required></div>
    <div class="mb-3"><input type="file" name="image" class="form-control" required></div>
    <button type="submit" class="btn btn-custom">Add Property</button>
</form>

<?php include 'includes/footer.php'; ?>