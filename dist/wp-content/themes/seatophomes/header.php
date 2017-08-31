<?php
$post_id = 2;
$dinamic_id = get_the_ID();

$menu_name = 'menu';
$locations = get_nav_menu_locations();
$menu_list = '';
if( $locations && isset($locations[ $menu_name ]) ){

	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menu_items = wp_get_nav_menu_items( $menu );
	$menu_list = '<!-- menu --><nav class="menu"><ul>';

	foreach ( (array) $menu_items as $key => $menu_item ){

		$perm = get_the_permalink($menu_item->object_id);
		$active = '';
		if (is_page( $menu_item->object_id)) {
			$active = ' active ';
		}

		$menu_list .= '<li class="menu__item"><a class="'.$active.'" href="'.$perm.'">'.strtolower($menu_item->title).'</a></li>';
	}

	$menu_list .= '</ul></nav><!-- menu -->';

}

$logo = get_field('logo', $post_id);
$logo_string = '';
if(!empty($logo)) {
    $logo_string = '<img src="'.$logo['url'].'" alt="'.$logo['alt'].'" title="'.$logo['title'].'">';
    if(is_front_page()) {
	    $logo_string = '<h1 class="logo">'.$logo_string.'</h1>';
    } else {
	    $logo_string = '<a href="'.get_site_url().'" class="logo">'.$logo_string.'</a>';
    }
}

$video_id = get_field('video_id', $dinamic_id);
$hero_title = get_field('hero_title', $dinamic_id);
if(!empty($hero_title)) {
    $hero_title = '<h1>'.$hero_title.'</h1>';
}
$hero_description = get_field('hero_description', $dinamic_id);
if(!empty($hero_description)) {
	$hero_description = '<p>'.$hero_description.'</p>';
}
$hero_content = get_field('hero_content', $dinamic_id);
if(!empty($hero_content)) {
    $hero_content = '<div>'.$hero_content.$hero_description.'</div>';
}


$class_promo = '';
if(is_page(12) || is_page(14)) {
    $class_promo = ' promo_2';
}
$promo_title = get_field('promo_title', $dinamic_id);
if($promo_title) {
    $promo_title = '<h2>'.$promo_title.'</h2>';
}
$promo_content = get_field('promo_content', $dinamic_id);
if($promo_content) {
    $promo_content = '<div>'.$promo_content.'</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">

    <title>Title</title>
    <?php wp_head(); ?>
</head>
<body data-mail="<?= get_template_directory_uri() .'/mail.php'; ?>">

<!-- site -->
<div class="site">

    <div class="site__header">

        <div class="site__header-layout">

            <?= $logo_string; ?>

            <?= $menu_list; ?>

            <!-- menu-btn -->
            <div class="menu-btn">
                <span></span>
            </div>
            <!-- /menu-btn -->

        </div>

    </div>

     <?php if((is_front_page() || is_page(9)) && $video_id) {?>
    <!-- hero -->
    <div class="hero">

        <!-- hero__video -->
        <div class="hero__video" data-video="<?= $video_id; ?>">
            <div class="video-bg"></div>
        </div>
        <!-- /hero__video -->

        <!-- hero__layout -->
        <div class="hero__layout">

            <!-- hero__content -->
            <div class="hero__content">

                <?= $hero_title; ?>

                <?= $hero_content; ?>

            </div>
            <!-- /hero__content -->

        </div>
        <!-- /hero__layout -->

    </div>
    <!-- /hero -->
    <?php } ?>

    <?php if(is_front_page() || is_page(12) || is_page(14)) {?>
    <!-- promo -->
    <section class="promo<?= $class_promo; ?>">

        <div class="promo__wrap">

            <?= $promo_title; ?>

            <?= $promo_content; ?>

        </div>

    </section>
    <!-- /promo -->
    <?php } ?>
