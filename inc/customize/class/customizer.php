<?php
if (!class_exists('BHR_Customizer')) {
    class BHR_Customizer
    {
        private $wp_customize;
        public static $SWITCH = 1, $COLOR = 2, $TEXT = 3, $NUMBER = 4, $SELECT = 5, $TEXTAREA = 6, $HEADING = 7, $GETPROBUTTON;

        function __construct($wp_customize)
        {
            $this->wp_customize = $wp_customize;
        }
        public function AddSection($id, $title, $pannel_id)
        {
            $this->wp_customize->add_section(
                $id,
                array(
                    'title' => $title,
                    'capability' => 'edit_theme_options',
                    'panel' => $pannel_id
                )
            );
        }

        public function AddControl($args, $type)
        {
            if (empty($args['id']) || empty($args['section_id'])) {
                return;
            }
            switch ($type) {
                case self::$SWITCH:
                    $this->wp_customize->add_setting(
                        $args['id'],
                        array(
                            'default'     => $args['default'] ?? '',
                            'sanitize_callback' => 'esc_attr',
                            'transport' => 'refresh',
                        )
                    );

                    $this->wp_customize->add_control(new BHR_Text_Radio_Button_Custom_Control(
                        $this->wp_customize,
                        $args['id'],
                        array(
                            'label'      => $args['title'] ?? '',
                            'description'      => $args['description'] ?? '',
                            'section'    => $args['section_id'],
                            'settings'   => $args['id'],
                            'choices'    => $args['options'] ?? [],
                        )
                    ));
                    break;
                case self::$COLOR:
                    $this->wp_customize->add_setting(
                        $args['id'],
                        array('default' => $args['default'] ?? '', 'sanitize_callback' => 'sanitize_hex_color')
                    );

                    $this->wp_customize->add_control(new WP_Customize_Color_Control($this->wp_customize, $args['id'], array(
                        'label' => $args['title'] ?? '',
                        'description'    => $args['description'] ?? '',
                        'section' => $args['section_id'],
                        'settings' => $args['id'],
                    )));
                    break;
                case self::$TEXT:
                    $this->wp_customize->add_setting($args['id'], array(
                        'default' => $args['default'] ?? '',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => 'esc_attr'
                    ));

                    $this->wp_customize->add_control(new WP_Customize_Control($this->wp_customize, $args['id'], array(
                        'type' => 'text',
                        'label' => $args['title'] ?? '',
                        'description' => $args['description'] ?? '',
                        'section' => $args['section_id'],
                        'settings' => $args['id']
                    )));
                    break;
                case self::$NUMBER:
                    $this->wp_customize->add_setting($args['id'], array(
                        'default' => $args['default'] ?? '',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => 'esc_attr'
                    ));

                    $this->wp_customize->add_control(new BHR_Input_Number_Option($this->wp_customize, $args['id'], array(
                        'type' => 'input',
                        'label' => $args['title'] ?? '',
                        'description' => $args['description'] ?? '',
                        'section' => $args['section_id'],
                        'settings' => $args['id'],
                        'choices' => array(
                            'columns' => $args['default'] ?? ''
                        )
                    )));
                    break;
                case self::$SELECT:
                    $this->wp_customize->add_setting($args['id'], array(
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => 'bhr_sanitize_select',
                        'default' => $args['default'] ?? '',
                    ));

                    $this->wp_customize->add_control($args['id'], array(
                        'type' => 'select',
                        'section' => $args['section_id'],
                        'label' => $args['title'] ?? '',
                        'description' => $args['description'] ?? '',
                        'settings' => $args['id'],
                        'choices' => $args['options'] ?? [],
                    ));
                    break;
                case self::$TEXTAREA:
                    $this->wp_customize->add_setting($args['id'], array(
                        'transport' => 'refresh',
                        'default' => $args['default'] ?? '',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => 'bhr_sanitize_textarea_html'
                    ));

                    $this->wp_customize->add_control(new WP_Customize_Control($this->wp_customize, $args['id'], array(
                        'type' => 'textarea',
                        'label' => $args['title'] ?? '',
                        'description' => $args['description'] ?? '',
                        'section' => $args['section_id'],
                        'settings' => $args['id']
                    )));
                    break;
                case self::$HEADING:
                    $this->wp_customize->add_setting($args['id'], array(
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => 'esc_attr'
                    ));

                    $this->wp_customize->add_control(new BHR_Heading($this->wp_customize, $args['id'], array(
                        'label' => $args['title'] ?? '',
                        'description' => $args['description'] ?? '',
                        'section' => $args['section_id'],
                        'settings' => $args['id']
                    )));
                    break;
                case self::$GETPROBUTTON:
                    $this->wp_customize->add_setting($args['id'], array(
                        'transport' => 'refresh',
                        'capability' => 'edit_theme_options',
                        'sanitize_callback' => 'esc_attr'
                    ));

                    $this->wp_customize->add_control(new BHR_Get_Pro_Button_Custom_Control($this->wp_customize, $args['id'], array(
                        'label' => $args['title'] ?? '',
                        'description' => $args['description'] ?? '',
                        'choices' => [$args['link'] ?? '#'],
                        'section' => $args['section_id'],
                        'settings' => $args['id']
                    )));
                    break;
            }
        }
    }
}

if (class_exists('WP_Customize_Control')) {
    if (!class_exists('BHR_Text_Radio_Button_Custom_Control')) {
        /**
         * Text Radio Button Custom Control
         *
         * @author Anthony Hortin <http://maddisondesigns.com>
         * @license http://www.gnu.org/licenses/gpl-2.0.html
         * @link https://github.com/maddisondesigns
         */
        class BHR_Text_Radio_Button_Custom_Control extends WP_Customize_Control
        {
            /**
             * The type of control being rendered
             */
            public $type = 'text_radio_button';
            /**
             * Enqueue our scripts and styles
             */
            public function enqueue()
            {
                wp_enqueue_style('first-agency-custom-controls-css', trailingslashit(get_template_directory_uri()) . 'inc/customize/assets/customizer.css', array(), '1.0', 'all');
            }
            /**
             * Render the control in the customizer
             */
            public function render_content()
            {
?>
                <div class="text_radio_button_control">
                    <?php if (!empty($this->label)) { ?>
                        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                    <?php } ?>
                    <?php if (!empty($this->description)) { ?>
                        <span class="customize-control-description"><?php echo wp_specialchars_decode($this->description); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                    ?></span>
                    <?php } ?>

                    <div class="radio-buttons">
                        <?php
                        $class = 'radio-button-label';
                        if (count($this->choices) > 2) {
                            $class .= ' full_width_label';
                        }
                        foreach ($this->choices as $key => $value) { ?>
                            <label class="<?php echo esc_attr($class); ?>">
                                <input type="radio" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($key); ?>" <?php $this->link(); ?> <?php checked(esc_attr($key), $this->value()); ?> />
                                <span for="_customize-input-<?php echo esc_attr($this->id); ?>-radio-<?php echo esc_attr($value); ?>"><?php echo esc_html($value); ?></span>
                            </label>
                        <?php    } ?>
                    </div>
                </div>
            <?php
            }
        }
    }

    if (!class_exists('BHR_Input_Number_Option')) {
        class BHR_Input_Number_Option extends WP_Customize_Control
        {
            public function render_content()
            {
                if (empty($this->choices))
                    return;

                $name = '_customize-number-' . $this->id; ?>

                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <p class="customize-control-description"><?php wp_kses_post($this->description); ?></p>
                <?php
                foreach ($this->choices as $value => $label) : ?>
                    <input <?php $this->link(); ?>type="number" style="display: inline;" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" />
                <?php
                endforeach;
            }
        }
    }

    if (!class_exists('BHR_Heading')) {
        class BHR_Heading extends WP_Customize_Control
        {
            protected function render()
            {
                $id    = 'customize-control-' . str_replace(array('[', ']'), array('-', ''), $this->id);
                $class = 'customize-control customize-control-' . $this->type;

                printf('<li id="%s" class="%s hrx-heading-section ' . esc_attr(isset($this->choices[0]) ? $this->choices[0] : "open") . '">', esc_attr($id), esc_attr($class));
                $this->render_content();
                echo '</li>';
            }

            public function render_content()
            {
                ?>
                <h2 class="customize-control-title"><?php echo esc_html($this->label); ?></h2>
                <?php if (!empty($this->description)): ?>
                    <p class="customize-control-description"><?php wp_kses_post($this->description); ?></p>
                <?php
                endif;
            }
        }
    }

    if (!class_exists('BHR_Get_Pro_Button_Custom_Control')) {
        class BHR_Get_Pro_Button_Custom_Control extends WP_Customize_Control
        {
            /**
             * Render the control in the customizer
             */
            public function render_content()
            {
                ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <p class="customize-control-description"><?php echo wp_specialchars_decode($this->description); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                                    ?></p>
                <div class="get_pro_button_control">
                    <?php if (isset($this->choices)): ?>
                        <a href="<?php echo esc_url($this->choices[0]); ?>" target="_blank" class="button button-primary"><?php echo esc_html($this->label); ?></a>
                    <?php endif; ?>
                </div>
<?php
            }
        }
    }
}



if (!function_exists('bhr_sanitize_select')) {
    function bhr_sanitize_select($input, $setting)
    {
        $input = sanitize_key($input);
        $choices = $setting->manager->get_control($setting->id)->choices;
        return (array_key_exists($input, $choices) ? $input : $setting->default);
    }
}

if (!function_exists('bhr_sanitize_textarea_html')) {
    function bhr_sanitize_textarea_html($input)
    {
        return wp_kses_post($input);
    }
}

if (!function_exists('bhr_sanitize_image')) {
    function bhr_sanitize_image($file, $setting)
    {
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon'
        );
        $file_ext = wp_check_filetype($file, $mimes);
        return ($file_ext['ext'] ? $file : $setting->default);
    }
}
