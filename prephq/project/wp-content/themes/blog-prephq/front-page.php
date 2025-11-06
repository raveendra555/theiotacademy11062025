<?php get_header(); ?>

<!-- container -->
<div class="blog-center-part">
    <div class="container">
	    <div class="row">
		    <div class="col-8">
                <div class="all-post">
				 <?php if ( $wp_query->have_posts() ) : ?>
					<?php 
					   $counter=0;
					   $total_posts = $wp_query->post_count;
					   $posts_per_column = ceil($total_posts / 2);
					   ?>

					   <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); $counter++; ?>               
                            <div class="post-box">
								<a class="featured-image" href="<?php the_permalink(); ?>" aria-label="Post link">
                                    <?php if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'full', array( 'class'  => 'img-fluid' ) );
                                    } else {
                                        echo main_image();
                                    } ?> 
                                </a>
                                <div class="avatarwithcategory">
                                    <div class="name-avatar">
                                        <div class="avatar-image">
                                            <?php echo get_avatar( get_the_author_meta( 'ID' ) , 56 ); ?>
                                        </div> 
                                        <a class="name" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>">
                                            <?php echo get_the_author_meta('display_name');?>
                                        </a>
                                    </div>
                                    <p class="category">
                                        <?php
                                        $categories = get_the_category();
                                        $separator = "";
                                        $catoptions = '';
                                        if($categories){
                                            foreach($categories as $category){
                                            $catoptions .= '<a href="' .get_category_link($category->term_id). '"><i class="icon-tags"></i>'.$category->cat_name. '</a>'.$separator;
                                        }
                                            echo trim($catoptions, $separator);
                                        }
                                        ?>
                                    </p>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
                                <!-- <p class="desc"><?php //echo wp_trim_words(get_the_excerpt(), 14); ?></p> -->
                                <div class="dateandlike">
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none">
                                            <path d="M23 19.5051C22.82 19.8908 22.5122 20.0006 22.0958 20C16.3758 19.9909 10.6558 19.9887 4.93585 19.9935C4.31966 19.9935 4.08626 19.7614 4.08626 19.1479V17.3279H4.36526C8.94684 17.3279 13.5282 17.3293 18.1094 17.3321C18.7772 17.3321 19.3292 17.119 19.8068 16.6615C21.1166 15.4065 22.0712 13.9159 22.814 12.2816C22.874 12.1553 22.934 12.0318 22.9976 11.9072L23 19.5051Z" fill="#37AB79"/>
                                            <path d="M23 3.99779H4.10726C4.0983 3.94574 4.09229 3.89324 4.08926 3.84054C4.08926 3.24061 4.08626 2.64128 4.08926 2.04135C4.08926 1.60639 4.36526 1.33402 4.80446 1.33283C5.82445 1.33283 6.83965 1.33283 7.85785 1.33283H8.13145C8.13145 1.11505 8.13145 0.910925 8.13145 0.706796C8.13565 0.291416 8.41464 5.67081e-05 8.80404 5.67081e-05C9.19344 5.67081e-05 9.47184 0.290822 9.47784 0.706202C9.47784 0.905584 9.47784 1.10437 9.47784 1.318H12.8468C12.8468 1.10971 12.8468 0.902617 12.8468 0.699674C12.8522 0.287855 13.136 -0.00350369 13.526 5.67081e-05C13.916 0.00361711 14.186 0.289636 14.1926 0.690774C14.1968 0.896683 14.1926 1.10259 14.1926 1.32037H17.6096C17.6096 1.12277 17.6096 0.918639 17.6096 0.715103C17.6138 0.296163 17.8856 0.00302371 18.2738 5.67081e-05C18.6728 -0.00469049 18.9524 0.289042 18.9566 0.71985C18.9566 0.912111 18.9566 1.10437 18.9566 1.33283H19.1966C20.1698 1.33283 21.143 1.34589 22.1156 1.3263C22.529 1.318 22.826 1.44498 22.9976 1.8212L23 3.99779Z" fill="#37AB79"/>
                                            <path d="M22.97 5.34718C22.9345 6.85701 22.7005 8.35585 22.274 9.80598C21.6608 11.8692 20.699 13.7491 19.223 15.3513C19.2175 15.3566 19.2123 15.3621 19.2074 15.3679C18.8396 15.8426 18.3818 16.0147 17.7548 16.0118C12.104 15.9868 6.45325 15.9963 0.801867 15.9993C0.501868 15.9993 0.253469 15.9293 0.0944693 15.6628C0.0159313 15.5346 -0.0150472 15.3834 0.00684816 15.235C0.0287435 15.0867 0.102148 14.9505 0.214469 14.8499C2.19446 12.9279 3.25706 10.543 3.76946 7.89405C3.91886 7.11907 3.96146 6.32451 4.05326 5.53885C4.05986 5.47951 4.06526 5.42017 4.07306 5.34955L22.97 5.34718Z" fill="#37AB79"/>
                                        </svg>
                                        <span><?php the_time('F j, Y'); ?></span>
                                    </p>
									<!--
                                    <p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
                                            <path d="M22 6.23914V7.24901C21.9862 7.29747 21.9758 7.34686 21.9688 7.39681C21.8558 8.73086 21.3821 9.93029 20.6727 11.044C19.9256 12.2165 19.0143 13.2506 17.9981 14.1758C15.9786 16.0159 13.929 17.8208 11.8842 19.6312C11.3072 20.1422 10.6634 20.117 10.0606 19.5878C8.49644 18.2153 6.93553 16.8399 5.37784 15.4615C4.05644 14.2885 2.77541 13.0731 1.72367 11.6347C0.923837 10.5358 0.309157 9.34623 0.104085 7.97867C-0.218864 5.82156 0.190744 3.83423 1.59934 2.15458C3.00793 0.474939 4.83851 -0.19593 6.98181 0.0837363C8.3678 0.263953 9.49059 0.980974 10.4266 2.01502C10.6236 2.2348 10.8034 2.46667 11.0031 2.70842C11.1016 2.57875 11.1861 2.46227 11.2765 2.35073C11.3669 2.2392 11.4692 2.11502 11.5725 2.00403C13.2772 0.172743 15.3343 -0.441532 17.6935 0.318896C19.9046 1.03317 21.1953 2.67765 21.7739 4.93037C21.887 5.35508 21.9279 5.80123 22 6.23914Z" fill="#37AB79"/>
                                        </svg>
                                        <span>1200+</span>
                                    </p>
									-->
                                </div>
                                <div class="read-more">
                                    <a href="<?php the_permalink(); ?>">Read&nbsp;More</a>
                                </div>
						    </div>
					   <?php if($counter % $posts_per_column == 0) ?>
					<?php endwhile; ?>
				 <?php endif; ?>

                </div>
            
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><?php pagination_bar(); ?></li>
                    </ul>
                </nav>
		    </div>
		    <div class="col-4">
                <!-- <div class="search">
                    <form role="search" method="get" action="https://prephq.theiotacademy.co/blog/" class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">
						<label class="wp-block-search__label d-none" for="wp-block-search__input-1">Search</label> 
						<div class="wp-block-search__inside-wrapper">
							<input class="form-control" id="wp-block-search__input-1" placeholder="Search Blog..." value="" type="search" name="s" required=""> 
							<button aria-label="Search" class="btn btn-outline-secondary" type="submit" style="background: #03045e; color: #fff;border-radius: .25rem;">Search</button>
						</div>
					</form>
			    </div> -->
                <div class="sidebar-right" style="position: sticky; top: 100px;">
                    <?php if (is_active_sidebar('sidebar-1')) : ?>
                        <div id="secondary" class="sidebar-container">
                            <div class="widget-area">
                                <?php dynamic_sidebar('sidebar-1'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
		    </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>