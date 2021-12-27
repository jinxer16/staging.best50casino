<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php include(locate_template('common-templates/main-menu.php', false, false)); ?>
<div class="container body-bg">
    <div class="row page-bg page-shadow pt-10p">
                <div class="d-flex flex-wrap">
                    <div class="col-lg-9-extra col-md-12 col-sm-12 col-xs-12 text-justify colmain main twocols">
                        <?php
                        while ( have_posts() ) : the_post(); ?>
                        <h1 class="star"><span><?php the_title(); ?></span></h1>
                        <?php
                            the_content();
                        endwhile;?>
                            <div class="d-flex flex-wrap w-100 mb-5p no-pad no-pad-mobile" style="height: 60px;">
                                <div class="w-30 w-sm-30 no-pad no-pad-mobile d-flex flex-wrap justify-content-center bg-primary position-relative">
                                    <div class="arrow-right">
                                    </div>
                                    <p class="text-center d-none d-md-block d-lg-block d-xl-block text-21 pt-10p text-white font-weight-bold align-self-center">Choose category </p>
                                    <p class="d-block d-md-none d-lg-none d-xl-none text-21 pt-7p pl-15p text-14 text-white font-weight-bold align-self-center ">Choose category </p>
                                </div>
                                <div class="w-40 w-sm-70 justify-content-center  pl-5p d-flex">
                                    <!--                <div class="d-block w-100 pt-2p">-->
                                    <!--                    <label for="filter-posts w-100 d-block" class="text-dark text-18">Επίλεξε άρθρα ανά:</label>-->
                                    <!--                </div>-->
                                    <select  name="filter-guides" onchange="filter_guides(event,this)" class="select-style align-self-center shadow">
                                        <option value="all">All Guides</option>
                                        <?php
                                        $terms = get_terms( array(
                                            'taxonomy' => 'cat-guides',
                                            'hide_empty' => false,
                                        ));
                                        foreach ($terms as $term){
                                            ?>
                                            <option value="<?=$term->term_id;?>"><?=$term->name;?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="w-30 no-pad no-pad-mobile position-relative d-xl-flex d-lg-flex d-none justify-content-center bg-primary ">
                                    <div class="arrow-left">

                                    </div>
                                    <img  style="width: 50px;"
                                         src="<?php echo get_stylesheet_directory_uri() . '/assets/images/manual.png'; ?>" loading="lazy" class="img-fluid align-self-center d-xl-inline-block d-lg-inline-block d-none">
                                </div>
                    </div>


                        <div class="guides-result d-flex flex-wrap ">
                            <?php
                            $query_args = array(
                                'post_type' => array('kss_guides','page'),
                                'post_status' => 'publish',
                                'posts_per_page' => 999,
                                'fields' => 'ids',
                                'tax_query'  => array(
                                    array(
                                        'taxonomy' => 'cat-guides',
                                        'operator' => 'EXISTS',
                                    )
                                )
                            );
                            $guides = get_posts($query_args);
                            foreach ($guides as $guide){?>
                      <div class="col-12 d-flex flex-row col-md-6 col-lg-4 col-xl-4 post-offer text-dark text-center d-flex text-15 pt-xl-2 pt-lg-2" style="background-color: #efefef;">
                             <div class="post-offer-content overflow-hidden bg-white">
                                  <div class="thumbnail-image ">
                                    <img loading="lazy" src="<?php  echo get_the_post_thumbnail_url($guide);?>">
                               </div>
                            <div class="entry-title bg-white p-10p d-flex align-items-center justify-content-center">
                      <div class="offer-title">
                      <a class="align-self-center pl-1 pl-xl-0 text-decoration-none"  style="color: black;" id="title-blog" href="<?php echo get_the_permalink($guide); ?>">
                          <?php echo  wp_trim_words(get_the_title($guide), 6);?>
                      </a>
                        </div>
                            <div class="button d-inline-block">
                              <a class="d-block text-12 pt-5p pr-10p pb-5p pl-10p text-decoration-none text-dark w-70 m-0 font-weight-bold position-absolute" href="<?php echo get_the_permalink($guide); ?>">
                                  Read Guide </a> <!--<span class="fa fa-arrow-circle-right"></span>-->
                            </div>
                              </div>
                                 </div>
                      </div>
                           <?php
                                }
                            ?>
                        </div>

                    </div>

                    <div class="col-lg-3-extra col-xl-3-extra col-md-12 col-12 d-md-none d-lg-block d-xl-block col-sm-12 col-xs-12 sidenav">
                        <?php get_sidebar('right');?>
                    </div>

                </div>
<!--        --><?php //get_template_part("templates/common/promotions_notifications");?>
        </div>
    </div>

<?php get_footer(); ?>
