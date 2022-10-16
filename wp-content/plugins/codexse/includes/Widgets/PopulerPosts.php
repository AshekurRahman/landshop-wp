<?php

namespace Codexse\Widgets;
use WP_Widget;
use WP_Query;


class PopulerPosts extends WP_Widget
{
    function __construct(){
        parent::__construct(
            // Base ID of your widget
            'PopulerPosts', 
            // Widget name will appear in UI
            esc_html__('Popular Posts', 'codexse'),
            // Widget description
            array( 'description' => esc_html__( 'Popular posts widget.', 'codexse' ), ) 
        );
    }
    
    public function widget( $args, $instance ){  
        wp_enqueue_style( 'PopulerPosts' );
        $number = isset($instance['number']) ? $instance['number'] : 5 ;
        $title_length = isset($instance['title_length']) ? $instance['title_length'] : 5 ;
        $show_meta = isset($instance['show_meta']) ? $instance['show_meta'] : '' ;
        $show_thumb = isset($instance['show_thumb']) ? $instance['show_thumb'] : '' ;
        
        echo $args['before_widget']; 
        if( !empty($instance['title']) ){
            echo $args['before_title'] . $instance['title'] . $args['after_title'];
        }

        echo '<div class="popular-posts">';
        $posts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => $number,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC' 
        ));
            
        if( $posts->have_posts() ):
            while( $posts->have_posts() ):
                $posts->the_post();        
                $cats = get_the_category();                
                echo '<div class="post-item" >';
                    if(has_post_thumbnail() and $show_thumb == 'on'):
                        echo '<a href="'.get_the_permalink().'" class="thumb" >';
                            the_post_thumbnail('thumbnail');
                        echo '</a>';
                    endif;
                    echo '<div class="post-content">';
                        if(get_the_title()){
                            echo '<h4 class="title">';
                                echo '<a href="'.get_the_permalink().'" >';
                                    echo wp_trim_words( get_the_title(), $title_length, '' );
                                echo '</a>';
                            echo '</h4>';
                        }
                        if($show_meta == 'on'){
                            echo '<ul>';
                                echo '<li>';
                                    echo '<span class="icon" ><svg class="svg-icon"><use xlink:href="'.get_theme_file_uri( 'assets/images/symble.svg#ic-clock' ).'"></use></svg></span>';
                                    echo '<span class="value">'. get_the_date('D M Y') .'</span>';
                                echo '</li>';
                            echo '</ul>';
                        }
                    echo '</div>';
                echo '</div>';            
            endwhile;
        endif;
        echo '</div>';
        echo $args['after_widget'];
    }

    public function form( $instance ){
        $title      = (isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '' );
        $number     = (isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : 5 );
        $title_length     = (isset( $instance[ 'title_length' ] ) ? $instance[ 'title_length' ] : 5 );
        $show_meta  = (isset( $instance[ 'show_meta' ] ) ? $instance[ 'show_meta' ] : 'on' );        
        $show_thumb = (isset( $instance[ 'show_thumb' ] ) ? $instance[ 'show_thumb' ] : 'on' );
        echo '<p>';
            echo '<label for="'. $this->get_field_id('title') .'">';
                esc_html_e( 'Title:','codexse' );
            echo '</label>';
            echo '<input class="widefat" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" type="text" value="'.esc_attr( $title ).'" />';
        echo '</p>';
        echo '<p>';
            echo '<label for="'. $this->get_field_id( 'title_length' ) .'">';
                esc_html_e('Post Title Length:','codexse');
            echo '</label>';
            echo '<input class="tiny-text" id="'.$this->get_field_id( 'title_length' ).'" name="'.$this->get_field_name( 'title_length' ).'" type="number" step="1" value="'.esc_attr( $title_length ).'" size="3" />';
        echo '</p>';        
        echo '<p>';
            echo '<label for="'. $this->get_field_id( 'number' ) .'">';
                esc_html_e('Number of posts to show:','codexse');
            echo '</label>';
            echo '<input class="tiny-text" id="'.$this->get_field_id( 'number' ).'" name="'.$this->get_field_name( 'number' ).'" type="number" step="1" value="'.esc_attr( $number ).'" size="3" />';
        echo '</p>';    
        echo '<p>';
            echo '<input class="checkbox" type="checkbox" id="'.$this->get_field_id( 'show_meta' ).'" name="'.$this->get_field_name( 'show_meta' ).'" '.( $show_meta=='on' ? 'checked' : '' ).' />';
            echo '<label for="'. $this->get_field_id( 'show_meta' ) .'">';
                esc_html_e('Display Post Meta?','codexse');
            echo '</label>';
        echo '</p>';
        echo '<p>';
            echo '<input class="checkbox" type="checkbox" id="'.$this->get_field_id( 'show_thumb' ).'" name="'.$this->get_field_name( 'show_thumb' ).'" '.( $show_thumb=='on' ? 'checked' : '' ).' />';
            echo '<label for="'. $this->get_field_id( 'show_thumb' ) .'">';
                esc_html_e('Display Post Thumbnail?','codexse');
            echo '</label>';
        echo '</p>';
    }   

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? esc_html( $new_instance['number'] ) : '';
        $instance['title_length'] = ( ! empty( $new_instance['title_length'] ) ) ? esc_html( $new_instance['title_length'] ) : '';
        $instance['show_meta'] = ( ! empty( $new_instance['show_meta'] ) ) ? esc_html( $new_instance['show_meta'] ) : '';
        $instance['show_thumb'] = ( ! empty( $new_instance['show_thumb'] ) ) ? esc_html( $new_instance['show_thumb'] ) : '';
        return $instance;
    }
}
