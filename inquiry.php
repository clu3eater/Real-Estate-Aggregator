<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php
if (!isset($_SESSION['user_id'])) header('Location: login.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $property_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $message = $_POST['message'];
    $conn->query("INSERT INTO inquiries (property_id, user_id, message) VALUES ($property_id, $user_id, '$message')");
    $conn->query("UPDATE properties SET status='inquired' WHERE id=$property_id");
    header('Location: index.php');
}
?>

<h2>Send Inquiry</h2>
<form method="POST">
    <textarea name="message" class="form-control" placeholder="Your message" required></textarea>
    <button type="submit" class="btn btn-custom mt-2">Send</button>
</form>

<?php include 'includes/footer.php'; ?>