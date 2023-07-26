<?php
require_once 'connect.php'; // Veritabanı bağlantısını sağlayan dosyayı dahil edelim.

// Form gönderimi işlemini yapalım
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri alalım ve güvenli hale getirelim
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $fullname = htmlspecialchars($_POST['fullname']);

    // Veritabanına postu ekleyelim
    $query_insert_post = "INSERT INTO posts (subject, message, fullname) VALUES (:subject, :message, :fullname)";
    $stmt = $conn->prepare($query_insert_post);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);
    $stmt->bindParam(':fullname', $fullname);

    if ($stmt->execute()) {
        // Post başarıyla eklendi, isteğe bağlı olarak başka bir sayfaya yönlendirilebilirsiniz
        // Örneğin, kullanıcıya teşekkür sayfasına yönlendirelim
        header('location: thank_you2.php');
        exit; // Header yönlendirme sonrasında exit komutunu kullanmayı unutmayın.
    } else {
        // Hata oluştuğunda buraya düşer
        echo "Error creating post.";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    
    <link rel="shortcut icon" href="assets/img/icon/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/mobile.css">
</head>

<body>

    <?php include("includes/header.php"); ?>

    <div class="contact-wrapper">
        <div class="container mt-4">
            <div class="contact-container">
                <div class="contact-top-title">
                    Create Post
                </div>
                <div class="contact-form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="subject-input">
                            <input type="text" name="subject" id="" placeholder="Subject">
                        </div> 
                        <div class="message-input">
                            <textarea name="message" id="" cols="60" rows="5" placeholder="Message"></textarea>
                        </div>
                        <div class="fullname-input">
                            <input type="text" name="fullname" id="" placeholder="Full Name" >
                        </div>
                        <div class="button-input">
                            <button type="submit">Create Post</button>
                        </div>           
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container-fluid mt-5"></div>
        <hr>
        </div>
        <div class="container text-center mt-5 mb-5">
            <div class="copyright">
                © 2021 All rights reserved.
            </div>
        </div>

    </footer>

</body>

</html>