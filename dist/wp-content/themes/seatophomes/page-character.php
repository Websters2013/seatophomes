<?php
/*
Template Name: Character
*/
get_header();
$post_id = 12;

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
				$title = $rows['title'];
				$class = '';

				if($title) {
					$title = '<span>'.$title.'</span>';
				}

				if($rows['choice'] === '0') {
					$image = $rows['image'];
					$image_content = '<img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'">';
				} else {
					$image_content =  '<div class="video">'.$rows['video'].'</div>';
					$class = ' character video';
				}
				if(empty($image)) {
					continue;
				}
				$categories_string .= '<article class="catalog__item">

				<div class="catalog__preview'.$class.'">
					'.$image_content.'
				</div>
				<div class="catalog__content">
				    '.$title.'
				</div>

			</article>';
			}
			$categories_string .= '</div><!-- /catalog__wrap --></div><!-- /catalog -->';
		}
	}
}
echo $categories_string;
get_footer();