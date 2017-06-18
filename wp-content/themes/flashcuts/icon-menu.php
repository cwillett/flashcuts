<ul id="icons">

    <div style="display:none;"><?php if(!empty($admin_email)) { ?>
        <a href="mailto:<?php echo $admin_email; ?>" target="_blank" class="email popup">
            <li><span>&#xe024;</span></li>
        </a>
    <?php } ?></div>
    
    <?php if(!empty($custom_field_twitter)) { ?>
        <a href="http://www.twitter.com/<?php echo $custom_field_twitter; ?>" target="_blank" class="twitter">
            <li><span>&#xe086;</span></li>
        </a>
    <?php } ?>
    
    <?php if(!empty($custom_field_facebook)) { ?>
        <a href="http://www.facebook.com/<?php echo $custom_field_facebook; ?>" target="_blank" class="facebook">
            <li><span>&#xe027;</span></li>
        </a>
    <?php } ?>
    
    <?php if(!empty($custom_field_vimeo)) { ?>
        <a href="http://www.vimeo.com/<?php echo $custom_field_vimeo; ?>" target="_blank" class="vimeo">
            <li><span>&#xe089;</span></li>
        </a>
    <?php } ?>
    
    <?php if(!empty($custom_field_google)) { ?>
        <a href="http://google.com/+<?php echo $custom_field_google; ?>" target="_blank" class="google">
            <li><span>&#xe039;</span></li>
        </a>
    <?php } ?>

</ul>