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

        $reponse = $bdd->prepare("DELETE FROM appointments WHERE `id`=:id ");
        $donnees = $reponse->execute([ 'id' => $getid]);
    }

    // Create list
    $reponse = $bdd->query("SELECT appointments.id, lastname, firstname, phone, dateHour FROM patients 
    JOIN appointments ON patients.id = appointments.idPatients"); ?>
    <h2 class="alert alert-info text-center" role="alert">Appointments'list</h2>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">Last Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Date hour</th>
                <th scope="col">Modify</th>
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
                <td><?php echo $donnees['phone']; ?></td>
                <td><?php echo $donnees['dateHour']; ?></td>
                <td><a href="rendezvous.php?id=<?php echo $donnees['id'] ?>"><i
                            class="fas fa-exchange-alt text-primary"></i></a></td>
                <td><a href="liste-rendezvous.php?delete_id=<?php echo $donnees['id'] ?>"><i
                            class="far fa-trash-alt text-danger"></i></a></td>
            </tr>

            <?php
            
        
?>

            <?php
        }

        

        $reponse->closeCursor();

            ?>
            <?php
            include_once 'bootstrap.php'
            ?>

</body>