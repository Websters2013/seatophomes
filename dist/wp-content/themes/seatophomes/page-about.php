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
?>

    <!-- team -->
    <div class="team">

        <?= $title; ?>

        <!-- team__wrap -->
        <div class="team__wrap">

            <?= $team_string; ?>

        </div>
        <!-- /team__wrap -->

    </div>
    <!-- /team -->

<?php get_footer();