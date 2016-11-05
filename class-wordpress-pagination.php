<?php
/*
 * Digital Apps - Wordpress Pagination Class
 *
 * (c) 2016 Andrey M. / DigitalApps.co
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WPP_Class' ) ) {

	class WPP_Class {

		/**
		 * Init Variables
		 */
	    public $settings = array(
				'items_wrapper_open'		=> '<ul>',
				'items_wrapper_close'		=> '</ul>',
				'item_open'					=> '<li>',
				'item_close'				=> '</li>',
			);

		/**
		 * Constructor
		 */

		public function __construct( $args ) {
			$this->args = $args;
			$this->get_pagination();
		}

		/**
		 * Public functions
		 */

		public function get_pagination() {
			if(!empty($this->args)) :
				$links_set = paginate_links( $this->args );
				$array_total = count($links_set) - 1;
				$current_page_count = 1;
				$pagination_html = '';
				$prev_next_buttons_html = '';

				foreach ($links_set as $key => $value) {
					// set previous link
					if( $key == 0 && $this->args['current'] > 1 ) {
						$prev_next_buttons_html .= $value;
						$current_page_count--;
					}
					// set next link
					if( $key != $this->args['current'] && $key == $array_total ) {
						$prev_next_buttons_html .= $value;
					}
					// set page numbers
					if( $this->args['current'] == $current_page_count ) {
						// set current page
						$pagination_html .= $this->settings['item_open'] . '<a class="active" href="#">' . $value . '</a>' . $this->settings['item_close'];
					} else {
						// set all other pages
						if( $key != 0 && $key != $array_total ) {
							$pagination_html .= $this->settings['item_open'] . $value . $this->settings['item_close'];
						}
					}
					$current_page_count++;
				}
				$this->generate_html( $pagination_html, $prev_next_buttons_html );
			endif;
		}

		public function generate_html($pagination_html, $prev_next_buttons_html) {
			echo '<div class="paginator wow fadeInUp">';
				echo $this->settings['items_wrapper_open'] . $pagination_html . $this->settings['items_wrapper_close'];
				echo '<div>';
					echo $prev_next_buttons_html;
				echo '</div>';
				echo '<div class="clear"></div>';
			echo '</div>';
		}
	}
}