<?php
// Add this function to your theme's Shortcode.php file or in a custom plugin
function custom_portfolio_shortcode() {
    ob_start(); // Start output buffering

    $portfolio_query = new WP_Query(array(
        'post_type' => 'projects',
        'posts_per_page' => -1, // Display all posts
    ));

    $color_classes = array('yellow', 'orange', 'red', 'blue', 'green', 'purple'); // Add more colors if needed

    $counter = 0; // Initialize a counter

    if ($portfolio_query->have_posts()) :
    ?>
        <div class="card-grid">
            <?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                $post_id = get_the_ID(); // Get the current post ID

                // Get a color class based on the counter
                $color_class = $color_classes[$counter % count($color_classes)];

                // Increment the counter
                $counter++;
            ?>

                <div class="card card-<?php echo esc_attr($color_class); ?> post-id-<?php echo esc_attr($post_id); ?>">
                    <div class="card-button">
                        <h3 class="card-text"><?php the_title(); ?></h3>
                        
                        
                            
                        <div class="card-icon"></div>
                    </div>
                    <!-- Add your card details here -->
                </div>

                <div class="card-details card-<?php echo esc_attr($color_class); ?> post-id-<?php echo esc_attr($post_id); ?>">
                    <!-- corresponding details for above card/button -->
                    <div class="card-details-body">
                        <div class="card-details-description">
                        
      <?php
    // Output custom fields without labels and wrap them in a div
    echo '<div class="custom-fields-one">';

    $sub_title = get_post_meta($post_id, 'sub_title', true);

    if ($sub_title) {
        echo '<h2>' . esc_html($sub_title) . '</h2>';
    }

    // Close the outer div
    echo '</div>';
?>



                    <?php the_content(); ?>
                          
                        </div>
                        <aside class="card-details-sidebar">
                            <div class="featured-image">
<?php
// Check if the featured image exists
if (has_post_thumbnail()) {
    // Display the medium size of the featured image
    the_post_thumbnail('medium');
}
?>

                                
                                 </div>
                                
                             <?php
    // Output custom fields without labels and wrap them in a div
    echo '<div class="custom-fields">';

    /*$sub_title = get_post_meta($post_id, 'sub_title', true);*/
    $website_link = get_post_meta($post_id, 'website_link', true);
    $extra_info = get_post_meta($post_id, 'extra_info', true);

    if ($website_link) {
        echo '<p><a href="' . esc_url($website_link) . '">' . esc_html($website_link) . '</a></p>';
    }

    if ($extra_info) {
        echo '<p>' . esc_html($extra_info) . '</p>';
    }

    // Close the outer div
    echo '</div>';
?>
                            
                          
                        </aside>
                    </div>
                </div>

            <?php endwhile; ?>
        </div>
    <?php
    endif;

    wp_reset_postdata(); // Reset the query

    $output = ob_get_clean(); // Get the buffer contents
    return $output; // Return the output
}

// Register the shortcode
add_shortcode('projects', 'custom_portfolio_shortcode');
?>
