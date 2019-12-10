<?php
for ($i = 0; $i < 4; $i++) {
    ?>
    <div class="col-sm-12 col-md-6 col-lg-3 py-2">
        <div class='card'>
            <div class='row'>
                <div class='col-12 py-3 ml-4'>
                    <img src="<?php echo Config::ROOT_FOLDER ?>/img/star.png" width="10%" height="auto" />

                    <img src="<?php echo Config::ROOT_FOLDER ?>/img/star.png" width="10%" height="auto" />

                    <img src="<?php echo Config::ROOT_FOLDER ?>/img/star.png" width="10%" height="auto" />

                    <img src="<?php echo Config::ROOT_FOLDER ?>/img/star.png" width="10%" height="auto" />
                </div>
            </div>
            <div class='card-body py-0 mb-3'>
                <h5 class='card-title'>Goede en leuke ervaring</h5>
                <small class="text-muted">12 november</small>
                <div class='row'>
                    <div class='col-12'>
                        <p>Het was een erg leuke en goede ervaring.</p>
                        <br />
                        <small class="text-muted">Anton</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>