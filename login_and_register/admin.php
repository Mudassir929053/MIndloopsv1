
<?php
  // require('../../commonPHP/head.php');
  header('Location: ../manageDiscovers/manage.php');
  require('../commonPHP/adminNavBar.php');
  ?>

<body>
    <?php 

include "../index/_discover.php";?>
    <hr>
    <br>
    <br>
    <?php include "../commonPHP/footer.php";?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include "../commonPHP/jsFiles.php";?>

</body>

</html>
<!-- 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            type: "get",
            url: "../commonPHP/topNavBarLoggedIn.php",
            dataType: "html",
            success: function (html) {
                $('#head').append(html);

            },
        });
        $.ajax({
            type: "get",
            url: "../commonPHP/footer.php",
            dataType: "html",
            success: function (html) {
                $('#foot').append(html);
            },
        });
    });

</script> -->
