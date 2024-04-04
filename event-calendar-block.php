<?php
/**
 * Plugin Name: Event Calendar Block
 * Description: A custom Gutenberg block for managing events visually and a corresponding shortcode.
 * Version: 1.0
 * Author: Omomoh Agiogu
 * Author URI: https://www.example.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: event-calendar-block
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Event_Calendar_Block {
    public function __construct() {
        add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_assets' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

        add_shortcode( 'event_calendar', array( $this, 'event_calendar_shortcode' ) );
    }

    public function enqueue_assets() {
        // Enqueue block editor assets.
        wp_enqueue_script(
            'event-calendar-block-editor',
            plugins_url( 'build/index.js', __FILE__ ),
            array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
            filemtime( plugin_dir_path( __FILE__ ) . 'build/index.js' )
        );

        wp_enqueue_style(
            'event-calendar-block-editor-style',
            plugins_url( 'build/style-index.css', __FILE__ ),
            array( 'wp-edit-blocks' ),
            filemtime( plugin_dir_path( __FILE__ ) . 'build/style-index.css' )
        );

        // Enqueue frontend assets.
        wp_enqueue_style(
            'event-calendar-block-style',
            plugins_url( 'src/style.scss', __FILE__ ),
            array(),
            filemtime( plugin_dir_path( __FILE__ ) . 'src/style.scss' )
        );
    }

    public function event_calendar_shortcode( $atts ) {
        // Extract shortcode attributes
        $atts = shortcode_atts( array(
            'title' => 'Event Calendar',
            'description' => 'Explore upcoming events.',
        ), $atts );

        $title = esc_html( $atts['title'] );
        $description = esc_html( $atts['description'] );

        // Fetch event data (replace this with your desired logic)
        $events = $this->get_events(); // Replace this with your function to fetch event data

        $output = '<div class="event-calendar">';
        $output .= '<h2>' . $title . '</h2>';
        $output .= '<p>' . $description . '</p>';

        // Check for events and display them
        if ( ! empty( $events ) ) {
            $output .= '<ul>';
            foreach ( $events as $event ) {
                $output .= '<li>';
                $output .= '<h4>' . esc_html( $event['title'] ) . '</h4>';
                $output .= '<p>' . esc_html( $event['date'] ) . ' - ' . esc_html( $event['time'] ) . '</p>';
                // Adjust or add more event details as needed
                $output .= '</li>';
            }
            $output .= '</ul>';
        } else {
            $output .= '<p>No upcoming events found.</p>';
        }

        $output .= '</div>';

        return $output;
    }

    // Implement a function to fetch event data (customize as needed)
    private function get_events() {
        // Here, retrieve events from your database or other sources
        // For this example, using a placeholder array:
        return array(
            // Array with event details (date, time, title, etc.)
            array(
                'date' => '2024-04-20',
                'time' => '10:00 AM',
                'title' => 'Sample Event 1',
            ),
            // Add more events as needed
        );
    }
}

new Event_Calendar_Block();
