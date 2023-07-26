<?php
// Form gönderimi işlemini yapalım
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //including the database connection
    require_once 'connect.php';

    // Formdan gelen verileri alalım ve güvenli hale getirelim
    $fullname = htmlspecialchars($_POST['fullname-surname']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Veritabanına mesajı ekleyelim
    $query = "INSERT INTO messages (fullname, email, subject, message) VALUES (:fullname, :email, :subject, :message)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':subject', $subject);
    $stmt->bindParam(':message', $message);

    if ($stmt->execute()) {
        // Mesaj başarıyla eklendi, isteğe bağlı olarak başka bir sayfaya yönlendirilebilirsiniz
        // Örneğin, kullanıcıya teşekkür sayfasına yönlendirelim
        header('location: thank_you.php');
        exit; // Header yönlendirme sonrasında exit komutunu kullanmayı unutmayın.
    } else {
        // Hata oluştuğunda buraya düşer
        echo "Error sending message.";
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
                    Contact Form
                </div>
                <div class="contact-form">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="fullname-input">
                            <input type="text" name="fullname-surname" id="" placeholder="Full Name">
                        </div>
                        <div class="email-input">
                            <input type="email" name="email" id="" placeholder="Email Address">
                        </div>
                        <div class="subject-input">
                            <input type="text" name="subject" id="" placeholder="Subject">
                        </div>
                        <div class="message-input">
                            <textarea name="message" id="" cols="60" rows="5" placeholder="Message"></textarea>
                        </div>
                        <div class="button-input">
                            <button type="submit">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-fluid mt-5">
            <hr>
            <div class="container text-center mt-5 mb-5">
                <div class="copyright">
                    © 2021 All rights reserved.
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
