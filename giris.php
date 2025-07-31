

<?php
session_start();
require_once "db.php";  // Veritabanı bağlantısını dahil ediyoruz

$error = '';  // Hata mesajı başlangıçta boş

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];  // Kullanıcı adı
    $password = $_POST['password'];  // Şifre

    // MD5 hash ile şifreyi kontrol etme
    $password_md5 = md5($password);  // Kullanıcının girdiği şifreyi MD5 ile hashliyoruz

    // Kullanıcı adıyla veritabanında arama yap
    $query = $baglanti->prepare("SELECT id, username, password FROM admin_users WHERE username = :username");
    $query->execute(['username' => $username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // Eğer kullanıcı varsa ve MD5 şifre doğruysa giriş yapılır
    if ($user && $user['password'] === $password_md5) {
        // Başarılı giriş, session başlatılır
        $_SESSION['username'] = $user['username'];  // Kullanıcı adı session'a kaydedilir
        header("Location: index.php");  // Admin paneline yönlendirilir
        exit();  // Çıkış yapılır
    } else {
        // Hatalı giriş
        $error = "Geçersiz kullanıcı adı veya şifre.";
    }
}

?>


<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="bootstrap/assets/dist/css/bootstrap.min.css">
  <title>Bilgi Port / Admin Panel</title>
  <style>
    .container-fluid {
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      width: 100%;
      height: 100vh;
    
}

body {
    display: block;
    margin: 8px;
   /* background: url(https://res.cloudinary.com/dci1eujqw/image/upload/v1616769558/Codepen/waldemar-brandt-aThdSdgx0YM-unsplash_cnq4sb.jpg);*/
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
background-color: #ecf0f3;

    place-items: center;
}
form{
  background-color: #fafafa;
  padding: 3rem;
  width: 100%;
  border-radius: 0.5rem;
  box-shadow: rgb(134, 133, 133) 0px 5px 15px;
  transition: all ease-in-out 0.1s;
  background-image: linear-gradient(-225deg,rgba(182, 182, 182, 0.03) 50%,rgba(109, 110, 112, 0.3) );
}
form:hover{
  transform: translateY(-5px);
  transition: all ease-in-out 0.1s;
  background-color:rgba(218, 218, 218, 0.29);
  background-image: linear-gradient(-225deg,rgba(243, 239, 239, 0.03) 50%,rgba(109, 110, 112, 0) );
}
h4{
  background-color:#424649 ;
  color: #fafafa;
  border-radius: 0.5rem;
  padding: 0.3rem;

}

   
  </style>
</head>
<body>
  <div class="container-fluid">
  
  <div class="col-md-3">

  <div class="row"><i class="fa-solid fa-users text-center fa-3x "></i> 
    <h4 class="text-center mt-2">Bilgi Port / Admin Panel </h4></div> 
  <form class="form-floating mb-3" method="post" action="">


<!--hata mesajı-->

<?php if ($error): ?>
  <div id="errorMessage" class="alert alert-danger text-center"><?= $error ?></div>

  <script>
    setTimeout(function() {
      const msg = document.getElementById('errorMessage');
      if (msg) {
        msg.style.transition = "opacity 0.5s ease";
        msg.style.opacity = 0;
        setTimeout(() => msg.remove(), 500); // görünmez olduktan sonra tamamen kaldır
      }
    }, 5000); // 5 saniye sonra
  </script>
<?php endif; ?>

  <div class="form-floating mb-3">
 
    <input type="text" class="form-control text-center" id="floatingInput" placeholder="Kullanıcı Adı" name="username" required>
    <label for="floatingInput"><i class="fa-solid fa-user"></i> &nbsp; Kullanıcı Adı </label>
  </div>

  <div class="form-floating mb-3">
    <input type="password" class="form-control text-center" id="floatingPassword" placeholder="Şifre" name="password" required>
    <label for="floatingPassword"><i class="fa-solid fa-lock"></i> &nbsp;Şİfre</label>
  </div>

  <button type="submit" class="btn btn-dark w-100"><i class="fa-solid fa-door-open"></i> &nbsp; Giriş Yap</button>
</form>
  </div></div>
  
</body>
</html>