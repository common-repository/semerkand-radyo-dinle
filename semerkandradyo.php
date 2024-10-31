<?php
/*
 * Plugin Name: Semerkand Radyo Dinle 
 * Plugin URI: http://www.jn7.net
 * Description: Semerkand Radyoyu Site Kullanıcılarına Dinletmek İsteyenler İçin Kenarlık Bileşeni
 * Version: 1.0
 * Author: Halil İbrahim
 * Author URI: http://www.jn7.net
 */

//add function to widget_init to load
add_action( 'widgets_init', 'semerkand_radyo_widgets' );

//register widget
function semerkand_radyo_widgets() {
	register_widget( 'semerkand_radyo_widget' );
}

//widget class
class semerkand_radyo_widget extends WP_Widget {

	function semerkand_radyo_widget() {
	
		$widget_ops = array( 'classname' => 'widget_radyo', 'description' => __('Semerkand Radyoyu Site Kullanıcılarına Dinletmek İsteyenler İçin Kenarlık Bileşeni', 'semerkand') );
		$this->WP_Widget( 'semerkand_radyo_widget', __('Semerkand Radyo Dinle', 'semerkand'), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		//get values from widget.
		$title = apply_filters('widget_title', $instance['title'] );
		$genis = $instance['genis'];
		$yuksek = $instance['yuksek'];
		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;

				//<!-- Radyo Kodu Buraya Geliyor-->
	echo '	<p>
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="'.$genis.'" height="'.$yuksek.'" id="playerv2" align="middle">
		<param name="movie" value="http://www.semerkandradyo.com/radyo.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="transparent" />
		<param name="devicefont" value="false" />
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="FlashVars" value="var1=http://87.118.86.190:8216" />
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="http://www.semerkandradyo.com/radyo.swf" width="'.$genis.'" height="'.$yuksek.'">
			<param name="movie" value="http://www.canliradyodinle.web.tr/playerlar/crd.swf" />
			<param name="quality" value="high" />
			<param name="wmode" value="transparent" />
			<param name="devicefont" value="false" />
			<param name="allowScriptAccess" value="sameDomain" />
			<param name="FlashVars" value="var1=http://87.118.86.190:8216" />
			<!--<![endif]--> 
			<a href="http://www.adobe.com/go/getflash"> <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Flash player Yükle" /> </a> 
			<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
		</p>';	
		echo $after_widget;
	}// function widget

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['genis'] = $new_instance['genis'];
		$instance['yuksek'] = $new_instance['yuksek'];
		return $instance;
	}
	
	function form( $instance ) {
	
		$defaults = array(
		'title' => 'Semerkand Radyo Dinle',
		'genis' => '250',
		'yuksek' => '100',
		
		);
		$instance = wp_parse_args( (array) $instance, $defaults );?>
		<!-- Semerkand Radyo Logo -->
		<p>
			<?php
			echo '<img src="' . plugins_url( '/semerkandlogo.png' , __FILE__ ) . '" > ';
			?>
			
		</p>
		<!-- widget title -->
		<p>
			
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Başlık:', 'semerkand') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<!-- Genişlik-->
		<p>
			<label for="<?php echo $this->get_field_id( 'genis' ); ?>"><?php _e('Genişliği Giriniz:', 'gazpo') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'genis' ); ?>" name="<?php echo $this->get_field_name( 'genis' ); ?>" value="<?php echo $instance['genis']; ?>" />
		</p>
		
		<!-- Yükseklik -->
		<p>
			<label for="<?php echo $this->get_field_id( 'yuksek' ); ?>"><?php _e('Yüksekliği Giriniz:', 'gazpo') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'yuksek' ); ?>" name="<?php echo $this->get_field_name( 'yuksek' ); ?>" value="<?php echo $instance['yuksek']; ?>" />
		</p>
		
	<?php }
}?>