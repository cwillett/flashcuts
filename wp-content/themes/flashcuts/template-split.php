<?php
/*
Template Name: Split Screen Template
*/
?>
<?php get_header(); ?>

<?php

$split_mod_content_1 = get_field('split_mod_content_1');
$split_mod_text_color_1 = get_field('split_mod_text_color_1');
$split_mod_background_1 = get_field('split_mod_background_1');

$split_mod_content_2 = get_field('split_mod_content_2');
$split_mod_text_color_2 = get_field('split_mod_text_color_2');
$split_mod_background_2 = get_field('split_mod_background_2');

?>

<style>

    body {
        overflow:hidden;}
    
    #top {
        background:none!important;
        left:0!important;
        position:fixed!important;
        top:0!important;
        z-index:999;}
    
    #menu {
        position:fixed!important;}
    
    #main {
        height:100%!important;}
    
    #split-mod-1, #split-mod-1 h1, #split-mod-1 h2, #split-mod-1 h3, #split-mod-1 h4, #split-mod-1 h5, #split-mod-1 h6 {
        color:<?php echo $split_mod_text_color_1; ?>!important;}
    
    #top svg * {
        fill:<?php echo $split_mod_text_color_1; ?>!important;}
    
    #split-mod-2, #split-mod-2 h1, #split-mod-2 h2, #split-mod-2 h3, #split-mod-2 h4, #split-mod-2 h5, #split-mod-2 h6 {
        color:<?php echo $split_mod_text_color_2; ?>!important;}
    
    #menu svg * {
        fill:<?php echo $split_mod_text_color_2; ?>!important;}
    
    <?php if(!empty($split_mod_background_1)) { ?>#split-mod-1:before {
        opacity:1!important;}<?php } ?>
    
    <?php if(!empty($split_mod_background_2)) { ?>#split-mod-2:before {
        opacity:1!important;}<?php } ?>
    
    /**/
    
    @media (max-width: 1000px) {
        
        #top {
            position:initial!important;}
        
        #menu {
            position:absolute!important;}
        
        #top svg *, #menu svg * {
            fill:#000!important;}
        
        #main {
            height:auto!important;
            padding:0!important;}
        
    }

</style>

		<div id="split-mod-1"<?php if(!empty($split_mod_background_1)) { ?> style="background:url(<?php echo $split_mod_background_1; ?>) center no-repeat;background-size:cover;"<?php } ?>>

            <div class="align">
            
                <?php echo $split_mod_content_1; ?>
            
            </div>

        </div>

		<div id="split-mod-2"<?php if(!empty($split_mod_background_2)) { ?> style="background:url(<?php echo $split_mod_background_2; ?>) center no-repeat;background-size:cover;"<?php } ?>>

            <div class="align">
            
                <?php echo $split_mod_content_2; ?>
            
            </div>

        </div>

<?php get_footer(); ?>