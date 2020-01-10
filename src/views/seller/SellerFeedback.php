<?php
    require_once('controllers/FeedbackController.php');
    if (isset($_POST['submit'])) {
      FeedbackController::post($_POST);
    }
?>
<form method="post">
    <div class="row mt-3">
        <div class="card col-12 p-3">
        <form method="POST">
            <h3>Feedback geven</h3>
            <div class="form-group">        
             <div class="row">
               <div class="col-lg-12">
                 <div class="star-rating">                  
                   <span class="material-icons star star-filled-color" data-rating="1">star_border</span>
                   <span class="material-icons star star-filled-color" data-rating="2">star_border</span>
                   <span class="material-icons star star-filled-color" data-rating="3">star_border</span>
                   <span class="material-icons star star-filled-color" data-rating="4">star_border</span>
                   <span class="material-icons star star-filled-color" data-rating="5">star_border</span>
                   <input type="hidden" name="Stars" class="rating-value" value="1">
                   <input type="hidden" name="ProductId" value="<?php echo $crumbs[3] ?>">
                </div>
              </div>
            </div>
           </div>
            <div class="form-group">
             <label>Informatie</label>
             <textarea class="form-control" name="Comment" rows="6"></textarea>
            </div>
          <button type='submit' name='submit' class='w-100 btn btn-primary text-white cut-text'>
           Verstuur verkoper feedback
         </button>
         </form>
        </div>
    </div>
</form>