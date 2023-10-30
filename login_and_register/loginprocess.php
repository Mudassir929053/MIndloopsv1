<?php

  session_start();
  require_once '../dbconnect.php';

  if(!empty($_COOKIE["email_set"]) && !empty($_COOKIE["password_set"]) && !empty($_COOKIE["remember_set"]) )
  {
    $valid = loginUser($conn,$_COOKIE["email_set"],$_COOKIE["password_set"]);
  }

  if (isset($_POST["login"])) {

    $email = $_POST['email']; 
    $password = $_POST['password'];

    if(isset($_POST["remember"]))
    {
      $remember=$_POST["remember"];
      //set cookie
      setcookie("email_set",$_POST["email"], time()+3600*24*7); // one week
      setcookie("password_set",$_POST["password"], time()+3600*24*7);
      setcookie("remember_set",$_POST["remember"], time()+3600*24*7);
      //setcookie("member_pwd",$_POST["pwd"], time()+(10*365*24*60*60));

    }
    else
    {
      // expire cookie
      setcookie('email_set',$email,30); // 30s
      setcookie('password_set',$password,30);
    }


    $valid = loginUser($conn,$email,$password);

    if($valid === false){
      header("location: login.php?error=Email or Password Incorrect");
      exit();
    }

  }else {
    header("location: login.php?error=loginerror");
    exit();

  }

  function userExists($conn,$email){
    $sql = "SELECT * FROM tb_users WHERE u_email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
      header("location: login.php?error=stmtfailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
      $_SESSION['u_id'] = $row['u_id'];
      return $row;
    }else{
      $result = false;
      return $result;

      mysqli_stmt_close($stmt);
      
    }
    mysqli_stmt_close($stmt);
  }

  function loginUser($conn,$email,$password){
    $userExist = userExists($conn,$email);
    if($userExist === false){
      
      header("location: login.php?error=wrongloginUserExist");
      exit();
    }

    $hashed_password = $userExist["u_pwd"];
    $userType = $userExist["u_type"];
    $email = $userExist["u_email"];
    $check_password = password_verify($password,$hashed_password);

    if($check_password === false){
      echo ("<script LANGUAGE='JavaScript'>
            					window.location.href='login.php?error=wronglogin';
            					</script>");
      exit(); 
    }else if($check_password === true){
      
      $today = date("Y-m-d");
      $sql3 = "SELECT  *, CASE
      WHEN  ? between sc_sDate and sc_eDate THEN  True 
      ELSE False
      END AS valid_subscription
      from tb_scodes
      where sc_id = ANY ( select s_code from tb_subscriptions where s_user = ? )
      and ? between sc_sDate and sc_eDate ";


      $stmt3 = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt3,$sql3);
      mysqli_stmt_bind_param($stmt3,"sss",$today,$email,$today);
      mysqli_stmt_execute($stmt3);
  

      $resultData = mysqli_stmt_get_result($stmt3);
      if($row = mysqli_fetch_assoc($resultData)){

        $_SESSION['session_name'] = session_id();// set session id
        $_SESSION['email'] = $email;
        $_SESSION['userType'] = $userType;
        $_SESSION['subscribed'] = $row['valid_subscription'];
        if($_SESSION['userType']!=1){
          if($_SESSION["userType"]=='2') 
                {
                  echo ("<script LANGUAGE='JavaScript'>
                    window.location.href='../index.php';
                    </script>");
                  exit();
                }
                else if($_SESSION["userType"]=='3') 
                {
                  echo ("<script LANGUAGE='JavaScript'>
                    window.location.href='../index.php';
                    </script>");
                  exit();
                }
                else if($_SESSION["userType"]=='4') 
                {
                    echo ("<script LANGUAGE='JavaScript'>
                    window.location.href='../index.php';
                    </script>");
                  exit();
                }
      }else{
        echo ("<script LANGUAGE='JavaScript'>
        window.location.href='admin.php';
        </script>");
      exit();
      }
      mysqli_stmt_close($stmt);

        //return $row;
      }else{
        $_SESSION['session_name'] = session_id();// set session id
        $_SESSION['email'] = $email;
        // $_SESSION['u_id'] = $row['u_id'];
        $_SESSION['userType'] = $userType;
        $_SESSION['subscribed'] = False; 
        if($_SESSION['userType']!=1){
            if($_SESSION["userType"]=='2') 
                  {
                    echo ("<script LANGUAGE='JavaScript'>
            					window.location.href='../index.php';
            					</script>");
                    exit();
                  }
                  else if($_SESSION["userType"]=='3') 
                  {
                    echo ("<script LANGUAGE='JavaScript'>
            					window.location.href='../index.php';
            					</script>");
                    exit();
                  }
                  else if($_SESSION["userType"]=='4') 
                  {
                      echo ("<script LANGUAGE='JavaScript'>
            					window.location.href='../index.php';
            					</script>");
                    exit();
                  }
        }else{
          echo ("<script LANGUAGE='JavaScript'>
					window.location.href='admin.php';
					</script>");
        exit();
        }
        mysqli_stmt_close($stmt);
      }

    }

  }

?>
