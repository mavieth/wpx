<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

function get_page_icons($posttags){





}


function iphone(){
  // start the string with 3 <'s and then a word
  // it doesn't have to be any particular string or length
  // but it's common to make it in all caps.
  $html = "";

    $html.= '<div id="iphone-shadow">';
        $html.= '<div id="iphone">';
            $html.= '<div id="shadow"></div>';
            $html.= '<div id="side"></div>';
            $html.= '<div id="lines">';
                $html.= '<div>';
                    $html.= '<div>';
                        $html.= '<div></div>';
                    $html.= '</div>';
                $html.= '</div>';
                $html.= '<div>';
                    $html.= '<div>';
                        $html.= '<div></div>';
                    $html.= '</div>';
                $html.= '</div>';
            $html.= '</div>';
            $html.= '<div id="toggler">';
                $html.= '<div></div>';
            $html.= '</div>';
            $html.= '<div id="aux"></div>';
            $html.= '<div id="lightning"></div>';
            $html.= '<div id="bottom-speaker">';
                $html.= '<div></div>';
                $html.= '<div></div>';
                $html.= '<div></div>';
                $html.= '<div></div>';
                $html.= '<div></div>';
                $html.= '<div></div>';
                $html.= '<div></div>';
            $html.= '</div>';
            $html.= '<div id="skrews">';
                $html.= '<div></div>';
                $html.= '<div></div>';
            $html.= '</div>';
            $html.= '<div id="volume">';
                $html.= '<div></div>';
                $html.= '<div></div>';
            $html.= '</div>';
            $html.= '<div id="front">';
                $html.= '<div id="front-cover"></div>';
                $html.= '<div id="camera">';
                    $html.= '<div></div>';
                $html.= '</div>';
                $html.= '<div id="speaker"></div>';
                $html.= '<div id="screen">';
                    $html.= '<div id="reminder">';
                        $html.= '<div></div>';
                        $html.= '<div>';
                            $html.= 'By Michael Vieth';
                        $html.= '</div>';
                        $html.= '<div>';
                            $html.= 'now';
                        $html.= '</div>';
                    $html.= '</div>';
                    $html.= '<div id="circle"></div>';
                    $html.= '<div id="time">';
                        $html.= '12:42';
                    $html.= '</div>';
                    $html.= '<div id="date">';
                        $html.= 'Saturday, January 4';
                    $html.= '</div>';
                    $html.= '<div id="bottom"></div>';
                    $html.= '<div id="top"></div>';
                    $html.= '<div id="slide">';
                        $html.= '<div></div>slide to unlock';
                    $html.= '</div>';
                    $html.= '<div id="signal">';
                        $html.= '<div></div>';
                        $html.= '<div></div>';
                        $html.= '<div></div>';
                        $html.= '<div></div>';
                        $html.= '<div></div>';
                    $html.= '</div>';
                    $html.= '<div id="battery">';
                        $html.= '<div>';
                            $html.= '86%';
                        $html.= '</div>';
                        $html.= '<div>';
                            $html.= '<div></div>';
                            $html.= '<div></div>';
                        $html.= '</div>';
                    $html.= '</div>';
                $html.= '</div>';
                $html.= '<div id="home">';
                    $html.= '<div></div>';
                $html.= '</div>';
            $html.= '</div>';
        $html.= '</div>';
  return $html;

}