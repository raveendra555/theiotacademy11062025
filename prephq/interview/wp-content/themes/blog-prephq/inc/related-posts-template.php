
<?php if (!empty($related_posts)) { ?>
    <div class="related-posts">
        <p class="head">Related Post</p>
        <div class="posts">
            <?php
            foreach ($related_posts as $post) {
                setup_postdata($post);
            ?>
                <div class="post">
                    <a href="<?php the_permalink(); ?>" target="_blank">
                        <div class="post-image">
                            <?php the_post_thumbnail(array(938,490)); ?>
                        </div>
                        <span class="title"><?php the_title(); ?></span>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>