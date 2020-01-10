<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="true">Beschrijving</a>
            </li>
            <?php
            if (isset($product["ShippingInstructions"]) && $product["ShippingInstructions"] != "0.0") {
            ?>
                <li class='nav-item'>
                    <a class='nav-link' id='pills-sendmethod-tab' data-toggle='pill' href='#pills-sendmethod' role='tab' aria-controls='pills-sendmethod' aria-selected='false'>Verzend instructies</a>
                </li>
            <?php
            }
            if (isset($product["PaymentInstruction"]) && $product["PaymentInstruction"] != 0) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" id="pills-information-tab" data-toggle="pill" href="#pills-information" role="tab" aria-controls="pills-information" aria-selected="false">Informatie</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="text-left tab-pane active fade show" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                <iframe id="descriptionIframe" frameborder="0" border="0" cellspacing="0" style="height: 750px;" class="w-100 card" srcdoc="<?php echo htmlspecialchars($product['Description'], ENT_QUOTES); ?>"></iframe>
            </div>
            <div class="text-left tab-pane fade" id="pills-sendmethod" role="tabpanel" aria-labelledby="pills-sendmethod-tab">
                <?php echo $product["ShippingInstructions"]; ?>
            </div>
            <div class="text-left  tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab">
                <?php echo $product["PaymentInstruction"]; ?>
            </div>
        </div>
    </div>
</div>