<?php
  header("Access-Control-Allow-Origin: *");

  include "koneksi.php";

  session_start();

  $inputUsername = strtolower(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
  $inputEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $inputPassword = $_POST['password'];


  if(!empty($inputUsername and $inputPassword and $inputEmail)){
    if(!empty($inputEmail)){
      $sql = "SELECT username FROM users WHERE username = '$inputUsername'";
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      $stmt->bind_result($user);
      $stmt->fetch();
  
      if($inputUsername !== $user){
        $passHash = password_hash($inputPassword, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (id, username, email, password)
        VALUES (NULL, '$inputUsername', '$inputEmail', '$passHash')";

        $stmt = $conn->prepare($sql);
        if($stmt->execute()){

          $stmt->close();

          response(true, "User berhasil disimpan");

        }else{

          response(false, "User gagal disimpan");
        }
      } else{
  
        response(false, "Username tidak diperbolehkan");
      }
  
    } else{
      response(false, "Format email salah");
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