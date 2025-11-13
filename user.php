<?php
include "conn.php";

// Check login dan role admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php?page=login");
    exit();
}
?>

<style>
/* === General Styling === */
body {
    font-family: Arial, Helvetica, sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 1000px;
    margin: 40px auto;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Headings */
h2 {
    text-align: center;
    color: #444;
    margin-bottom: 30px;
}

/* Table styling */
.data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.data-table th, .data-table td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.data-table th {
    background: #007BFF;
    color: white;
    font-weight: bold;
}

.data-table tr:nth-child(even) {
    background: #f9f9f9;
}

.data-table tr:hover {
    background: #eaf2ff;
    transition: 0.3s;
}

/* Buttons */
.btn-edit,
.btn-delete {
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    transition: all 0.3s ease;
    cursor: pointer;
    display: inline-block;
}

.btn-edit {
    background: #ffc107;
    color: #000;
}

.btn-edit:hover {
    background: #e0a800;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.btn-delete:hover {
    background: #c82333;
}

/* Responsive */
@media (max-width: 768px) {
    .data-table th, .data-table td {
        padding: 10px 8px;
        font-size: 13px;
    }
}
</style>

<div class="container">
    <h2>User Management (Admin Only)</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM users ORDER BY id ASC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['role']}</td>
                        <td>
                            <a href='edit_user.php?id={$row['id']}' class='btn-edit'>Edit</a>
                            <a href='delete_user.php?id={$row['id']}' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align:center;'>No users found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
