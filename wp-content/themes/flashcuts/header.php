<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<html <?php language_attributes(); ?>>
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '&lsaquo;', true, 'right' ); bloginfo('name'); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=1.1.6">

<!-- Meta Properties -->
<?php // Home Page
if(is_page(6)) { ?><meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:title" content="<?php wp_title( '&lsaquo;', true, 'right' ); bloginfo('name'); ?>">
<meta property="og:description" content="<?php bloginfo('description'); ?>">
<meta property="og:url" content="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link; ?>">
<meta property="og:image" content="http://www.flashcuts.com/wp-content/uploads/2014/12/fc_common_area.jpg">
<meta property="og:type" content="website"><?php }
?>
<?php // Services Page
if(is_page(97)) { ?><meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:title" content="<?php wp_title( '&lsaquo;', true, 'right' ); bloginfo('name'); ?>">
<meta property="og:description" content="Post-production editorial services and facility rental.">
<meta property="og:url" content="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link; ?>">
<meta property="og:image" content="http://www.flashcuts.com/wp-content/uploads/2014/12/fc_common_area.jpg">
<meta property="og:type" content="website"><?php }
?>
<?php // Creative Page
if(is_page(76)) { ?><meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:title" content="<?php wp_title( '&lsaquo;', true, 'right' ); bloginfo('name'); ?>">
<meta property="og:description" content="Projects that have come through Flash Cuts.">
<meta property="og:url" content="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link; ?>">
<meta property="og:image" content="http://www.flashcuts.com/wp-content/uploads/2015/01/rental.jpg">
<meta property="og:type" content="website"><?php }
?>
<?php // Contact Page
if(is_page(79)) { ?><meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:title" content="<?php wp_title( '&lsaquo;', true, 'right' ); bloginfo('name'); ?>">
<meta property="og:description" content="Talk to us.">
<meta property="og:url" content="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link; ?>">
<meta property="og:image" content="http://www.flashcuts.com/wp-content/uploads/2015/01/menu.jpg">
<meta property="og:type" content="website"><?php }
?>
<?php // Else
if(!is_page(6) && !is_page(97) && !is_page(76) && !is_page(79)) { ?><meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:title" content="<?php wp_title( '&lsaquo;', true, 'right' ); bloginfo('name'); ?>">
<meta property="og:description" content="<?php bloginfo('description'); ?>">
<meta property="og:url" content="<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; echo $actual_link; ?>">
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/images/og-img.png">
<meta property="og:type" content="website"><?php }
?>


<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

<!-- Jquery -->
<script src="<?php bloginfo('template_directory'); ?>/lib.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_directory'); ?>/jquery.js?v=1.1.3" type="text/javascript"></script>

<!-- Favicons -->
<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicons/favicon.ico?v=1.0">
<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/favicons/apple-touch-icon.png?v=1.0">
<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/favicons/apple-touch-icon-72x72.png?v=1.0">
<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/favicons/apple-touch-icon-114x114.png?v=1.0">

<!-- Plugins --> 
<?php include('variables.php'); ?>
<?php wp_deregister_script('jquery'); ?>
<?php wp_head(); ?>
    
<?php $menu_cover_image = get_field( 'menu_cover_image', 182 ); if(!empty($menu_cover_image)) { ?>

<?php } ?>

<?php 
if (is_page_template('template-home.php')) {
  echo '
  <script>
    $(window).load(function(){
      $("#menu #wrap .open").trigger("click");
    });
  </script>';
}
?>

</head>

	<body>
	
        
        
        
        
        
        
        
        <div id="top">
        
            <div id="logo">
            
                <a href="/"><?php include('images/logo.svg'); ?></a>
            
            </div>
            
            <div id="emblem">
                
                <a href="/"><?php include('images/emblem.svg'); ?></a>
                
            </div>
        
        </div> <!-- /top -->
        
        <div id="menu" class="closed">
            
            <div id="cover"></div>
            
            <div id="wrap">
                
                <a class="open" href="#">
                
                    <?php include('images/menu-open.svg'); ?>
                
                </a>
                
                <a class="close default-color" href="#">
                    
                    <?php include('images/menu-close.svg'); ?>
                
                </a>
                
                <div id="items">
                
                    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_id' => 'topmenu' ) ); ?>
                    
                    <?php include('icon-menu.php'); ?>
                
                </div>
                
            </div>
            
        </div> <!-- /menu -->
        
        
        
        
        
        
	
		<div id="main">
        
            