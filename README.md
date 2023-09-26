# BlogWeb-PHP-SQLite
BlogWeb-PHP-SQLite

Activating SQLite functions for XAMPP

I used XAMPP while preparing this project. SQLite functions are disabled in XAMPP. To activate these, we need to edit the ";extension=sqlite3" section in the php.ini file as "extension=sqlite3" and save the text document. To turn off the feature, just put "; (semicolon)" in front of it again. If you are using another program for the server rather than XAMPP, you can get help from Google to enable the SQLite feature.

![Screenshot_107](https://github.com/BerkayAtass/ToDoList-Php-SQLite/assets/74881380/23405af6-cef9-4dbf-8310-a3310e708bf6)

![Screenshot_108](https://github.com/BerkayAtass/ToDoList-Php-SQLite/assets/74881380/ab6f1877-1188-41d6-9e32-7338bd67721b)


Admin Account
-------------------
email = admin@gmail.com
password = admin

I have set the admin account to be created automatically when you activate the site, but if it is not active, you can go to "/connect.php". If this does not work, if you give the admin value of a user you created in the users table in the database to "1", you will authorize it.
Description = To create a post, after filling out the "post create" form from the Blog menu, the created post must be approved by the admin panel before it can be read.


Admin Hesabi
-------------------
email = admin@gmail.com
şifre = admin

Siteyi aktif ettiğinizde admin hesabının otomatik olarak oluşacak şekilde ayarladım fakat aktif olmazsa "/connect.php" adresine gidebilirsiniz. Eğer bu da olmuyorsa veritabanındaki users tablosunda oluşturduğunuz bir kullanıcının admin değerini "1" verirseniz yetki vermiş olursunuz.
Açıklama = Gönderi oluşturmak için Blog menüsünden "post create" formunu doldurduktan sonra oluşturulan gönderinin okunabilmesi için admin panelinden tarafından onaylanması gerekiyor.
