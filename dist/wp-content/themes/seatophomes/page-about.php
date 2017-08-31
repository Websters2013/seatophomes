<?php
/*
Template Name: About
*/
get_header();
$post_id = 9;

$title = get_field('team_title', $post_id);
if (!empty($title)) {
	$title = '<h3 class="team__title">'.$title.'</h3>';
}
$team = get_field('member', $post_id);
$team_string = '';
if(!empty($team)) {
    foreach ($team as $row) {
        $image = $row['image'];
        $team_string .= '<div class="team__item">
                <div class="team__preview">
                    <img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
                </div>
                <div class="team__content">'.$row['content'].'</div>
            </div>';
    }
}

$title_vision = get_field('title_vision', $post_id);
if (!empty($title_vision)) {
	$title_vision = '<h3 class="team__title">'.$title_vision.'</h3>';
}
$vision = get_field('vision', $post_id);
$vision_string = '';
if (!empty($vision)) {
    foreach ($vision as $row) {
        $vision_string .= '<div class="team__item">
                <div class="team__content">'.$row['content'].'</div>
            </div>';
    }
}
?>

    <!-- team -->
    <div class="team">

        <?= $title_vision; ?>
        <div class="team__wrap">
            <?= $vision_string; ?>
        </div>



        <?= $title; ?>
        <div class="team__wrap">
            <?= $team_string; ?>
        </div>

    </div>
    <!-- /team -->

<?php get_footer();