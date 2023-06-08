<?php require_once "db.php"?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div><a href="export.php">Export Excel</a><a href="pdf.php" target="_blank">Export PDF</a></div>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>address</th>
        <th>age</th>
        <th>salary</th>
        <th>email</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $result = $db_connection->query("SELECT * FROM customer");
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['address'] ?></td>
            <td><?php echo $row['age'] ?></td>
            <td><?php echo $row['salary'] ?></td>
            <td><?php echo $row['email'] ?></td>
        </tr>

    <?php }
    ?>
    </tbody>
</table>

</body>
</html>