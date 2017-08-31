<?php
/*
Template Name: Home
*/
get_header();
$post_id = 2;

$categories = get_field('categories', $post_id);
$categories_string = '';
if(!empty($categories)) {

	foreach ($categories as $row) {
		if(!empty($row['items'])) {
			if($row['category_name']) {
				$categories_string .= '<!-- catalog --><div class="catalog"><h3 class="catalog__title">'.$row['category_name'].'</h3>';
			}
			$categories_string .= '<!-- catalog__wrap --><div class="catalog__wrap">';
			foreach ($row['items'] as $rows) {
				$link = $rows['url'];
				$title = $link['title'];
                $class = '';

				if($title) {
					$title = '<span>'.$title.'</span>';
				}

				if($rows['choice'] === '0') {
					$image = $rows['image'];
					$image_content = '<img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'">';
				} else {
					$image_content =  '<div class="video">'.$rows['video'].'</div>';
					$class = ' video';
				}
				if(empty($image)) {
					continue;
				}
				$categories_string .= '<a class="catalog__item">

				<div class="catalog__preview'.$class.'">
					'.$image_content.$title.'
				</div>

			</a>';
			}
			$categories_string .= '</div><!-- /catalog__wrap --></div><!-- /catalog -->';
		}
	}
}
?>

	<!-- map -->
	<div class="map">

		<div class="map__content">

			<h2><?= get_field('map_title', $post_id); ?></h2>

			<div><?= get_field('map_content', $post_id); ?></div>

		</div>

		<iframe src="<?= get_field('map', $post_id); ?>"></iframe>
	</div>
	<!-- /map -->

<?= $categories_string; ?>

<?php get_footer();