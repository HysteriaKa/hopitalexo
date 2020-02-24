<?php
include_once 'head.php'
?>
<?php
include_once 'navbar.php'
?>

<body>

    <?php
    // Pagination variables
    $nPerPage = 5;
    $page = 1;
    if (isset($_GET['page']) AND !empty($_GET['page'])) 
    {
        $page = $_GET['page'];
    }
    $offset = ($nPerPage * $page)-$nPerPage;

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
    if (isset($_GET['searchbarre']) AND !empty($_GET['searchbarre'])) 
    {
        $search=$_GET['searchbarre'];
        $sql = ("SELECT patients.id, lastname, firstname, birthdate, phone, mail FROM patients WHERE lastname LIKE :search or firstname LIKE :search " );
        $reponse = $bdd->prepare($sql);
        $reponse->execute(array('search' => $search.'%'));
    }else{
        $reponse = $bdd->prepare("SELECT patients.id, lastname, firstname, birthdate, phone, mail FROM patients LIMIT :lim OFFSET :offs"); 
        $reponse->bindValue('lim', $nPerPage, PDO::PARAM_INT);
        $reponse->bindValue('offs', $offset, PDO::PARAM_INT);
        $reponse->execute();
    }
    $countStatement = $bdd->query("SELECT COUNT(*) FROM patients"); 
    $count = $countStatement->fetch();
    $nbpages = ceil(intval($count[0]) / $nPerPage);
    ?>
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
                <td><a href="profil-patients.php?id=<?php echo $donnees['id'] ?>"><i
                            class="fas fa-folder-plus text-warning"></i></a></td>
                <td><a href="liste-patients.php?delete_id=<?php echo $donnees['id'] ?>"><i
                            class="far fa-trash-alt text-danger"></i></a></td>
            </tr>
        </tbody>

        <?php
        }
        $reponse->closeCursor();
            ?>
    </table>

    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
        <ul class="pagination">
            <?php

            
       for($i=1;$i<=$nbpages; $i++)  {
        ?>
            <li class="page-item"><a class="page-link" href="liste-patients.php?page=<?= $i ?>"><?= $i ?></a></li>
        <?php    
        }
        ?>
        </ul>
    </nav>
    <?php
            include_once 'bootstrap.php'
            ?>
</body>
<?php
include_once 'footer.php';
?>
</html>