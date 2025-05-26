<?php
require_once('src/leerlingen.php');
$leerlingen = new leerlingen();

$firstName = '';
$lastName = '';
$email = '';
$password = '';
$class = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $leerling = $leerlingen->getLeerlingById($id);

    if ($leerling) {
        $firstName = $leerling['firstName'];
        $lastName = $leerling['lastName'];
        $email = $leerling['email'];
        $password = $leerling['password'];
        $class = $leerling['class'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <a href="index.html"><button class="HeaderButton">spel</button></a>
        <a href="register.php"><button class="HeaderButton">register</button></a>
    </div>
    <?php $allLeerlingen = $leerlingen->getAllLeerlingen();
        foreach ($allLeerlingen as $leerling) { ?>
            <tr>
                <td>
                    <?php echo $leerling['firstName']; ?>
                </td>
                <td>
                    <?php echo $leerling['lastName']; ?>
                </td>
                <td>
                    <?php echo $leerling['email']; ?>
                </td>
                <td>
                    <?php echo $leerling['class']; ?>
                </td>
                <td>

                    <a href="index.php?edit=<?php echo $leerling['id']; ?>" class="edit_btn">Edit</a>
                </td>
                <td>
                    <a href="server.php?del=<?php echo $leerling['id']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
            <br>
        <?php } ?>

    <section class="register_card">
        <form action="server.php" method="post">
            <input type="hidden" name="id">
            <div class="input_group">
                 <label>Voornaam</label>
                <input type="text" name="firstName">
            </div>
            <div class="input_group">
                 <label>Achternaam</label>
                <input type="text" name="lastName">
            </div>
            <div class="input_group">
                 <label>Email</label>
                <input type="email" name="email">
            </div>
            <div class="input_group">
                 <label>Wachtwoord</label>
                <input type="password" name="password">
            </div>
            <div class="input_group">
                 <label>klas</label>
                <input type="text" name="class">
            </div>
            <div class="input-group">
            <?php if (isset($update) && $update): ?>
                <button class="btn" type="submit" name="update" style="background: #556B2F;">update</button>
            <?php else: ?>
                <button class="btn" type="submit" name="save">Save</button>
            <?php endif ?>
        </div>
        </form>

    </section>
</body>
</html>