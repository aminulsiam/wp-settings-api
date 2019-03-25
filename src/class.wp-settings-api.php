<?php

if (!class_exists('WP_Settings_Api')) {

    require_once plugin_dir_path(__FILE__) . "includes/class.wp-settings-api-helper.php";

    class WP_Settings_Api
    {

        public function __construct()
        {
            add_action('admin_menu', array($this, 'add_admin_menu'));
            add_action('admin_init', array($this, 'admin_init'));
        }


        /**
         *  Add menu in admin panel
         */
        public function add_admin_menu()
        {
            add_menu_page(
                'wp_settings_api',
                'wp settings_api',
                'manage_options',
                'wp_settings_api',
                [$this, 'admin_menu_content']
            );
        }


        /**
         *  Backend display of settings fields
         */
        public function admin_menu_content()
        {
            ?>
            <div class="wrap">
                <div id="icon-options-general" class="icon32"></div>
                <form method="post" action="options.php">
                    <?php

                    settings_fields('wp_settings_section');

                    // all the add_settings_field callbacks is displayed here
                    do_settings_sections("wp_settings_api");

                    // Add the submit button to serialize the options
                    submit_button('submit');

                    ?>
                </form>
            </div>
            <?php
        }


        /**
         *  Settings section and settings fields are add here
         */
        public function admin_init()
        {
            add_settings_section(
                'wp_settings_section',
                'WP Settings api',
                [$this, 'settings_section_callback'],
                'wp_settings_api'
            );


            $settings_fields = array(
                'wp_settings_api' => array(
                    array(
                        "id" => "text_input",
                        "type" => "text",
                        "label" => __('Text', 'wp_settings_api'),
                        "name" => "text_value",
                        "placeholder" => ""
                    ),
                    array(
                        "id" => "number_input",
                        "type" => "number",
                        "label" => __('Number input', 'wp_settings_api'),
                        "name" => "number_value",
                        "placeholder" => ""
                    ),
                    array(
                        "id" => "textarea",
                        "type" => "textarea",
                        "label" => __('Textarea', 'wp_settings_api'),
                        "name" => "textarea_value",
                        "placeholder" => ""
                    ),
                    array(
                        "id" => "checkbox",
                        "type" => "checkbox",
                        "label" => __('Checkbox', 'wp_settings_api'),
                        "name" => "checkbox",
                    ),
                    array(
                        "id" => "radio",
                        "type" => "radio",
                        "label" => __('Radio button', 'wp_settings_api'),
                        "name" => "radio",
                        "options" => array(
                            "yes" => __('Yes', 'wp_settings_api'),
                            "no" => __('No', 'wp_settings_api'),
                        )
                    ),
                    array(
                        "id" => "select_dropdown",
                        "type" => "select",
                        "label" => __('Select dropdown', 'wp_settings_api'),
                        "name" => "select_value",
                        "options" => array(
                            "bd" => __('Bangladesh', 'wp_settings_api'),
                            "ind" => __('India', 'wp_settings_api'),
                            "pak" => __('Pakistan', 'wp_settings_api')
                        )
                    ),
                    array(
                        "id" => "multiple_checkbox",
                        "type" => "multiple_check",
                        "label" => __('Multiple checkbox', 'wp_settings_api'),
                        "name" => "multiple_checkbox",
                        "options" => array(
                            "travelling" => __('Travelling', 'wp_settings_api'),
                            "programming" => __('Programming', 'wp_settings_api'),
                            "reading" => __('Reading', 'wp_settings_api'),
                            "eating" => __('Eating', 'wp_settings_api'),
                        )
                    ),
                ),
            );

            foreach ($settings_fields as $settings_field) {
                foreach ($settings_field as $field) {

                    $field_id = isset($field['id']) ? $field['id'] : "";
                    $field_type = isset($field['type']) ? $field['type'] : "text";
                    $field_label = isset($field['label']) ? $field['label'] : "";
                    $field_name = isset($field['name']) ? $field['name'] : "";
                    $field_placeholder = isset($field['placeholder']) ? $field['placeholder'] : "";
                    $callback_class = new WP_Settings_Api_Helper();
                    $callback = isset($field['callback']) ? $field['callback'] : array($callback_class, 'callback_' . $field_type);
                    $options = isset($field['options']) ? $field['options'] : array();

                    $args = array(
                        'type' => $field_type,
                        'label' => $field_label,
                        'name' => $field_name,
                        'placeholder' => $field_placeholder,
                        'options' => $options,
                    );

                    add_settings_field(
                        $field_id,
                        $field_label,
                        $callback,
                        'wp_settings_api',
                        'wp_settings_section',
                        $args
                    );
                }
            }

            register_setting('wp_settings_section', 'wp_settings_api');

        } // End admin_init method


        /**
         *  WP Settings api description after heading
         */
        public function settings_section_callback()
        {
            echo esc_html__('All input type is here,you can used this api easily by passed a array.', 'wp_settings_api');
        }


    } // End of class WP_Settings_Api

} // End of if for class exist




