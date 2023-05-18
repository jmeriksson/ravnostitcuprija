<?php
/**
 * Handles adjustments to the Tiny MCE Editor
 *
 * @package Ravnostitcuprija
 */

class Tiny_Mce_Editor extends Loader {
    /**
	 * Add hooks and filters here.
	 *
	 * @return void
	 */
	public function init() : void {
		add_filter('tiny_mce_before_init', [ $this, 'register_formats' ]);
        add_filter('mce_buttons_2', [ $this, 'add_styleselect' ]);
	}

    /**
     * Adds custom formats to the wysiwyg editor.
     *
     * @param array $settings
     * @return array
     */
    public function register_formats(array $settings) : array {
        $style_formats = [
            [
                'title' => __('Buttons', 'ravnostitcuprija'),
                'items' => [
                    [
                        'title' => __('Primary', 'ravnostitcurpija'),
                        'selector' => 'a',
                        'attributes' => ['class' => 'btn btn--primary']
                    ],
                    [
                        'title' => __('Secondary', 'ravnostitcurpija'),
                        'selector' => 'a',
                        'attributes' => ['class' => 'btn btn--secondary']
                    ],
                ]
            ]
        ];

        $settings['style_formats'] = json_encode($style_formats);
        $settings['paste_as_text'] = true;

        return $settings;
    }

    /**
     * Adding the styleselect button.
     *
     * @param array $buttons
     * @return array
     */
    public function add_styleselect(array $buttons) : array {
        array_unshift($buttons, 'styleselect');

        return $buttons;
    }
}