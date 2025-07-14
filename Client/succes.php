<?php
if ($bdd = mysqli_connect('localhost', 'root', '', 'Client')){
    echo '<br/><br/>';

    if (isset($_GET['societe'])){
        $societe = mysqli_real_escape_string($bdd, $_GET['societe']);
        $query = "SELECT * FROM CLIENTS WHERE SOCIETE LIKE '%$societe%'";
        $result = mysqli_query($bdd, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h2>Liste des societe</h2>";
            echo "<style>
                    table {
                        width: 80%;
                        margin: 20px auto;
                        font-family: Arial, sans-serif;
                    }
                    th, td {
                        padding: 10px;
                        text-align: left;
                        border: 1px solid #ddd;
                    }
                    th {
                        background-color: #f2f2f2;
                        font-weight: bold;
                    }
                    tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }
                    h2 {
                        text-align: center;
                        color: #333;
                    }
                    td strong {
                        color: #007BFF;  /* Bleu pour les labels */
                    }
                  </style>";

            
            echo "<table>";

            while ($donnees = mysqli_fetch_assoc($result)) {
                echo "<tr><td><strong>Société</strong></td><td>{$donnees['SOCIETE']}</td></tr>";
            }
            echo "</table>";
    }
    else{
        echo "aucun societe trouver";
    }
}

}
?>
<h3 style="text-align:center"><a href="Index.php"><< Retour</a></h3>
