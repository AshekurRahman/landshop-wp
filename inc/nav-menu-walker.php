<?php
class Landshop_Desktop_Menu_Walker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        global $wp_query;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));

        $class_names = ' class="' . esc_attr($class_names) . ' nav-item"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';

        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';

        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

        if (landshop_detect_homepage() == true) {

            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        } else {

            if ($item->type_label == 'Custom Link' and strpos($item->url, '#') === 0) {

                $attributes .= !empty($item->url) ? ' href="' . get_site_url() . esc_attr($item->url) . '"' : '';

            } else {

                $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

            }

        }

        $item_output = $args->before;

        $item_output .= '<a' . $attributes . ' class="nav-link">';

        $item_output .= '<span class="nav__icon">' . do_shortcode($item->description) . '</span>';

        $item_output .= $args->link_before . do_shortcode(apply_filters('the_title', $item->title, $item->ID)) . $args->link_after;

        // Check if the current item has children
        if ($args->walker->has_children) {
            $item_output .= '<span class="collapse__menu"><i class="fa-regular fa-plus"></i></span>';
        }

        $item_output .= '</a>';

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

class Landshop_Mobile_Menu_Walker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {

        global $wp_query;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $class_names = $value = '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));

        $class_names = ' class="' . esc_attr($class_names) . ' nav-item"';

        $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';

        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';

        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

        if (landshop_detect_homepage() == true) {

            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        } else {

            if ($item->type_label == 'Custom Link' and strpos($item->url, '#') === 0) {

                $attributes .= !empty($item->url) ? ' href="' . get_site_url() . esc_attr($item->url) . '"' : '';

            } else {

                $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

            }

        }

        $item_output = $args->before;

        $item_output .= '<a' . $attributes . ' class="nav-link">';

        $item_output .= '<span class="nav__icon">' . do_shortcode($item->description) . '</span>';

        $item_output .= $args->link_before . do_shortcode(apply_filters('the_title', $item->title, $item->ID)) . $args->link_after;

        $item_output .= '</a>';

        // Check if the current item has children
        if ($args->walker->has_children) {
            $item_output .= '<button class="collapse__menu"><i class="fa-regular fa-plus"></i></button>';
        }

        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}
