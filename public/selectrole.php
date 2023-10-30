<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .user-type:hover{
            cursor: pointer;
            background-color: blueviolet;
            color: white;

        }
    </style>
</head>

<body>
    <!-- <h2>Who are you??</h2> -->
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            
            <div class="react-modal open col-md-3 bg-white p-3 my-5 border border-secondary shadow">
                <!-- <div class="bg-overlay"></div><i class="icon-cancel-light"></i> -->
                <div class="modal-content">
                    <div class="react-registration">
                        <div class="create-account py-5">
                            <div class="signup-age-gate date-of-birth-age-gate-container">
                                <div class="date-of-birth-age-gate">
                                    <h3 class="text-center">Who are you?</h3>
                                    <!-- <div class="age-gate-title">Step 1: Who is primarily going to use this content?</div> -->
                                    <div class="user-type-container my-5">
                                        <div class="user-type user-type-parent card p-4 m-3">
                                            <div class="user-type-name  text-center" data-type='Student' >I'm a Student</div>
                                            <!-- <p>I'm a parent or guardian</p> -->
                                        </div>
                                        <div class="user-type user-type-teacher card p-4 m-3">
                                            <div class="user-type-name text-center" data-type='Parent' >I'm a Parent</div>
                                            <!-- <p>I'm a teacher</p> -->
                                        </div>
                                        <div class="user-type user-type-child card p-4 m-3">
                                            <div class="user-type-name text-center" data-type='Teacher' >I'm a Teacher</div>
                                            <!-- <p>I'm a student</p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        let roles = document.getElementsByClassName('user-type-name');
        // console.log(roles.length)
        for(let i=0;i<roles.length;i++){
            // console.log(roles[i]);
            let role = roles[i];
           
        //    console.log(userType);
            role.addEventListener('click',function(){
                let userType =  role.getAttribute('data-type');
                let url = 'setcookies.php?userType='+userType;
                // console.log(url);
                fetch(url).then(data=>data.text()).then(data=>{
                    // console.log(data);
                    window.location.href='../';
                    
                });
            })
           
        }
    </script>
</body>

</html>