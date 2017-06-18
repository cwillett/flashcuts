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

        $vimeo_url = get_field( 'vimeo_url', 195 );
        $vimeo_url = (int) substr(parse_url($vimeo_url, PHP_URL_PATH), 1);
        $background_image = get_field( 'background_image', 195 );

        ?>

        <div style="background:url(<?php echo $background_image; ?>) center no-repeat;background-size:cover;position:fixed;top:0;left:0;height:100%;width:100%;z-index:-9999;">
            
            <?php /*if(!empty($vimeo_url)) { ?><iframe class="vimeo_background" style="height:6000px;width:100%;position:relative;top:50%;margin-top:-3000px;" src="http://player.vimeo.com/video/<?php echo $vimeo_url; ?>?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=1" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe><?php } */ ?>
            
        </div>

        <?php /*$blogdescription = get_option('blogdescription'); if(!empty($blogdescription)) { ?><div id="headline"><h1><?php echo $blogdescription; ?></h1></div><?php } */ ?>
	
		<?php get_template_part( 'loop', 'page' ); ?>

<?php get_footer(); ?>