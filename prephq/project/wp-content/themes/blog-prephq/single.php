<?php get_header(); ?>
<!-- <div class="breadcrumb-sec">
   <div class="container">
      <div class="breadcrumb"><?php //get_breadcrumb(); ?></div>
   </div>
</div> -->

<div class="blog-center-part content-page">
   <div class="container">
      <div class="row">
         <div class="col-8">
            <div class="avatarwithcategory">
               <div class="name-avatar">
                  <?php
                     if (have_posts()) : 
                     while (have_posts()) : the_post();
                  ?>
                     <div class="avatar-image">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ) , 56 ); ?>
                     </div> 
                     <a class="name" href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>">
                        <?php echo get_the_author_meta('display_name');?>
                     </a>
                  <?php
                  endwhile;
                  endif;
                  ?>
               </div>
               <div class="datelikecategory">
                  <p>
                     <!-- Published on : -->
                     <svg xmlns="http://www.w3.org/2000/svg" width="23" height="20" viewBox="0 0 23 20" fill="none">
                        <path d="M23 19.5051C22.82 19.8908 22.5122 20.0006 22.0958 20C16.3758 19.9909 10.6558 19.9887 4.93585 19.9935C4.31966 19.9935 4.08626 19.7614 4.08626 19.1479V17.3279H4.36526C8.94684 17.3279 13.5282 17.3293 18.1094 17.3321C18.7772 17.3321 19.3292 17.119 19.8068 16.6615C21.1166 15.4065 22.0712 13.9159 22.814 12.2816C22.874 12.1553 22.934 12.0318 22.9976 11.9072L23 19.5051Z" fill="#37AB79"/>
                        <path d="M23 3.99779H4.10726C4.0983 3.94574 4.09229 3.89324 4.08926 3.84054C4.08926 3.24061 4.08626 2.64128 4.08926 2.04135C4.08926 1.60639 4.36526 1.33402 4.80446 1.33283C5.82445 1.33283 6.83965 1.33283 7.85785 1.33283H8.13145C8.13145 1.11505 8.13145 0.910925 8.13145 0.706796C8.13565 0.291416 8.41464 5.67081e-05 8.80404 5.67081e-05C9.19344 5.67081e-05 9.47184 0.290822 9.47784 0.706202C9.47784 0.905584 9.47784 1.10437 9.47784 1.318H12.8468C12.8468 1.10971 12.8468 0.902617 12.8468 0.699674C12.8522 0.287855 13.136 -0.00350369 13.526 5.67081e-05C13.916 0.00361711 14.186 0.289636 14.1926 0.690774C14.1968 0.896683 14.1926 1.10259 14.1926 1.32037H17.6096C17.6096 1.12277 17.6096 0.918639 17.6096 0.715103C17.6138 0.296163 17.8856 0.00302371 18.2738 5.67081e-05C18.6728 -0.00469049 18.9524 0.289042 18.9566 0.71985C18.9566 0.912111 18.9566 1.10437 18.9566 1.33283H19.1966C20.1698 1.33283 21.143 1.34589 22.1156 1.3263C22.529 1.318 22.826 1.44498 22.9976 1.8212L23 3.99779Z" fill="#37AB79"/>
                        <path d="M22.97 5.34718C22.9345 6.85701 22.7005 8.35585 22.274 9.80598C21.6608 11.8692 20.699 13.7491 19.223 15.3513C19.2175 15.3566 19.2123 15.3621 19.2074 15.3679C18.8396 15.8426 18.3818 16.0147 17.7548 16.0118C12.104 15.9868 6.45325 15.9963 0.801867 15.9993C0.501868 15.9993 0.253469 15.9293 0.0944693 15.6628C0.0159313 15.5346 -0.0150472 15.3834 0.00684816 15.235C0.0287435 15.0867 0.102148 14.9505 0.214469 14.8499C2.19446 12.9279 3.25706 10.543 3.76946 7.89405C3.91886 7.11907 3.96146 6.32451 4.05326 5.53885C4.05986 5.47951 4.06526 5.42017 4.07306 5.34955L22.97 5.34718Z" fill="#37AB79"/>
                     </svg>
                     <?php the_time('F jS, Y'); ?>
                  </p>
                  <!-- <p>
                     <?php //if (get_the_date() !== get_the_modified_date()) { ?>
                        Updated on <?php //the_modified_date(); ?>
                     <?php //} ?>
                  </p> -->
                  <p>
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
						  <path d="M10.0076 8.08374e-06C15.528 0.00696627 20.009 4.49569 20 10.01C19.9909 15.5244 15.4737 20.0243 9.97913 19.9999C4.46925 19.9749 -0.00208608 15.4917 7.30151e-07 9.99474C0.00208754 4.47899 4.4936 -0.0069501 10.0076 8.08374e-06ZM11.1067 7.54685V5.7252C11.1067 5.7078 11.1067 5.69041 11.1067 5.67301C11.0879 5.03634 10.6198 4.5597 10.0083 4.55275C9.39691 4.54579 8.89955 5.03356 8.89538 5.68345C8.88842 7.14954 8.89538 8.61563 8.89538 10.0817C8.8914 10.2339 8.91868 10.3853 8.97551 10.5265C9.03234 10.6677 9.11752 10.7958 9.22579 10.9028C9.96035 11.6403 10.6866 12.3897 11.4427 13.1023C11.6514 13.2798 11.907 13.3934 12.1786 13.4293C12.6301 13.4947 13.0509 13.2018 13.2373 12.7836C13.4286 12.3536 13.35 11.8964 12.9987 11.5374C12.4276 10.955 11.8419 10.3872 11.2757 9.79782C11.181 9.69307 11.125 9.55897 11.1171 9.41791C11.0977 8.79654 11.1067 8.17169 11.1067 7.54685Z" fill="#37AB79"/>
						</svg>
                     <?php echo calculate_reading_time(get_the_content()) . ' Minutes Read'; ?>
                  </p>
				   <!--
                  <p>
                     <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
                        <path d="M14.6582 1.15234C15.4665 0.92509 16.3683 0.941787 17.3857 1.26953V1.27051C19.2074 1.85896 20.2944 3.1886 20.8057 5.17871L20.8076 5.1875C20.8988 5.53023 20.924 5.82811 21 6.30859V7.13672C20.9919 7.17692 20.9842 7.21719 20.9785 7.25781L20.9746 7.28516L20.9727 7.3125C20.8759 8.45387 20.4704 9.50001 19.8291 10.5068C19.1372 11.5927 18.2872 12.5606 17.3252 13.4365H17.3242C15.3115 15.2704 13.2694 17.0698 11.2217 18.8828C11.0818 19.0067 11.014 19.0001 11.0098 19C10.9946 18.9996 10.898 18.9915 10.7207 18.8359H10.7197C9.15704 17.4647 7.59725 16.0909 6.04102 14.7139H6.04199C4.89472 13.6954 3.82179 12.6816 2.91113 11.541L2.53125 11.0449C1.78878 10.0246 1.26593 8.98479 1.09277 7.83008C0.80442 5.90324 1.1728 4.21877 2.36523 2.79688C3.47255 1.47649 4.85021 0.910248 6.51562 1.04004L6.85254 1.0752C7.94374 1.21708 8.86252 1.77814 9.68164 2.68164V2.68262C9.86125 2.88299 10.0062 3.07184 10.2324 3.3457L11.0361 4.31836L11.7998 3.31348C11.9161 3.16037 11.9763 3.07591 12.0537 2.98047C12.1431 2.87016 12.2268 2.76924 12.3047 2.68555C13.0575 1.87682 13.8455 1.38085 14.6582 1.15234Z" stroke="#37AB79" stroke-width="2"/>
                     </svg>
                     1200+
                  </p>
				   -->
                  <p class="category">
                        <?php
                        $categories = get_the_category();
                        $separator = "";
                        $catoptions = '';
                        if($categories){
                           foreach($categories as $category){
                           $catoptions .= '<a href="' .get_category_link($category->term_id). '">'.$category->cat_name. '</a>'.$separator;
                        }
                           echo trim($catoptions, $separator);
                        }
                        ?>
                  </p>
               </div>
            </div>

            <!-- TOC -->
            <div class="tableofcontent">
               <?php
               if (have_posts()) : 
                  while (have_posts()) : the_post();
                     $content = get_the_content();
                     $matches = [];
                     preg_match_all('/<h([2-3])>(.*?)<\/h\1>/', $content, $matches, PREG_SET_ORDER);
                     $toc = '<div id="dynamic-toc"><div class="head">Table of Contents</div><ul>';

                     if (!empty($matches)) {
                        foreach ($matches as $index => $heading) {
                           $id = 'toc-heading-' . ($index + 1);
                           $level = $heading[1];
                           $text = strip_tags($heading[2]);
                           $content = str_replace($heading[0], "<h$level id=\"$id\">$text</h$level>", $content);
                           $toc .= "<li class=\"toc-level-$level\"><a href=\"#$id\">$text</a></li>";
                        }
                     }
                     $toc .= '</ul></div>';
                     echo $toc;
                  endwhile;
               endif;
               ?>
            </div>

            <h1 class="title-heading"><?php the_title(); ?></h1>

            <div class="post-content">
               <?php echo $content; ?>
            </div>

            <div class="post-tags">
               <p class="head">Tags:</p>
               <?php
                  $tags = get_the_tags();
                  if ( $tags ) {
                     echo '<ul>';
                     foreach ( $tags as $tag ) {
                        echo '<li><a href="' . get_tag_link( $tag->term_id ) . '">' . esc_html( $tag->name ) . '</a></li>';
                     }
                     echo '</ul>';
                  }
               ?>
            </div>

            <div class="post-share" id="share-option">
               <p class="head">Share:</p>
               <?php wcr_share_buttons(); ?>
            </div>
            
            <div class="post-author">
               <div class="author-image">
                  <?php echo get_avatar(get_the_author_meta('ID'), 56); ?>
               </div>
               <div>
                  <p class="head">About The Author</p>
                  <p class="name"><?php the_author_posts_link(); ?></p>
                  <p class="description"><?php echo esc_attr(get_the_author_meta('description')); ?></p>
               </div>
            </div>

            
            <?php wcr_related_posts(); ?>
         </div>

         <!-- Right Sidebar -->
         <div class="col-4">
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


<script>
   document.addEventListener('DOMContentLoaded', function () {
      const links = document.querySelectorAll('#dynamic-toc a');
      links.forEach(link => {
         link.addEventListener('click', function (e) {
               e.preventDefault();
               const targetId = this.getAttribute('href').substring(1);
               const targetElement = document.getElementById(targetId);
               if (targetElement) {
                  window.scrollTo({
                     top: targetElement.offsetTop - 100,
                     behavior: 'smooth'
                  });
               }
         });
      });
   });
</script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
      const tocLinks = document.querySelectorAll('#dynamic-toc a');
      const sections = Array.from(tocLinks).map(link => {
         const targetId = link.getAttribute('href').substring(1);
         return document.getElementById(targetId);
      });

      function setActiveLink() {
         let activeIndex = -1;
         const offset = 20;
         const fromTop = window.scrollY + offset;

         sections.forEach((section, index) => {
               if (section && section.offsetTop <= fromTop) {
                  activeIndex = index;
               }
         });

         tocLinks.forEach((link, index) => {
               if (index === activeIndex) {
                  link.classList.add('active');
               } else {
                  link.classList.remove('active');
               }
         });
      }
      window.addEventListener('scroll', setActiveLink);
      tocLinks.forEach(link => {
         link.addEventListener('click', function (e) {
               e.preventDefault();
               const targetId = this.getAttribute('href').substring(1);
               const targetElement = document.getElementById(targetId);
               if (targetElement) {
                  window.scrollTo({
                     top: targetElement.offsetTop - offset,
                     behavior: 'smooth'
                  });
               }
         });
      });
   });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Get all code blocks
    document.querySelectorAll("pre > code").forEach(function(codeBlock) {
        // Wrap in container
        const container = document.createElement("div");
        container.classList.add("code-container");
        codeBlock.parentNode.replaceWith(container);
        container.appendChild(codeBlock);

        // Create copy button
        const button = document.createElement("button");
        button.className = "copy-btn";
        button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                           <path d="M25.7168 5.05312C25.6584 4.78038 25.6119 4.50432 25.5403 4.23555C25.2431 3.10095 24.5774 2.09728 23.6477 1.38231C22.718 0.667331 21.5771 0.281597 20.4044 0.285739C16.9022 0.279103 13.4002 0.279103 9.89841 0.285739C6.88723 0.285739 4.54158 2.58449 4.52366 5.59463C4.49977 9.12107 4.49977 12.6473 4.52366 16.1733C4.54025 18.8755 6.44796 21.0395 9.11144 21.4304C9.37393 21.4669 9.63872 21.4842 9.90372 21.4822C13.3807 21.4853 16.8579 21.4853 20.3354 21.4822C22.9159 21.4775 25.0313 19.7926 25.596 17.3074C25.6438 17.099 25.6783 16.888 25.7188 16.6776L25.7168 5.05312ZM23.5934 10.8723C23.5934 12.5946 23.5934 14.3165 23.5934 16.0379C23.5985 16.2599 23.5841 16.482 23.5503 16.7015C23.261 18.2855 21.9803 19.356 20.3692 19.356C16.8922 19.3586 13.4152 19.3586 9.93822 19.356C8.01393 19.356 6.64171 17.977 6.64171 16.0518C6.64171 12.6081 6.64171 9.16464 6.64171 5.72138C6.64171 3.76904 7.99867 2.40332 9.94619 2.40332C13.3966 2.40332 16.8486 2.40332 20.3022 2.40332C20.509 2.39771 20.716 2.41015 20.9206 2.44048C22.5224 2.72385 23.5881 3.99267 23.5934 5.62582C23.5994 7.37908 23.5927 9.12571 23.5934 10.8723Z" fill="white"/>
                           <path d="M19.6061 25.718C19.6724 25.6855 19.7335 25.6517 19.7985 25.6198C20.2311 25.4207 20.462 24.99 20.403 24.501C20.3724 24.2822 20.2728 24.0789 20.1186 23.9207C19.9643 23.7625 19.7636 23.6577 19.5457 23.6217C19.4139 23.602 19.2808 23.5932 19.1476 23.5951C14.6597 23.5951 10.1719 23.5951 5.68414 23.5951C4.18253 23.5951 2.95364 22.7324 2.54887 21.3588C2.45035 21.0005 2.40277 20.6301 2.40753 20.2585C2.39824 15.7875 2.39515 11.3168 2.39824 6.84624C2.40419 6.65689 2.38091 6.46775 2.32923 6.28549C2.17064 5.79972 1.69289 5.52897 1.17068 5.59998C0.935955 5.63837 0.720921 5.75448 0.560051 5.92968C0.399183 6.10488 0.3018 6.32903 0.283514 6.56619C0.279531 6.62393 0.280195 6.68166 0.280195 6.74006C0.280195 11.2854 0.280195 15.8304 0.280195 20.3753C0.280195 22.9176 1.96694 25.0206 4.4433 25.5933C4.65962 25.643 4.87925 25.6775 5.09822 25.7194L19.6061 25.718Z" fill="white"/>
                           </svg>`;
        container.appendChild(button);

        // Add copy event
        button.addEventListener("click", function() {
            navigator.clipboard.writeText(codeBlock.textContent).then(function() {
                button.textContent = "Copied!";
                setTimeout(() => button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                           <path d="M25.7168 5.05312C25.6584 4.78038 25.6119 4.50432 25.5403 4.23555C25.2431 3.10095 24.5774 2.09728 23.6477 1.38231C22.718 0.667331 21.5771 0.281597 20.4044 0.285739C16.9022 0.279103 13.4002 0.279103 9.89841 0.285739C6.88723 0.285739 4.54158 2.58449 4.52366 5.59463C4.49977 9.12107 4.49977 12.6473 4.52366 16.1733C4.54025 18.8755 6.44796 21.0395 9.11144 21.4304C9.37393 21.4669 9.63872 21.4842 9.90372 21.4822C13.3807 21.4853 16.8579 21.4853 20.3354 21.4822C22.9159 21.4775 25.0313 19.7926 25.596 17.3074C25.6438 17.099 25.6783 16.888 25.7188 16.6776L25.7168 5.05312ZM23.5934 10.8723C23.5934 12.5946 23.5934 14.3165 23.5934 16.0379C23.5985 16.2599 23.5841 16.482 23.5503 16.7015C23.261 18.2855 21.9803 19.356 20.3692 19.356C16.8922 19.3586 13.4152 19.3586 9.93822 19.356C8.01393 19.356 6.64171 17.977 6.64171 16.0518C6.64171 12.6081 6.64171 9.16464 6.64171 5.72138C6.64171 3.76904 7.99867 2.40332 9.94619 2.40332C13.3966 2.40332 16.8486 2.40332 20.3022 2.40332C20.509 2.39771 20.716 2.41015 20.9206 2.44048C22.5224 2.72385 23.5881 3.99267 23.5934 5.62582C23.5994 7.37908 23.5927 9.12571 23.5934 10.8723Z" fill="white"/>
                           <path d="M19.6061 25.718C19.6724 25.6855 19.7335 25.6517 19.7985 25.6198C20.2311 25.4207 20.462 24.99 20.403 24.501C20.3724 24.2822 20.2728 24.0789 20.1186 23.9207C19.9643 23.7625 19.7636 23.6577 19.5457 23.6217C19.4139 23.602 19.2808 23.5932 19.1476 23.5951C14.6597 23.5951 10.1719 23.5951 5.68414 23.5951C4.18253 23.5951 2.95364 22.7324 2.54887 21.3588C2.45035 21.0005 2.40277 20.6301 2.40753 20.2585C2.39824 15.7875 2.39515 11.3168 2.39824 6.84624C2.40419 6.65689 2.38091 6.46775 2.32923 6.28549C2.17064 5.79972 1.69289 5.52897 1.17068 5.59998C0.935955 5.63837 0.720921 5.75448 0.560051 5.92968C0.399183 6.10488 0.3018 6.32903 0.283514 6.56619C0.279531 6.62393 0.280195 6.68166 0.280195 6.74006C0.280195 11.2854 0.280195 15.8304 0.280195 20.3753C0.280195 22.9176 1.96694 25.0206 4.4433 25.5933C4.65962 25.643 4.87925 25.6775 5.09822 25.7194L19.6061 25.718Z" fill="white"/>
                           </svg>`, 1500);
            }).catch(function(err) {
                console.error("Failed to copy: ", err);
            });
        });
    });
});
</script>


<?php get_footer(); ?>
