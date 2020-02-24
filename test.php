<?php
    try {
   
    $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n;charset=utf8', 'root', '');
    } catch (Exception $e) {

    die('Erreur : ' . $e->getMessage());
    }


    if (isset($_GET['searchbarre']) AND !empty($_GET['searchbarre'])) 
    {
        $_GET['searchbarre'] = htmlspecialchars($_GET['searchbarre']);
        $lastName = htmlspecialchars($_GET['lastname']);
        $firstName = htmlspecialchars($_GET['firstname']);
        $search=$_GET['searchbarre'];
       

        if ($search) {
            $sql = ("SELECT lastname, firstname FROM patients WHERE lastname or firstname LIKE ':search%' " );
            $req1 = $bdd->prepare($sql);
            $req1->execute(array('search' => $search));
        
            while($search = $sql->fetch()) { ?>
                <p><?php echo $req1['lastname']; ?></p>
            <?php
            }
        } else {
            echo "Veuillez renseigner tous les champs !";
        }
    };
    $reponse->closeCursor();
    include_once 'bootstrap.php'
?>