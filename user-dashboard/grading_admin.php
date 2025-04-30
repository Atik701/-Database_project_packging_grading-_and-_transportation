
<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../signIn.php");
    exit();
}
include_once '../config-php-files/db_connection.php';
$conn = $con; // use correct connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $protein = $_POST['Protein_Content'];
    $nutrition = $_POST['Nutrition_Level'];
    $qco = $_POST['QCO_ID'];
    $size = $_POST['Size'];
    $shape = $_POST['Shape'];
    $color = $_POST['Color'];
    $moisture = $_POST['Moisture_Content'];
    $ripeness = $_POST['Ripeness_Level'];
    $defects = $_POST['Physical_Defects'];
    $batch = $_POST['BatchID'];

    $insert = "INSERT INTO grade (Protein_Content, Nutrition_Level, QCO_ID, Size, Shape, Color, Moisture_Content, Ripeness_Level, Physical_Defects, BatchID)
               VALUES ('$protein', '$nutrition', '$qco', '$size', '$shape', '$color', '$moisture', '$ripeness', '$defects', '$batch')";
    mysqli_query($conn, $insert);
}

// Fetch records again
$query = "SELECT * FROM grade";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grading - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 30px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #eee; }
        .btn { padding: 6px 12px; cursor: pointer; }
        .edit-btn { background: orange; color: white; }
        .delete-btn { background: red; color: white; }
        .add-btn { background: green; color: white; border: none; }
        form { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 30px; }
        input { padding: 6px; flex: 1; }
    </style>
</head>
<body>
    <h2>Grading Records (Admin View)</h2>
    <table>
        <tr>
            <th>Protein</th>
            <th>Nutrition</th>
            <th>QCO ID</th>
            <th>Size</th>
            <th>Shape</th>
            <th>Color</th>
            <th>Moisture</th>
            <th>Ripeness</th>
            <th>Defects</th>
            <th>Batch ID</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['Protein_Content'] ?></td>
            <td><?= $row['Nutrition_Level'] ?></td>
            <td><?= $row['QCO_ID'] ?></td>
            <td><?= $row['Size'] ?></td>
            <td><?= $row['Shape'] ?></td>
            <td><?= $row['Color'] ?></td>
            <td><?= $row['Moisture_Content'] ?></td>
            <td><?= $row['Ripeness_Level'] ?></td>
            <td><?= $row['Physical_Defects'] ?></td>
            <td><?= $row['BatchID'] ?></td>
            <td>
                <button class="btn edit-btn">Edit</button>
                <button class="btn delete-btn">Delete</button>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h3>Add New Grading Record</h3>
    <form method="POST">
        <input type="text" name="Protein_Content" placeholder="Protein Content" required>
        <input type="text" name="Nutrition_Level" placeholder="Nutrition Level" required>
        <input type="text" name="QCO_ID" placeholder="QCO ID" required>
        <input type="text" name="Size" placeholder="Size" required>
        <input type="text" name="Shape" placeholder="Shape" required>
        <input type="text" name="Color" placeholder="Color" required>
        <input type="text" name="Moisture_Content" placeholder="Moisture Content" required>
        <input type="text" name="Ripeness_Level" placeholder="Ripeness Level" required>
        <input type="text" name="Physical_Defects" placeholder="Physical Defects" required>
        <input type="text" name="BatchID" placeholder="Batch ID" required>
        <button type="submit" class="btn add-btn">Add</button>
    </form>
</body>
</html>
