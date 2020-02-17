
<?php
if (isset($_POST['rec'])) // Si on clique sur S'inscrire
{
    $lastName = htmlspecialchars($_POST['lastname']);
    $firstName = htmlspecialchars($_POST['firstname']);
    $birthDate = ($_POST['birthdate']);
    $mail = htmlspecialchars($_POST['mail']);
    $phone = htmlspecialchars($_POST['phone']); // Pas besoin de protéger un type="number"

    if ($lastName and $firstName and $birthDate and $mail and $phone) // On vérifie si elles existent
    {
        // On insère dans la BDD qui sera `inscription` et la table `user`
        $bdd = new PDO('mysql:host=localhost:3308;dbname=hospitale2n', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`,`mail`, `phone` )
        // VALUES ('".$lastName."', '".$firstName."', '".$birthDate."', '".$mail."', '".$phone."')";
        $sql = "INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`,`mail`, `phone` )
            VALUES (:lastname, :firstname , :birthdate , :mail, :phone)";
        $req1 = $bdd->prepare($sql);
        $req1->execute(array('lastname' => $lastName, 'firstname' => $firstName, 'birthdate' => $birthDate, 'mail' => $mail, 'phone' => $phone));
    } else // Tous les renseignement ne sont pas remplis
    {
        echo "Veuillez renseigner tous les champs !";
    }
}
