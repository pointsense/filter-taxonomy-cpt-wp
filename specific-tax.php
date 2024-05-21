<?php
//source : https://rudrastyh.com/wordpress/filter-posts-by-terms.html
//Below is the code that allows to add a taxonomy filter for a specific taxonomy:
add_action( 'restrict_manage_posts', 'rudr_taxonomy_filter' );

function rudr_taxonomy_filter( $post_type ) {

	// do nothing it it is not a post type we need
	if( 'lesson' !== $post_type ) {
		return;
	}
	
	$taxonomy_name = 'course_category';

	// get all terms of a specific taxonomy
	$courses = get_terms( 
		array( 
			'taxonomy' => $taxonomy_name, 
			'hide_empty' => false
		)
	);
	// selected taxonomy from URL
	$selected = isset( $_GET[ $taxonomy_name ] ) && $_GET[ $taxonomy_name ] ? $_GET[ $taxonomy_name ] : '';
	
	if( $courses ) {
		?>
			<select name="<?php echo $taxonomy_name ?>">
				<option value="">All courses</option>
				<?php
					foreach ( $courses as $course ) {
						?><option value="<?php echo $course->slug ?>"<?php selected( $selected, $course->slug ) ?>><?php echo $course->name ?></option><?php
					}
				?>
			</select>
		<?php
	}
}
