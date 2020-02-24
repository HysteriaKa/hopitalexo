<?php
    include_once 'head.php'
    ?>
        <?php
    include_once 'navbar.php'
    ?>
<body>
    <h3 class="alert alert-info text-center" role="alert">Add a new fuckin' patient</h3>
    <div class="col-12 pt-3 d-flex justify-content-center">
    <form  method="POST">
        <label class="font-weight-bold">Last Name: </label>
        <input type="text" name="lastname" value="" />
        <label class="font-weight-bold">First Name: </label>
        <input type="text" name="firstname"/>
        <label class="font-weight-bold">Birthdate: </label>
        <input type="date" name="birthdate" />
        <label class="font-weight-bold">Phone: </label>
        <input type="text" name="phone" />
        <label class="font-weight-bold">Mail: </label>
        <input type="mail" name="mail" />
        <input class="bg-info" type="submit" name="rec" value="Add patient" />
    </form>
</div>


<?php
try {
    // On se connecte à MySQL
    $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n;charset=utf8', 'root', '');
} catch (Exception $e) {

    die('Erreur : ' . $e->getMessage());
}


if (isset($_POST['rec']))
{
    $lastName = htmlspecialchars($_POST['lastname']);
    $firstName = htmlspecialchars($_POST['firstname']);
    $birthDate = ($_POST['birthdate']);
    $mail = htmlspecialchars($_POST['mail']);
    $phone = htmlspecialchars($_POST['phone']); 

    if ($lastName and $firstName and $birthDate and $mail and $phone)
    {
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`,`mail`, `phone` )
            VALUES (:lastname, :firstname , :birthdate , :mail, :phone)";
        $req1 = $bdd->prepare($sql);
        $req1->execute(array('lastname' => $lastName, 'firstname' => $firstName, 'birthdate' => $birthDate, 'mail' => $mail, 'phone' => $phone));
    } else
    {
        echo "Veuillez renseigner tous les champs !";
    }
}

?>
    <?php
    include_once 'bootstrap.php'
    ?>
</body>

