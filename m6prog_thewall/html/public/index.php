<?php
 
require_once '../source/dataclasses/Message.php';
require_once '../source/views/message_view.php';
require_once '../source/db/database.php';
 
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name']) && !empty($_POST['bericht'])) {
        $conn = get_db_connection();
        
        $name = $_POST['name'];
        $bericht = $_POST['bericht'];
        
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO user (name, bericht) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $bericht);
        
        $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        // Redirect to the same page to prevent form resubmission on refresh
        header("Location: index.php");
        exit;
    }
}
 
$conn = get_db_connection();
 
$result = $conn->query("SELECT * FROM user ORDER BY iduser DESC");
$messages = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = new Message($row['iduser'], $row['name'], $row['bericht']);
    }
}
 
$conn->close();
 
?>
<html>
    <head>
        <title>The Wall</title>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
    </head>
    <body>
        <section>
        <h1>The Wall</h1>
        </section>
        <div class="wall">
            <?php foreach ($messages as $message): ?>
                <?php echo render_message($message); ?>
            <?php endforeach; ?>
        </div>
        <div class="post-form">
            <form action="index.php" method="POST">
                <label for="name">Naam:</label>
                <input type="text" id="name" name="name" placeholder="Jouw naam" required>
                <label for="bericht">Bericht:</label>
                <textarea id="bericht" name="bericht" placeholder="Jouw lelijke bericht..." required></textarea>
                <button type="submit">Post op DE MUUR</button>
            </form>
        </div>
    </body>
</html>