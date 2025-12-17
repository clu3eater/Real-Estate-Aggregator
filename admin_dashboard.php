<?php include 'includes/header.php'; ?>
<?php include 'includes/db.php'; ?>

<?php if ($_SESSION['role'] != 'admin') header('Location: index.php'); ?>

<h2>Admin Dashboard</h2>
<!-- Search Form -->
<form method="GET" class="mb-4">
    <input type="text" name="search" placeholder="Search by title or location" class="form-control">
    <button type="submit" class="btn btn-custom mt-2">Search</button>
</form>

<!-- Properties List -->
<table class="table">
    <thead><tr><th>Title</th><th>Actions</th></tr></thead>
    <tbody>
        <?php
        $search = $_GET['search'] ?? '';
        $query = "SELECT * FROM properties WHERE title LIKE '%$search%' OR location LIKE '%$search%'";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['title']}</td><td>
                <a href='edit_property.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                <a href='delete_property.php?id={$row['id']}' class='btn btn-sm btn-danger'>Delete</a>
            </td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>