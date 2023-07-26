<?php
//including the database connection
require_once 'connect.php';

// Mesaj silme işlemini yapalım
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen mesaj ID'sini alalım ve güvenli hale getirelim
    $id = htmlspecialchars($_POST['id']);

    // Veritabanından mesajı silelim
    $query = "DELETE FROM messages WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        // Mesaj başarıyla silindi, isteğe bağlı olarak başka bir sayfaya yönlendirilebilirsiniz
        // Örneğin, kullanıcıya teşekkür sayfasına yönlendirelim
        header('location: message.php');
        exit; // Header yönlendirme sonrasında exit komutunu kullanmayı unutmayın.
    } else {
        // Hata oluştuğunda buraya düşer
        echo "Error deleting message.";
    }
}
?>
