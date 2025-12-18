<?php

class PostMessageController
{
    public function postMessage()
    {
        if (!empty($_POST['name']) && !empty($_POST['bericht'])) {
            $conn = get_db_connection();
            
            $name = $_POST['name'];
            $bericht = $_POST['bericht'];
            
            $stmt = $conn->prepare("INSERT INTO user (name, bericht) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $bericht);
            
            $stmt->execute();
            
            $stmt->close();
            $conn->close();
            
            header("Location: index.php");
            exit;
        }
    }
}
