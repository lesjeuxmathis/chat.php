<?php
// Connexion à la base de données
$pdo = new PDO("mysql:host=localhost;dbname=chat", "root", "");

// Traitement des actions
if (isset($_POST["action"])) {
    $action = $_POST["action"];

    // Afficher les messages
    if ($action == "show") {
        $sql = "SELECT * FROM messages ORDER BY id DESC LIMIT 10";
        $stmt = $pdo->query($sql);
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($messages as $message) {
            echo "<p><strong>" . $message["pseudo"] . "</strong> : " . $message["content"] . "</p>";
        }
    }

    // Envoyer un message
    if ($action == "send") {
        if (isset($_POST["message"])) {
            $message = $_POST["message"];
            $pseudo = "Anonyme"; // A modifier selon votre besoin
            $sql = "INSERT INTO messages (pseudo, content) VALUES (:pseudo, :content)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["pseudo" => $pseudo, "content" => $message]);
        }
    }
}
?>