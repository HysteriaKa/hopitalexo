<?php
include_once 'head.php'
?>
<?php
include_once 'navbar.php'
?>

<body>
    <?php

    $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $getid = $_GET['id'];

    $reponse = $bdd->query("SELECT * FROM patients WHERE id ='$getid'");
    $donnees = $reponse->fetch();
    ?>
    <h2 class="alert alert-info text-center" role="alert"> Patients' List</h2>

        <div class="col-12 pt-3 d-flex justify-content-center">
            <form method="POST">
                <label class="font-weight-bold pl-3 pr-3">Last Name: </label>
                <input type="text" name="lastname" value="<?php echo $donnees['lastname']; ?>" />
                <label class="font-weight-bold pl-3 pr-3">First Name: </label>
                <input type="text" name="firstname" value="<?php echo $donnees['firstname']; ?>" />
                <label class="font-weight-bold pl-3 pr-3">Birthdate: </label>
                <input type="date" name="birthdate" value="<?php echo $donnees['birthdate']; ?>" />
                <label class="font-weight-bold pl-3 pr-3">Phone: </label>
                <input type="text" name="phone" value="<?php echo $donnees['phone']; ?>" />
                <label class="font-weight-bold pl-3 pr-3">Mail: </label>
                <input type="mail" name="mail" value="<?php echo $donnees['mail']; ?>" />
                <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
                <input class="bg-info ml-3" type="submit" name="Modify" value="Modify" />
            </form>
        </div>

        <?php
if (isset($_POST['Modify']))
{
    $id = ($_POST['id']);
    $lastName = htmlspecialchars($_POST['lastname']);
    $firstName = htmlspecialchars($_POST['firstname']);
    $birthDate = ($_POST['birthdate']);
    $mail = htmlspecialchars($_POST['mail']);
    $phone = htmlspecialchars($_POST['phone']);

    if ($id AND $lastName and $firstName and $birthDate and $mail and $phone) 
    {
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`,`mail`, `phone` )
        // VALUES ('".$lastName."', '".$firstName."', '".$birthDate."', '".$mail."', '".$phone."')";
        $sql = "UPDATE `patients` SET `lastname`=:lastname, `firstname`=:firstname, `birthdate`=:birthdate,`mail`=:mail, `phone`=:phone WHERE id=:id";
        $req1 = $bdd->prepare($sql);
        $req1->execute(array('id' => $id, 'lastname' => $lastName, 'firstname' => $firstName, 'birthdate' => $birthDate, 'mail' => $mail, 'phone' => $phone));
    
    ?>
        <div class="text-center mt-5">
            <span class="badge badge-pill badge-success p-3">C'est cool</span>
        </div>
        <?php
    } else // Tous les renseignement ne sont pas remplis
    {
        echo "Veuillez renseigner tous les champs !";
    }
}
?>
        <?php
        $reponse->closeCursor();
        ?>

        <div class="jumbotron mw-85 mt-5 row d-flex justify-content-center">
            <h1 class="display-4">Appointments</h1>
            <hr class="my-4" />
            <?php
                $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $getid = $_GET['id']; //NON

                $sql = ("SELECT patients.id, DATE_FORMAT(dateHour, '%Y/%m/%d') AS daterdv, DATE_FORMAT(dateHour, '%Hh%imin%ss') AS timerdv  
                FROM patients JOIN appointments ON patients.id = appointments.idPatients WHERE patients.id =:getid");
                 $req1 = $bdd->prepare($sql);
                 $req1->execute(array('getid' => $getid));
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Hour</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while ($donnees = $reponse->fetch()) {
                ?>
                    <tr>
                        <td> <?php echo $donnees['daterdv']; ?></td>
                        <td><?php echo $donnees['timerdv']; ?></td>
                    </tr>
                <?php
                }
                $reponse->closeCursor();
                ?>
                </tbody>
            </table>

        </div>
</body>
<?php
include_once 'bootstrap.php'
?>