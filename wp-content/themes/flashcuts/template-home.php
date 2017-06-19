<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

<style>

    #top {
        background:none!important;
        left:0!important;
        position:fixed!important;
        top:0!important;}
    
    #menu {
        position:fixed!important;}
    
    #top svg *, #menu svg *, #menu #wrap .open:hover svg * {
        fill:#FFF!important;}
    
    #main {
        height:100%!important;}

    svg * {
        fill:#FFF;}
    
    @media (max-width: 450px) {

        #bottom {

            bottom:0;
            position:fixed;

        }

    }

</style>

		<?php

            $background_image = get_field( 'background_image', 195 );

        ?>

        <div style="background:url(<?php echo $background_image; ?>) center no-repeat;background-size:cover;position:fixed;top:0;left:0;height:100%;width:100%;z-index:-9999;">
            
            
            
        </div>

        <?php get_template_part( 'loop', 'page' ); ?>

<?php get_footer(); ?>