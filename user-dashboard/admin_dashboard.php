
<?php
session_start();
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: ../signIn.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .dashboard {
            padding: 40px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
            margin-top: 40px;
        }
        .tile {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            font-size: 18px;
            color: #333;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .tile:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Welcome, Admin 👋</h1>
        <div class="grid">
            <div class="tile">Products</div>
            <div class="tile">Users</div>
            <div class="tile">Orders</div>
            <a href="grading_admin.php"><div class="tile">Inspection / Grading</div></a>
            <div class="tile">Harvest Batches</div>
            <a href="packaging_admin.php"><div class="tile">Packaging</div></a>
            <div class="tile">Transport Tracking</div>
            <div class="tile">Reports & Graphs</div>
            <div class="tile">Register New User</div>
        </div>
    </div>
</body>
</html>

