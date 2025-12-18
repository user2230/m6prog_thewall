<?php
 
require_once '../source/dataclasses/Message.php';
require_once '../source/views/message_view.php';
require_once '../source/db/database.php';
 
$conn = get_db_connection();
 
$result = $conn->query("SELECT * FROM user");
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
    </body>
</html>