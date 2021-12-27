<?php
get_header();
?>
<div class="container-fluid bg-primary pl-0 pr-0">
    <!-- main content area -->
    <div class="row bg-gradi text-white no-gutters">
        <div class="single-content bg-gradi text-white w-100 text-justify">
            <?php
            echo fortuneWheel();
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
