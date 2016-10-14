<?php

namespace runcommand\Doctor\Checks;

use WP_CLI;

/**
 * Warns when there are greater than %threshold_count% plugins activated.
 */
class Plugin_Active_Count extends Plugin {

	/**
	 * Threshold as a total number of plugins.
	 *
	 * @var integer
	 */
	protected $threshold_count = 80;

	public function run() {
		$plugins = self::get_plugins();

		$active = 0;
		foreach( self::get_plugins() as $plugin ) {
			if ( 'active' === $plugin['status'] ) {
				$active++;
			}
		}

		$threshold = (int) $this->threshold_count;
		if ( $active > $threshold ) {
			$this->status = 'warning';
			$this->message = "Number of active plugins ({$active}) exceeds threshold ({$threshold}).";
		} else {
			$this->status = 'success';
			$this->message = "Number of active plugins ({$active}) is less than threshold ({$threshold}).";
		}

	}

}