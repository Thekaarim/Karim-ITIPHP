<!DOCTYPE html>
<html>
<head>
    <title>PHP Form Example</title>
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
    $error_messages = array();
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Validation for First Name
        $first_name = $_POST["first_name"];
        if (empty($first_name)) {
            $error_messages['first_name'] = "First Name is required.";
        }

        // Validation for Last Name
        $last_name = $_POST["last_name"];
        if (empty($last_name)) {
            $error_messages['last_name'] = "Last Name is required.";
        }

        // Validation for Address
        $address = $_POST["address"];
        if (empty($address)) {
            $error_messages['address'] = "Address is required.";
        }

        // Validation for Country
        $country = $_POST["country"];
        if (empty($country)) {
            $error_messages['country'] = "Country is required.";
        }

        // Validation for Gender
        $gender = $_POST["gender"];
        if (empty($gender)) {
            $error_messages['gender'] = "Gender is required.";
        }

        // Validation for Skills
        if (!isset($_POST["skills"]) || empty($_POST["skills"])) {
            $error_messages['skills'] = "At least one Skill must be selected.";
        }

        // Validation for Username
        $username = $_POST["username"];
        if (empty($username)) {
            $error_messages['username'] = "Username is required.";
        }

        // Validation for Password
        $password = $_POST["password"];
        if (empty($password)) {
            $error_messages['password'] = "Password is required.";
        }

        // Validation for Department
        $department = $_POST["department"];
        if (empty($department)) {
            $error_messages['department'] = "Department is required.";
        }

        // If no errors, save data to customers.txt
        if (empty($error_messages)) {
            $skills = isset($_POST["skills"]) ? implode(", ", $_POST["skills"]) : "";
            $security_code = $_POST["security_code"];

            if ($security_code === "Karim123") {
                // Data is valid, save to customers.txt
                $data = "$first_name,$last_name,$address,$country,$gender,$skills,$username,$password,$department\n";
                file_put_contents("customers.txt", $data, FILE_APPEND);
                header("Location: confirmation.php?first_name=$first_name&last_name=$last_name&address=$address&country=$country&gender=$gender&skills=$skills&username=$username&department=$department");
                exit();
            } else {
                $error_messages['security_code'] = "Invalid security code. Please try again.";
            }
        }
    }
    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" required value="<?php echo isset($first_name) ? $first_name : ''; ?>">
        <?php if (isset($error_messages['first_name'])) { echo "<span class='error-message'>{$error_messages['first_name']}</span>"; } ?>
        <br><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required value="<?php echo isset($last_name) ? $last_name : ''; ?>">
        <?php if (isset($error_messages['last_name'])) { echo "<span class='error-message'>{$error_messages['last_name']}</span>"; } ?>
        <br><br>

        <label for="address">Address:</label>
        <textarea name="address" rows="4" cols="50" required><?php echo isset($address) ? $address : ''; ?></textarea>
        <?php if (isset($error_messages['address'])) { echo "<span class='error-message'>{$error_messages['address']}</span>"; } ?>
        <br><br>

        <label for="country">Country:</label>
        <select name="country" required>
            <option value="">Select a Country</option>
            <option value="USA" <?php echo (isset($country) && $country === 'USA') ? 'selected' : ''; ?>>USA</option>
            <option value="Canada" <?php echo (isset($country) && $country === 'Canada') ? 'selected' : ''; ?>>Canada</option>
            <!-- Add more country options as needed -->
        </select>
        <?php if (isset($error_messages['country'])) { echo "<span class='error-message'>{$error_messages['country']}</span>"; } ?>
        <br><br>

        <label>Gender:</label>
        <input type="radio" name="gender" value="male" <?php echo (isset($gender) && $gender === 'male') ? 'checked' : ''; ?> required>Male
        <input type="radio" name="gender" value="female" <?php echo (isset($gender) && $gender === 'female') ? 'checked' : ''; ?> required>Female
        <?php if (isset($error_messages['gender'])) { echo "<br><span class='error-message'>{$error_messages['gender']}</span>"; } ?>
        <br><br>

        <label>Skills:</label>
        <input type="checkbox" name="skills[]" value="PHP" <?php echo (isset($skills) && strpos($skills, 'PHP') !== false) ? 'checked' : ''; ?>>PHP
        <input type="checkbox" name="skills[]" value="MySQL" <?php echo (isset($skills) && strpos($skills, 'MySQL') !== false) ? 'checked' : ''; ?>>MySQL
        <input type="checkbox" name="skills[]" value="JS" <?php echo (isset($skills) && strpos($skills, 'JS') !== false) ? 'checked' : ''; ?>>JS
        <input type="checkbox" name="skills[]" value="postgreeSQL" <?php echo (isset($skills) && strpos($skills, 'postgreeSQL') !== false) ? 'checked' : ''; ?>>PostgreSQL
        <?php if (isset($error_messages['skills'])) { echo "<br><span class='error-message'>{$error_messages['skills']}</span>"; } ?>
        <br><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required value="<?php echo isset($username) ? $username : ''; ?>">
        <?php if (isset($error_messages['username'])) { echo "<span class='error-message'>{$error_messages['username']}</span>"; } ?>
        <br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <?php if (isset($error_messages['password'])) { echo "<span class='error-message'>{$error_messages['password']}</span>"; } ?>
        <br><br>

        <label for="department">Department (open source):</label>
        <input type="text" name="department" required value="<?php echo isset($department) ? $department : ''; ?>">
        <?php if (isset($error_messages['department'])) { echo "<span class='error-message'>{$error_messages['department']}</span>"; } ?>
        <br><br>

        <label for="security_code">Insert the code in the box below:</label>
        <input type="text" name="security_code" required>
        <small>(Enter "Karim123" as the security code)</small>
        <?php
            if (isset($error_messages['security_code'])) {
                echo "<br><span class='error-message'>{$error_messages['security_code']}</span>";
            }
        ?>
        <br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
