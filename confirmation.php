<!DOCTYPE html>
<html>
<head>
    <title>Submission Confirmation</title>    
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
    if (isset($_GET['first_name']) && isset($_GET['last_name']) && isset($_GET['address']) && isset($_GET['country']) && isset($_GET['gender']) && isset($_GET['skills']) && isset($_GET['username']) && isset($_GET['department'])) {
        $first_name = $_GET["first_name"];
        $last_name = $_GET["last_name"];
        $address = $_GET["address"];
        $country = $_GET["country"];
        $gender = $_GET["gender"];
        $skills = $_GET["skills"];
        $username = $_GET["username"];
        $department = $_GET["department"];
    ?>
        <h2>Thank You, <?php echo ($gender === "male") ? "Mr." : "Miss"; ?> <?php echo $first_name . " " . $last_name; ?></h2>
        <p>Please review your information:</p>
        <p><strong>Name:</strong> <?php echo $first_name . " " . $last_name; ?></p>
        <p><strong>Address:</strong> <?php echo $address; ?></p>
        <p><strong>Your skills:</strong> <?php echo $skills; ?></p>
        <p><strong>Country:</strong> <?php echo $country; ?></p>
        <p><strong>Department:</strong> <?php echo $department; ?></p>
    <?php
    } else {
        echo "<h2>Form submission failed.</h2>";
    }
    ?>
</body>
</html>