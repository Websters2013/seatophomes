<?php
/*
Template Name: Contact
*/
get_header();
$post_id = 14;
$ask_join = get_field('ask_join', $post_id);
$ask_join_string= '';
if(!empty($ask_join )) {
	foreach ($ask_join as  $row) {
		$image = $row['image'];
		if(empty($image)) {
			continue;
		}
		$ask_join_string .= '<div class="about__item">

				<div class="about__preview">
					<img src="'.$image['url'].'" alt="'.$image['alt'].'" title="'.$image['title'].'"/>
				</div>

				<div class="about__content">'.$row['content'].'</div>

			</div>';
	}
}

$option = get_field('option', $post_id);
$option_string = '';
if(!empty($option)) {
   foreach ($option as $row) {
	   $option_string .= '<option value="'.$row['item'].'">'.$row['item'].'</option>';
   }
}
?>

	<!-- about -->
	<div class="about">

		<h3 class="about__title"><?= get_field('title', $post_id); ?></h3>

		<!-- about__wrap -->
		<div class="about__wrap">

			<?= $ask_join_string; ?>

		</div>
		<!-- /about__wrap -->

	</div>
	<!-- /about -->

    <!-- contacts__form -->
    <form method="get" action="/" class="contacts__form validation-form">

        <h3 class="about__title"><?= get_field('form_title', $post_id); ?></h3>

        <div class="contacts__fieldset">

            <span>I am contacting about:</span>
            <select name="about">
                <?= $option_string; ?>
            </select>

        </div>

        <label class="contacts__fieldset">
            <span>Name:</span>
            <input type="text" name="name" data-required />
        </label>

        <label class="contacts__fieldset">
            <span>Company:</span>
            <input type="text" name="company" data-required />
        </label>

        <label class="contacts__fieldset">
            <span>Email:</span>
            <input type="email" name="email" data-required />
        </label>

        <label class="contacts__fieldset">
            <span>Phone:</span>
            <input type="tel" name="phone" data-required />
        </label>

        <label class="contacts__fieldset contacts__fieldset_1">
            <span>Message:</span>
            <textarea name="message" data-required></textarea>
        </label>

        <label class="nice-checkbox">
            <input type="checkbox" data-required/>
            <span>I agree to receiving emails from SeaTop Homes</span>
        </label>

        <div class="contacts__btn-wrap">
            <button type="submit"><span>Send</span></button>
        </div>

        <div class="contacts__message-wrap">

            <div class="contacts__message contacts__message_error"><?= get_field('message_error', $post_id); ?></div>
            <div class="contacts__message contacts__message_success"><?= get_field('message_success', $post_id); ?></div>

        </div>

    </form>
    <!-- contacts__form -->

<?php get_footer();