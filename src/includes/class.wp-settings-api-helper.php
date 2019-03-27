<?php
/*
 * Helper class  
 */
if (!class_exists('WP_Settings_Api_Helper')) {
    class WP_Settings_Api_Helper
    {
        private static function wp_settings_api_get_option()
        {
            return get_option('wp_settings_api');
        }

        /**
         * @param array $args settings fields arguments.
         *
         *  This method is for text type input only
         */
        public static function callback_text($args)
        {
            $placeholder = $args['placeholder'];
            $type = $args['type'];
            $name = $args['name'];
            $settings_api_values = WP_Settings_Api_Helper::wp_settings_api_get_option();
            $settings_api_value = isset($settings_api_values[$name]) ? $settings_api_values[$name] : $placeholder;

            $html = sprintf('<input type="%1$s" name="wp_settings_api[%2$s]" value="%3$s" class="regular-text" />
            <p class="description">' . __('Text input description') . '</p>', $type, $name, $settings_api_value);
            echo $html;
        } // End of callback_text


        /**
         * @param array $args settings fields arguments.
         *
         *  This method is for number type input only (int type)
         */
        public static function callback_number($args)
        {
            $placeholder = $args['placeholder'];
            $type = $args['type'];
            $name = $args['name'];
            $settings_api_values = WP_Settings_Api_Helper::wp_settings_api_get_option();
            $settings_api_value = isset($settings_api_values[$name]) ? $settings_api_values[$name] : $placeholder;

            $html = sprintf('<input type="%1$s" name="wp_settings_api[%2$s]" value="%3$s" min="1" class="regular-text" /> <p class="description">' . __('Number input description') . '</p>', $type, $name, $settings_api_value);
            echo $html;
        } // End of callback_number

        /**
         * @param array $args settings fields arguments.
         *
         *  This method is for textarea input only
         */
        public static function callback_textarea($args)
        {
            $placeholder = $args['placeholder'];
            $name = $args['name'];
            $settings_api_values = WP_Settings_Api_Helper::wp_settings_api_get_option();
            $settings_api_value = isset($settings_api_values[$name]) ? $settings_api_values[$name] : $placeholder;

            $html = sprintf('<textarea class="regular-text" name="wp_settings_api[%1$s]" rows="5">%2$s</textarea>
            <p class="description">' . __('Textarea description') . '</p>', $name, $settings_api_value);
            echo $html;
        } // End of callback_textarea


        /**
         * @param array $args settings fields arguments.
         *
         *  This method is for checkbox type input only
         */
        public static function callback_checkbox($args)
        {
            $placeholder = $args['placeholder'];
            $type = $args['type'];
            $name = $args['name'];
            $settings_api_values = WP_Settings_Api_Helper::wp_settings_api_get_option();
            $settings_api_value = isset($settings_api_values[$name]) ? $settings_api_values[$name] : $placeholder;

            $checked = "";
            if ("on" == $settings_api_value) {
                $checked = "checked";
            }

            $html = sprintf('<input type="%1$s" name="wp_settings_api[%2$s]" value="on" %3$s /> <label for="">' . __('Checkbox Label') . ' &nbsp; </label> <p class="description">' . __('Checkbox') . '</p>', $type, $name, $checked);
            echo $html;
        } // End of callback_checkbox


        /**
         * @param array $args settings fields arguments.
         *
         *  This method is for radio type input only
         */
        public static function callback_radio($args)
        {
            $type = $args['type'];
            $name = $args['name'];
            $options = $args['options'];
            $settings_api_values = WP_Settings_Api_Helper::wp_settings_api_get_option();

            foreach ($options as $key => $option) {
                $checked = "";
                if (in_array($key, $settings_api_values)) {
                    $checked = "checked";
                }
                $html = sprintf('<p><input type="%1$s" name="wp_settings_api[%2$s]" value="%3$s" %4$s/> 
                                <label for="">' . esc_html($option) . '</label><br></p>', $type, $name, $key, $checked);
                echo $html;
            } // End foreach
        } //End of callback_radio


        /**
         * @param array $args settings fields arguments.
         *
         *  This method is for dropdown input only
         */
        public static function callback_select($args)
        {
            $name = $args['name'];
            $options = $args['options'];
            $settings_api_values = WP_Settings_Api_Helper::wp_settings_api_get_option();

            $html = sprintf('<select name="wp_settings_api[%1$s]">', $name);

            foreach ($options as $key => $option) {
                $selected = "";
                if (in_array($key, $settings_api_values)) {
                    $selected = "selected";
                }
                $html .= sprintf('<option value="%1$s" %3$s >%2$s</option>', $key, $option, $selected);
            }

            $html .= sprintf('</select><p class="description">' . __('Select a dropdown') . '</p>');
            echo $html;

        } //End of callback_select


        /**
         * @param array $args settings fields arguments.
         *
         * This is the multiple checkbox callback function
         */
        public static function callback_multiple_check($args)
        {
            $name = $args['name'];
            $options = $args['options'];
            $settings_api_values = WP_Settings_Api_Helper::wp_settings_api_get_option();
            $settings_api_value = isset($settings_api_values['multiple_checkbox']) ?
                $settings_api_values['multiple_checkbox'] : array();

            foreach ($options as $key => $option) {
                $checked = "";
                if (in_array($key, $settings_api_value)) {
                    $checked = "checked";
                }
                $html = sprintf('<input type="checkbox" name="wp_settings_api[%1$s][]" value="%2$s"  %3$s/> %4$s 
&nbsp; ', $name, $key, $checked, $option);
                echo $html;
            } // End foreach
        } // End of callback_multiple_check


    } // End of WP_Settings_Api_Helper class
} // End of if for class exist
