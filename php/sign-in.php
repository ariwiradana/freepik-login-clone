<?php
  header("Access-Control-Allow-Origin: *");

  include "koneksi.php";

  session_start();

  $inputUsernameEmail = strtolower(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
  $inputPassword = $_POST['password'];

  if(!empty($inputUsernameEmail and $inputPassword)){
    $sql = "SELECT id, username, password FROM users WHERE username = '$inputUsernameEmail' OR email = '$inputUsernameEmail'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($id, $useremail, $password);
    $stmt->fetch();

    if($inputUsernameEmail == $useremail){

      $passVerify = password_verify($inputPassword, $password);

      if($inputPassword == $passVerify){

        $sesslogin = $_SESSION['login'] = true;
        $sessId = $_SESSION['id'] = $id;

        echo json_encode([
          "success" => true,
          "data" => [
            "id" => $sessId,
            "login" => $sesslogin,
          ],
          "message" => "Login berhasil"
        ]);

      } else{
        response(false, "Password yang anda masukkan salah");
      }

    } else{
      response(false, "User ".$inputUsername." tidak ditemukan");
    }

  } else{
    response(false, "Lengkapi semua data");
  }

  function response ($success, $msg){
    $response = [
      "success" => $success,
      "message" => $msg
    ];

    echo json_encode($response);
  }
?>