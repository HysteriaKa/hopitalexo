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

    $reponse = $bdd->query("SELECT patients.id, lastname, firstname, phone, DATE_FORMAT(dateHour, '%Y-%m-%d') AS daterdv, DATE_FORMAT(dateHour, '%H:%i:%s') AS timerdv  FROM patients JOIN appointments ON patients.id = appointments.idPatients ");
    $donnees = $reponse->fetch();
    ?>
    <h2 class="alert alert-info text-center" role="alert">Details' appointment</h2>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Date</th>
                <th scope="col">Hour</th>
                <th scope="col">Modify</th>
            </tr>
        </thead>

        <div class="col-12 pt-3 d-flex justify-content-center">
            <form method="POST">
            <tbody>
                <tr>
                    <td> <?php echo $donnees['lastname']; ?></td>
                    <td><?php echo $donnees['firstname']; ?></td>
                    <td><?php echo $donnees['phone']; ?></td>
                    <td><label class="pr-3" for=""><?php echo $donnees['daterdv']; ?></label><input type="date" name="date" value="<?php echo $donnees['daterdv']; ?>" /></td>
                    <td><label class="pr-3" for=""><?php echo $donnees['timerdv']; ?></label><input type="time" name="time" value="<?php echo $donnees['timerdv']; ?>" /></td>
                    <td><input class="bg-info" type="submit" name="Modify" value="Modify" /></td>
                </tr>
                <input type="hidden" name="id" value="<?php echo $donnees['id']; ?>" />
            </form>
        </div>

        <?php
if (isset($_POST['Modify']))
{
    $id = ($_POST['id']);
    $daterdv = ($_POST['date']);
    $timerdv = ($_POST['time']);

    if ($id AND $daterdv AND $timerdv) 
    {
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE `appointments` SET `dateHour`=:datehour WHERE `id`=:id";
        $req1 = $bdd->prepare($sql);
        $req1->execute(array('datehour' => $daterdv.' '.$timerdv, 'id' => $id));
    
    ?>
    <div class="text-center mt-5">
    <span class="badge badge-pill badge-success p-3">C'est cool ! the appointment has been modified</span>
    </div>
    <?php
    } else // Tous les renseignement ne sont pas remplis
    {
        echo "Did you fill all inputs ?";
    }
}
?>
        <?php
        $reponse->closeCursor();
        ?>
</body>
<?php
include_once 'bootstrap.php'
?>

