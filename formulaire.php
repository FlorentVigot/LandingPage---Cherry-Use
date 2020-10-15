<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3> Liste de contacts </h3>
    <?php
    session_start();
    require_once 'utilisateur.php';
    require_once 'bdd.php';

    $bdd = new BDD(); // nouvel objet de type PDO

    $sql = "SELECT * FROM cherry"; //séléctionne tout les membres de la table

    $result = $bdd->connexion->query($sql); //conexion + requête

    $row_cnt = $result->rowCount(); //nombre de résultats

    if ($row_cnt > 0) {

        echo '<table>';
        AfficheTitre(); // Affiche les noms des colonnes
        while ($row = $result->fetch()) { //boucle sur chaque résultats
            AfficheContact($row); // Affiche le résultat courant
        }
        echo '</table>'; //fin de la table
    } else {
        echo "Aucun contact enregistré en base";
    }

    function AfficheTitre() //Affiche les noms des colonnes de la table contacter
    {
        echo '
            <tr>
            <td>nom</td>
            <td>mail</td>
            <td>message</td>
            </tr>';
    }

    function AfficheContact($row) // Affiche le contact passé en argurment
    {
    ?>
        <tr>
            <td><?php echo '' . $row["nom"]; ?></td>
            <td><?php echo '' . $row["mail"]; ?></td>
            <td><?php echo '' . $row["message"]; ?></td>
        </tr>
    <?php
    } ?>
</body>

</html>