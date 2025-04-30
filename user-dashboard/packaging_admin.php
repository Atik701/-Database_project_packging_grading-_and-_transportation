
<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../signIn.php");
    exit();
}
include_once '../config-php-files/db_connection.php';
$conn = $con;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $batchID = $_POST['BatchID'];
    $packedDate = $_POST['PackedDate'];
    $packagingStaffID = $_POST['PackagingStaffID'];

    $insert = "INSERT INTO package (BatchID, PackedDate, PackagingStaffID)
               VALUES ('$batchID', '$packedDate', '$packagingStaffID')";
    mysqli_query($conn, $insert);
}

$query = "SELECT * FROM package";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Packaging - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f9f9f9; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 30px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #eee; }
        .btn { padding: 6px 12px; cursor: pointer; }
        .add-btn { background: green; color: white; border: none; }
        form { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 30px; }
        input { padding: 6px; flex: 1; }
    </style>
</head>
<body>
    <h2>Packaging Records</h2>
    <table>
        <tr>
            <th>Package ID</th>
            <th>Batch ID</th>
            <th>Packed Date</th>
            <th>Staff ID</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['PackageID'] ?></td>
            <td><?= $row['BatchID'] ?></td>
            <td><?= $row['PackedDate'] ?></td>
            <td><?= $row['PackagingStaffID'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <h3>Add New Package</h3>
    <form method="POST">
        <input type="text" name="BatchID" placeholder="Batch ID" required>
        <input type="date" name="PackedDate" required>
        <input type="text" name="PackagingStaffID" placeholder="Staff ID" required>
        <button type="submit" class="btn add-btn">Add</button>
    </form>
</body>
</html>
