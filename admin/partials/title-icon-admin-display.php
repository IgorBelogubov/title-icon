<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Title_Icon
 * @subpackage Title_Icon/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
 <form method="post" name="my_options" action="options.php">
 
        <?php

        // Загрузить все значения элементов формы
        $options = get_option($this->title_icon);

        // текущие состояние опций
        $footer_text = $options['footer_text'];
		$postslist = $options['postslist'];
		$postsicon = $options['postsicon'];
		$position = $options['position'];

        // Выводит скрытые поля формы на странице настроек
        settings_fields( $this->title_icon );
        do_settings_sections( $this->title_icon );
		
		global $post;
		
		// параметры по умолчанию
		$posts = get_posts( array(
			'orderby'     => 'date',
			'order'       => 'DESC',
			'post_type'   => 'post',
			'suppress_filters' => true,
		) );      
        ?>

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

		<fieldset>
            <legend class="screen-reader-text"><span><?php echo esc_attr_e('Select posts:', $this->title_icon);?></span></legend>
            <label for="<?php echo $this->title_icon;?>-postslist">
                <span><?php esc_attr_e('Select posts:', $this->title_icon);?></span>
            </label>
            <select multiple
                   class="regular-text" id="<?php echo $this->title_icon;?>-postslist"
                   name="<?php echo $this->title_icon;?>[postslist][]"
                   />
			<?php foreach( $posts as $post ){ 
				setup_postdata($post);
			?>
				<option <?php foreach( $postslist as $postlist ) { 
				if ($postlist == $post->ID) { ?> selected <?php } } ?>
					value="<?php echo $post->ID; ?>"><?php the_title(); ?></option>
			<?php } 
				wp_reset_postdata(); // сброс
			?>
			</select>
        </fieldset>
		
		<fieldset>
            <legend class="screen-reader-text"><span><?php echo esc_attr_e('Select icon:', $this->title_icon);?></span></legend>
            <label for="<?php echo $this->title_icon;?>-postsicon">
                <span><?php esc_attr_e('Select icon:', $this->title_icon);?></span>
            </label>
			
				<span class="dashicons dashicons-shield"></span>
				<input type="radio" class="regular-text" id="<?php echo $this->title_icon;?>-postsicon"
                   name="<?php echo $this->title_icon;?>[postsicon]"
				<?php if ($postsicon == "dashicons-shield") { ?> checked <?php } ?>
					value="dashicons-shield">
					
				<span class="dashicons dashicons-location-alt"></span>
				<input type="radio" class="regular-text" id="<?php echo $this->title_icon;?>-postsicon"
                   name="<?php echo $this->title_icon;?>[postsicon]" 
				<?php if ($postsicon == "dashicons-location-alt") { ?> checked <?php } ?>
				value="dashicons-location-alt">
				
				<span class="dashicons dashicons-vault"></span>
				<input type="radio" class="regular-text" id="<?php echo $this->title_icon;?>-postsicon"
                   name="<?php echo $this->title_icon;?>[postsicon]"
			<?php if ($postsicon == "dashicons-vault") { ?> checked <?php } ?>
				value="dashicons-vault">
        </fieldset>
		
		<fieldset>
            <legend class="screen-reader-text"><span><?php _e('Icon position:', $this->title_icon);?></span></legend>
            <label for="<?php echo $this->title_icon;?>-position">
                <span><?php esc_attr_e('Icon position:', $this->title_icon);?></span>
            </label>
			<span><?php esc_attr_e('Left', $this->title_icon);?></span>
            <input type="radio" 
				   <?php if ($position == "left") { ?> checked <?php } ?>
                   class="regular-text" id="<?php echo $this->title_icon;?>-position"
                   name="<?php echo $this->title_icon;?>[position]"
                   value="left"
            />
			<span><?php esc_attr_e('Right', $this->title_icon);?></span>
			<input type="radio"
				   <?php if ($position == "right") { ?> checked <?php } ?>
                   class="regular-text" id="<?php echo $this->title_icon;?>-position"
                   name="<?php echo $this->title_icon;?>[position]"
                   value="right"
            />
        </fieldset>

        <?php submit_button(__('Save all changes', $this->title_icon), 'primary','submit', TRUE); ?>

  </form>