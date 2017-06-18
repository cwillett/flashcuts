<?php
/*
Template Name: Services Template
*/
?>
<?php get_header(); ?>

<style>

    /* body {
        background:url(http://www.flashcuts.com/wp-content/uploads/2014/12/team.png) center no-repeat;
        background-size:cover;}
    
    #top {
        background:none;}
    
    #menu #wrap .open:hover svg *, #top svg *, #menu svg * {
        fill:#FFF!important;} */
    
    #main {
        /* margin-top:10em; */
        padding:0;}
    
    

</style>

        <div id="services">
            
            <div class="header">
            
                <div class="row">
                    
                    <div class="cspan-6 relative">
                    
                        <ul class="submenu">
                        
                            <?php // Define Loop
                                $loop = new WP_Query( array( 'post_type' => 'services', 'posts_per_page' => -1 ) );
                                $i = 0;
                            ?>

                            <?php // Initiate Loop
                                while ( $loop->have_posts() ) : $loop->the_post();
                            ?>

                            <?php // Get information
                                $header = get_field('header');
                            ?>
                            
                            <a href="#" number="<?php echo $i; ?>"<?php if($i == 0) {echo ' class="current"';} ?>><li><?php echo $header; ?></li></a>
                            
                            <?php $i++; endwhile; wp_reset_query(); ?>
                        
                        </ul>
                    
                    </div>
                    
                    <div class="cspan-6 main-header text-center relative">
                    
                        <h2>Services</h2>
                        
                        <div class="arrow"><?php include('images/arrow.svg'); ?></div>
                    
                    </div>
                    
                </div>
            
            </div>
            
            <div class="slider">
            
            <?php // Define Loop
                $loop = new WP_Query( array( 'post_type' => 'services', 'posts_per_page' => -1 ) );
                $i = 0;
            ?>
            
            <?php // Initiate Loop
                while ( $loop->have_posts() ) : $loop->the_post();
            ?>
            
            <?php // Get information
                $featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $header = get_field('header');
                $description = get_field('description');
                $file_condition = get_field('file_condition');
                $link_text = get_field('attachment_link');
                $file = get_field('attachment_download');
            ?>
                
            <div class="slide<?php if($i == 0) { ?> active<?php } ?>" number="<?php echo $i; ?>">

                <div class="row">

                    <div class="cspan-6 img" style="background-image:url(<?php echo $featured_image; ?>);"></div>

                    <div class="cspan-6 text-center relative description">

                        <div class="main-text align">

                            <h3><?php echo $header; ?></h3>

                            <div class="description-text"><?php echo $description; ?>
                            <?php if($file_condition == 'Yes') { ?><br><a class="download" href="<?php echo $file; ?>"><?php echo $link_text; ?></a><?php } ?>
                            </div>
                            

                            <div style="display:none;">
                                
                                <div class="controls prev">

                                    <?php include('images/arrow.svg'); ?>

                                </div>

                                <div class="controls next">

                                    <?php include('images/arrow.svg'); ?>

                                </div>
                                
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            
            <?php $i++; endwhile; wp_reset_query(); ?>
                
            </div>
            
        </div>

        <div id="clients">

            <h1>Clients</h1>
            <h3>Some of the creative teams we have had the pleasure to work with.</h3>
            
            <div class="row">
                
                <?php // Define Loop
                    $loop = new WP_Query( array( 'post_type' => 'clients', 'posts_per_page' => -1 ) );
                    $i = 1;
                ?>

                <?php // Initiate Loop
                    while ( $loop->have_posts() ) : $loop->the_post();
                ?>

                <?php // Get information
                    $logo = get_field('client_logo');
                ?>
                
                <?php if($i == 4) { $i = 1; ?></div><div class="row"><?php } ?>

                <div class="cspan-4">

                    <div class="img">
                        <img style="background:url(<?php echo $logo; ?>) center no-repeat;background-size:cover;width:100%;height:0;padding-bottom:100%;">
                    </div>

                </div>

                <?php $i++; endwhile; wp_reset_query(); ?>
                
            </div>

        </div>

<?php get_footer(); ?>