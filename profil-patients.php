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
    <table class="table table-striped table-dark">
        <tr>
            <td> <?php echo $donnees['lastname']; ?></td>
            <td><?php echo $donnees['firstname']; ?></td>
            <td><?php echo $donnees['birthdate']; ?></td>
            <td><?php echo $donnees['phone']; ?></td>
            <td><?php echo $donnees['mail']; ?></td>
        </tr>
        <?php
        $reponse->closeCursor();

        ?>
</body>
<?php
include_once 'bootstrap.php'
?>