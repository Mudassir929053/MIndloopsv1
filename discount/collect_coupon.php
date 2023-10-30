<?php include("../commonPHP/head.php"); ?>
<?php include("../commonPHP/topNavBarCheck.php"); ?>
<style>
    body {
        background-image: url('../assets/img/MindLOOPS_Resouces/Asset_4.jpg');
        background-size: 110%;
        background-position: top center;
    }
 
 
    .textAll {
        padding-top: 2%;
    }
 
    .chartreuse {
        background-color: #7fff00;
    }
</style>

<div class="container-fluid">
    <br>
    <div class="row justify-content-center">
        <?php
        $userid = $_SESSION['u_id'];
        $discountId = $_GET['discount_id'];
        $query = "SELECT * FROM discounts LEFT JOIN redemptions ON discounts.discount_id = redemptions.discountId WHERE discounts.discount_id = '$discountId'";
        $result = mysqli_query($conn, $query);
 
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['title'];
            $start_date = $row['start_date'];
            $logo_image = $row['logo_image'];
            $end_date = $row['end_date'];
            $description = $row['description'];
            $how_to_claim = "<p class='text-danger fw-bold'>To claim this coupon, follow these steps: </p>
            <div class='text-info'><p>1. Visit our website at example.com.</p> <p>2. Select the desired product or service.</p><p> 3. Apply the discount code 'SUMMER25' during checkout.</p><p> 4. Enjoy the discounted price!</p> </div>";
            $discount_code = $row['discount_code'];
            $discount_id = $row['discount_id'];
            $user_id = $row['user_id'];
            $discountiid = $row['discountId'];
 
            // Format the start and end dates
            $formatted_start_date = date("l, j F Y", strtotime($start_date));
            $formatted_end_date = date("l, j F Y", strtotime($end_date));
 
            // Check if the discount has already been redeemed by the user
            $discount_redeemed = ($userid == $user_id && $discountId == $discountiid);
            ?>
 
            
            <div class="row justify-content-center">
                    <div class="card col-12 col-md-6 col-lg-4 align-items-center border-0 text-center shadow">
                        <div class="d-flex justify-content-center mt-4">       
                        <img src="../assets/discount_images/<?php echo $logo_image; ?>" style="max-height: 19vh;" class="card-img-top img-fluid shadow" alt="Discount Logo">
                        </div>
                        <div class="card-body text-start text-wrap">
                            <h5 class="card-title text-black fs-4 mt-4"><?php echo $title; ?></h5>
                            <p class="card-text text-black"><?php echo $description; ?></p>
                            <p class="card-text text-black">Use by <strong><?php echo $formatted_end_date; ?></strong></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 text-center">
                            <?php if ($discount_redeemed) { ?>
                                <p class="text-muted mb-0">You have already redeemed this discount.</p>
                            <?php } else { ?>
                                <button class="btn btn-danger btn-sm rounded-pill fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#discountCodeModal" onclick="submitDiscount()">
                                    Redeem Now 💎
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        <?php
        } else {
            echo '<div class="text-center">No discounts available.</div>';
        }
        ?>
 
        <?php
        function checkRedemption($userid, $discount_id)
        {
            // Placeholder implementation to check if the discount has already been redeemed
            // Replace this with your actual logic to check the redemption status
            return false;
        }
        ?>
    </div>
</div>
 
 
    <!-- Discount Code Modal -->
    <div class="modal fade" id="discountCodeModal" tabindex="-1" aria-labelledby="discountCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center">Your discount code is: <strong id="discountCode"><?= $discount_code ?></strong></p>
                    
                    <div class="text-center">
                        <button class="btn btn-outline-primary btn-sm" id="copyDiscountCode">
                            <i class="fas fa-copy"></i> Copy Discount Code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <script>
    function submitDiscount() {
        var userId = <?= $userid ?>; // Get the user ID from PHP
        var discountId = <?= $discount_id ?>; // Get the discount ID from PHP

        $.ajax({
            url: "your-backend-url.php",
            method: "POST",
            data: {
                userid: userId,
                discount_id: discountId
            },
            success: function(response) {
                // Handle the success response, if needed

                // Open the modal
                var discountModal = new bootstrap.Modal(document.getElementById('discountCodeModal'));
                discountModal.show();

                // Update the discount code in the modal
                $('#discountCode').text(response.discountCode);
            },
            error: function() {
                // Handle the error, if needed
            }
        });
    }

    // Copy discount code functionality (same as before)
    document.getElementById('copyDiscountCode').addEventListener('click', function() {
        var discountCode = '<?php echo $discount_code; ?>';

        navigator.clipboard.writeText(discountCode)
            .then(function() {
                alert('Discount code copied to clipboard!');
                window.location.reload();
            })
            .catch(function(error) {
                console.error('Unable to copy discount code to clipboard:', error);
            });
    });

    // Reload the page after the modal is hidden
    $('#discountCodeModal').on('hidden.bs.modal', function () {
        window.location.reload();
    });
</script>


</main><!-- End #main -->
<?php include("../commonPHP/footer.php"); ?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<?php include("../commonPHP/jsFiles.php"); ?>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>