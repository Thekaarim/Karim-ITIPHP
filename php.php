<!DOCTYPE html>
<html>
<head>
    <title>PHP Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <?php
    $error_message = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $address = $_POST["address"];
        $country = $_POST["country"];
        $gender = $_POST["gender"];
        $skills = isset($_POST["skills"]) ? implode(", ", $_POST["skills"]) : "";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $department = $_POST["department"];
        $security_code = $_POST["security_code"];

        if ($security_code !== "Karim123") {
            $error_message = "Invalid security code. Please try again.";
        } else {
            header("Location: confirmation.php?first_name=$first_name&last_name=$last_name&address=$address&country=$country&gender=$gender&skills=$skills&username=$username&department=$department");
            exit();
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required value="<?php echo isset($first_name) ? $first_name : ''; ?>"><br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required value="<?php echo isset($last_name) ? $last_name : ''; ?>"><br><br>

        <label for="address">Address:</label>
        <textarea name="address" rows="4" cols="50" required><?php echo isset($address) ? $address : ''; ?></textarea><br><br>

        <label for="country">Country:</label>
        <select name="country" required>
            <option value="USA" <?php echo (isset($country) && $country === 'USA') ? 'selected' : ''; ?>>USA</option>
            <option value="Canada" <?php echo (isset($country) && $country === 'Canada') ? 'selected' : ''; ?>>Canada</option>
        </select><br><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="male" <?php echo (isset($gender) && $gender === 'male') ? 'checked' : ''; ?> required>Male
        <input type="radio" name="gender" value="female" <?php echo (isset($gender) && $gender === 'female') ? 'checked' : ''; ?> required>Female<br><br>

        <label>Skills:</label>
        <input type="checkbox" name="skills[]" value="PHP" <?php echo (isset($skills) && strpos($skills, 'PHP') !== false) ? 'checked' : ''; ?>>PHP
        <input type="checkbox" name="skills[]" value="MySQL" <?php echo (isset($skills) && strpos($skills, 'MySQL') !== false) ? 'checked' : ''; ?>>MySQL
        <input type="checkbox" name="skills[]" value="JS" <?php echo (isset($skills) && strpos($skills, 'JS') !== false) ? 'checked' : ''; ?>>JS
        <input type="checkbox" name="skills[]" value="postgreeSQL" <?php echo (isset($skills) && strpos($skills, 'postgreeSQL') !== false) ? 'checked' : ''; ?>>PostgreSQL<br><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required value="<?php echo isset($username) ? $username : ''; ?>"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="department">Department:</label>
        <input type="text" name="department" required value="<?php echo isset($department) ? $department : ''; ?>"><br><br>

        <label for="security_code">Insert the code in the box below:</label>
        <input type="text" name="security_code" required><br>
        <small>(Enter "Karim123" as the security code)</small>
        <?php
            if ($error_message !== "") {
                echo "<br><span style='color: red;'>$error_message</span>";
            }
        ?>
        <br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>