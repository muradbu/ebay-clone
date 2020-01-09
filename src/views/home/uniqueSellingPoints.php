<?php
require_once("controllers/ProductController.php");
$amount = ProductController::getAmount();

?>
<div class="col-md-4 col-lg-4 col-sm-4 usp">
    <h5><i class="material-icons text-secondary">done</i>Goed beoordeeld op Trustpilot!</h5>
</div>
<div class="col-md-4 col-lg-4 col-sm-4 usp">
    <h5><i class="material-icons text-secondary">done</i>Veiligheid boven alles!</h5>
</div>
<div class="col-md-4 col-lg-4 col-sm-4 mb-4 usp">
    <!-- TODO: Add dynamic count -->
    <h5><i class="material-icons text-secondary">done</i>Er zijn <?php echo $amount[0]["amount"]; ?> lopende veilingen!</h5>
</div>