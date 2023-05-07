<?php
/**
 * Helper functions.
 *
 * @package ravnostitcuprija
 */

if (!function_exists('ravnostit_calculate_dog_age')) {
	function ravnostit_calculate_dog_age($date_of_birth, $format = 'YM') {
		$date_of_birth = strtotime($date_of_birth);
		$current_time = time();
		$age_unix = $current_time - $date_of_birth;
		$years = floor($age_unix / YEAR_IN_SECONDS);
		$months = floor(($age_unix % YEAR_IN_SECONDS) / MONTH_IN_SECONDS);

		if ($format === 'YM') {
			return sprintf(
				__('%s years and %s months'),
				strval($years),
				strval($months),
			);
		}
		if ($years == 0) {
			return __('<1 years', 'ravnostitcuprija');
		}
		return sprintf(
			__('%s years', 'ravnostitcuprija'),
			strval($years),
		);	
	}
}
