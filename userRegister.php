<?php
    include 'server.php';  //memanggil file db.php
    
    //mengecek variabel
    if(isset($_POST["email"]) && isset ($_POST["password"]) && isset ($_POST["username"]))
    {
        $password = $_POST['password'];
        $passwordd = md5($password);
        $email= $_POST['email'];
        $username= $_POST['username'];
        $status= "0";
        
        $cekemail = mysqli_query($conn,"SELECT email from user where email = '$email'") or die (mysqli_errno());
        
        if (mysqli_num_rows($cekemail) >=1) {
            $response['result']= false ;
            $response['msg']="email sudah tersebut sudah terdaftar";
            echo json_encode($response);
            
        }
        else{
            $query = "INSERT INTO user (email, password , username , user_status) VALUES ('$email','$passwordd','$username','$status')";
            $hasil  = mysqli_query($conn,$query);
            if($hasil)
            {
                $response['result']= true;
                $response["msg"]= "Register berhasil, silakan login";
                echo json_encode($response);
            }
            else {
                $response['result']= false ;
                $response['msg']="maaf,terjadi kesalahan";
                echo json_encode($response);
            }
        }}else{
            $response['result']= false ;
            
            $response['msg']="maaf, data salah";
            echo json_encode($response);
        }
    
    ?>
