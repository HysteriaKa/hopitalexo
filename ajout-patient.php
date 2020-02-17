<?php
    include_once 'head.php'
    ?>
        <?php
    include_once 'navbar.php'
    ?>
<body>
    <h3 class="alert alert-info text-center" role="alert">Add a new fuckin' patient</h3>
    <div class="col-12 pt-3 d-flex justify-content-center">
    <form action="requete.php" method="POST">
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
?>
    <?php
    include_once 'bootstrap.php'
    ?>
</body>

