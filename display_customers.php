<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions {
            white-space: nowrap;
        }
        .actions a {
            margin-right: 5px;
            text-decoration: none;
        }
        .actions .delete {
            color: red;
        }
        .actions .edit {
            color: orange;
        }
    </style></head>
<body>
    <h2>Customer List</h2>
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th>Country</th>
            <th>Gender</th>
            <th>Skills</th>
            <th>Username</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        <?php
        if (file_exists("customers.txt")) {
            $lines = file("customers.txt");
            foreach ($lines as $line) {
                $customer = explode(",", $line);
                list($first_name, $last_name, $address, $country, $gender, $skills, $username, $password, $department) = $customer;
                echo "<tr>";
                echo "<td>$first_name</td>";
                echo "<td>$last_name</td>";
                echo "<td>$address</td>";
                echo "<td>$country</td>";
                echo "<td>$gender</td>";
                echo "<td>$skills</td>";
                echo "<td>$username</td>";
                echo "<td>$department</td>";
                echo "<td><a href='delete.php?line=" . urlencode($line) . "' style='color: red;'>Delete</a> | <a href='edit.php?line=" . urlencode($line) . "' style='color: orange;'>Edit</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No customer data found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
