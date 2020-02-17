<?php
    include_once 'head.php'
    ?>

<body>

    <?php
    include_once 'navbar.php'
    ?>
    <?php
    try {
        // On se connecte à MySQL
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n;charset=utf8', 'root', '');
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    }
    ?>
    <?php
    $reponse = $bdd->query("SELECT lastname, firstname, birthdate, phone, mail FROM patients "); ?>
    <h2 class="alert alert-info text-center" role="alert"> Patients' List</h2>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Phone</th>
                <th scope="col">Mail</th>
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
                    <td><?php echo $donnees['phone']; ?></td>
                    <td><?php echo $donnees['mail']; ?></td>
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