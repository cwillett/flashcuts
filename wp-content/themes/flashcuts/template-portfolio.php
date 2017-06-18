<?php
/*
Template Name: Portfolio Template
*/
?>
<?php get_header(); ?>

		<div class="project-container row">

            <?php // Define Loop
                $loop = new WP_Query( array( 'post_type' => 'projects', 'posts_per_page' => -1 ) );
                $i = 1;
                $order = 1;
            ?>
            
            <?php // Initiate Loop
                while ( $loop->have_posts() ) : $loop->the_post();
            ?>
            
            <?php // Get information
                $featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $client_name = get_field('client_name');
                $type_of_project = get_field('type_of_project');
                $description = get_field('description');
                $video_type = get_field('video_type');
                $vimeo_id = get_field('vimeo_url');
                $vimeo_id = (int) substr(parse_url($vimeo_id, PHP_URL_PATH), 1);
                $youtube_id = get_field('youtube_url');
                parse_str( parse_url( $youtube_id, PHP_URL_QUERY ), $vars );
                $link = get_field('link_url');
                if($video_type == 'Vimeo') { $id = $vimeo_id; }
                if($video_type == 'Youtube') { $id = $vars['v']; }
            ?>
            
            <div class="cspan-3 project">
            
                <div class="container">
                
                    <div class="project-image" style="background-image:url(<?php echo $featured_image; ?>);"></div>
                    
                    <div class="info">
                    
                        <div class="align">
                            
                            <h2><?php echo $client_name; ?></h2>
                            
                            <div class="description"><?php echo $description; ?></div>
                            
                            <?php if($video_type == 'None') { ?>
                                <a href="#" order="<?php echo $order; ?>" type="<?php echo $video_type; ?>"></a>
                            <?php } ?>
                            
                            <?php if($video_type == 'Vimeo') { ?>
                                <a href="" class="expand modal-open" name="<?php echo $client_name; ?>" service="<?php echo $type_of_project; ?>" id="<?php echo $id; ?>" order="<?php echo $order; ?>" type="<?php echo $video_type; ?>">View</a>
                            <?php } ?>
                            
                            <?php if($video_type == 'Youtube') { ?>
                                <a href="" class="expand modal-open" name="<?php echo $client_name; ?>" service="<?php echo $type_of_project; ?>" id="<?php echo $id; ?>" order="<?php echo $order; ?>" type="<?php echo $video_type; ?>">View</a>
                            <?php } ?>
                            
                            <?php if($video_type == 'Link') { ?>
                                <a href="<?php echo $link; ?>" class="expand" target="_blank" order="<?php echo $order; ?>" type="<?php echo $video_type; ?>">View</a>
                            <?php } ?>
                            
                        </div>
                    
                    </div>
                
                </div>
            
            </div><?php if($i == 4) { ?></div><div class="project-container row"><?php $i = 0; } ?>
            
            <?php $i++; $order++; endwhile; wp_reset_query(); ?>

        </div>

        <div class="modal">

            <div class="wrap align">
            
                <div class="header">
                    
                    <span class="name"></span> <span class="service"></span>
                    
                </div>
                
                <div class="video vimeo">
                    
                    
                    
                </div>
                
                <a href="#" class="grid modal-close">
                
                    <?php include('images/grid.svg'); ?>
                    
                    <span class="tooltip">Back To Grid</span>
                
                </a>

                <div class="controls prev">

                    <?php include('images/arrow.svg'); ?>

                </div>

                <div class="controls next">

                    <?php include('images/arrow.svg'); ?>

                </div>
            
            </div>
            
            <div class="overlay"></div>

        </div>

<?php get_footer(); ?>