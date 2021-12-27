<?php
$themeSettings = get_option('my_option_name');
$popupImg = isset($themeSettings['popup_image']);
$popupTxt = isset($themeSettings['txt_popup']);
$popupUrl = isset($themeSettings['popuup_link']);
if($popupImg){
    ?>
    <div id="popup-modal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <figure><img class="img-fluid" src="<?php echo $popupImg; ?>" title="bestcasino.com" alt="bestcasino.com"></figure>
            <a href="<?php echo $popupUrl; ?>" target="_blank" class="btn sign-up"><?php echo $popupTxt; ?></a>

            <span class="close">&times;</span>
        </div>

    </div>
    <script>
        // Get the modal
        var modal = document.getElementById('popup-modal');
        $( "#popup-modal" ).delay( 20000 ).fadeIn( 400 );
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
<?php }