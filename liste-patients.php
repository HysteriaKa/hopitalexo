<?php
include_once 'head.php'
?>
<?php
include_once 'navbar.php'
?>
<body>

    <?php
    try {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n;charset=utf8', 'root', '');
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }

    // Check Delete
    if(isset($_GET['delete_id'])){
        $getid = $_GET['delete_id'];

        $reponse = $bdd->prepare("DELETE appointments, patients FROM appointments LEFT JOIN patients ON patients.id=appointments.idPatients
        WHERE patients.id=:getid ");
        $donnees = $reponse->execute([ 'getid' => $getid]);
    }
    ?>

    <?php
    $reponse = $bdd->query("SELECT patients.id, lastname, firstname, birthdate, phone, mail FROM patients "); ?>
    <h2 class="alert alert-info text-center" role="alert"> Patients' List</h2>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Details</th>
                <th scope="col">Delete</th>

            </tr>
        </thead>
        <?php
        while ($donnees = $reponse->fetch()) {
        ?>
            <tbody>
                <tr>
                    <td> <?php echo $donnees['lastname']; ?></td>
                    <td><?php echo $donnees['firstname']; ?></td>
                    <td><?php echo $donnees['birthdate']; ?></td>
                    <td><a href="profil-patients.php?id=<?php echo $donnees['id'] ?>"><i class="fas fa-folder-plus text-warning"></i></a></td>
                    <td><a href="liste-patients.php?delete_id=<?php echo $donnees['id'] ?>"><i
                            class="far fa-trash-alt text-danger"></i></a></td>
                </tr>
            <?php
        }

        $reponse->closeCursor();

            ?>
            <?php
            include_once 'bootstrap.php'
            ?>
</body>

</html>