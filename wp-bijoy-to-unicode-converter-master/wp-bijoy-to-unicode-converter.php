<?php
/**
 * Plugin Name: WP Bijoy to Unicode Converter
 * Plugin URI: http://nanodesignsbd.com/wordpress-bijoy-to-unicode-converter
 * Description: A one-click ASCII Bangla (Bengali) to Unicode Bangla (Bengali) converter that can convert Bijoy (ASCII) Bangla (Bengali) texts into Unicode Bangla (Bengali). It can covert Bijoy ASCII texts into Unicode with a single click in WordPress post or page editor - in Text mode, and in Title field. The basic of the plugin was done by <a href="https://github.com/nishiafia">Ms. Tahmina Aktar</a>, based on the Javascripts of Online Unicode Converter by <a href="http://bnwebtools.sourceforge.net/">S. M. Mahbub Morshed</a>. Then it was verified, modified, simplified, and made translation-ready, and finally as a plugin by <a href="https://github.com/mayeenulislam">Mayeenul Islam</a> from <a href="http://nanodesignsbd.com">nanodesigns</a>.
 * Version: 1.0
 * Author: Tahmina Aktar, Mayeenul Islam
 * Author URI: http://nanodesignsbd.com
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


/*  Copyright 2014 nanodesigns (email: info@nanodesignsbd.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    any later version.

    This plugin is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

/**
* PLUGIN'S COMMON PROPERTIES
*/
define( "B2UCTEXTDOMAIN", "'b2uc'" );



/**
* PLUGIN CODE STARTED
*/


/**
* LOAD THE NECESSARY SCRIPTS AND STYLES
*/

add_action('admin_enqueue_scripts', 'scripts_for_converter');   

function scripts_for_converter() {

    wp_register_script('common-scripts', plugins_url('js/common-scripts.js', __FILE__) ); //by S. M. Mahbub Morshed
    wp_register_script('converter-scripts', plugins_url('js/converter-scripts.js', __FILE__) ); //by S. M. Mahbub Morshed
    wp_register_script('custom-scripts', plugins_url('js/custom-scripts.js', __FILE__) );

    wp_register_style( 'converter-style', plugins_url('style.css', __FILE__) );

    $this_screen = get_current_screen();
    //load the script only for post and page edit screen
    if( $this_screen->id == 'post' || $this_screen->id == 'page' ) {
        wp_enqueue_script('common-scripts');
        wp_enqueue_script('converter-scripts');
        wp_enqueue_script('custom-scripts');

        wp_enqueue_style( 'converter-style' );
    }

}


/**
* ADD THE META BOX
* Add the Meta box to the Right side of the 'Add New' page
*/

add_action('admin_init','b2uc_create_the_meta_box');
 
function b2uc_create_the_meta_box() { 

    $screens = array( 'post', 'page' );

    foreach ( $screens as $screen) {
        add_meta_box(
            'b2uc_meta',
            'ইউনিকোড কনভার্টার',
            'b2uc_meta_box_setup',
            $screen,
            'side',
            'high'
            );
    }
}


/**
* SET UP THE META BOX
* Put the converter in action
*/

function b2uc_meta_box_setup() {
    global $post;

    echo '<div class="b2uc-meta-control">';
        echo '<p>';
            echo '<img src="'. plugins_url('images/select-text-mode.gif', __FILE__)  .'" alt="Get to Text mode"/>';
            echo __( 'এই কনভার্টারটি কাজ করে যখন আপনি আপনার এডিটরটিকে <strong>Text</strong> মোডে নিয়ে যাবেন। আগে Text মোডে গিয়ে লেখা পেস্ট করুন, তারপর কনভার্ট হয়ে যাবার পর আপনি আবার Visual মোডে ফেরত আসতে পারেন। (Visual এডিটর বন্ধ থাকলে, এর প্রয়োজন নেই।)', B2UCTEXTDOMAIN );
            echo '<div class="b2uc-clearfix"></div>';
            echo '<input type="button" class="metabox-submit button button-primary button-large" value="'. __('বদলে নাও', B2UCTEXTDOMAIN) .'" onclick="convert_text()" />';
        echo '</p>';
    echo '</div>';
    echo '<input type="hidden" name="b2uc_meta_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}

// Filter will disable the editor by default

//add_filter( 'user_can_richedit' , '__return_false', 50 );
