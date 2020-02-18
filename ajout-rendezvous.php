<?php
    include_once 'head.php'
    ?>

<body>
    <?php
         include_once 'navbar.php';
      
        try {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n;charset=utf8', 'root', '');
        } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
        }
        $reponse = $bdd->query("SELECT id, lastname, firstname FROM patients ");
    ?>


    <h3 class="alert alert-info text-center" role="alert">Add new appointment</h3>
    <div class="col-12 pt-3 d-flex justify-content-center">
        <form method="POST">
            <label class="font-weight-bold" for="exampleFormControlSelect2">Select a patient</label>
            <select multiple class="form-control" name ="patientselect" id="exampleFormControlSelect2">
                <?php
            while ($donnees = $reponse->fetch()) {
            ?>
                <option value ="<?php echo $donnees['id']; ?>"><?php echo $donnees['lastname']." ".$donnees['firstname']; ?></option>

                <?php 
            }
            ?>
            </select>
            <div class="mt-5">
                <label class="font-weight-bold">Date RDV </label>
                <input type="date" name="date" />
                <label class="font-weight-bold">Heure RDV </label>
                <input type="time" name="heure" />
                <input class="bg-info" type="submit" name="appmt" value="Add appmt" />
            </div>
        </form>
    </div>

    <?php
if (isset($_POST['appmt']))
{
    $id = ($_POST['patientselect']);
    $jour = ($_POST['date']);
    $heure = ($_POST['heure']);

    if ($id AND $jour and $heure) 
    {
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO `appointments` (`dateHour`, `idPatients`)
        VALUES (:rdvhour, :id)";
        $req1 = $bdd->prepare($sql);
        $req1->execute(array('rdvhour' => $jour.' '.$heure, 'id' => $id,));
    
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

    // Oui oui c'est normal
    $reponse->closeCursor();

    include_once 'bootstrap.php';
?>
</body>