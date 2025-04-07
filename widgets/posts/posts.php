<?php

// namespace Elementor;

if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly.
}

if (!class_exists('first_agency_Posts')) {
    class first_agency_Posts extends Elementor\Widget_Base
    {
        public function __construct($data = [], $args = null)
        {
            parent::__construct($data, $args);
        }
        public function get_name()
        {
            return 'first_agency_posts';
        }

        public function get_title()
        {
            return __('Posts', 'hs-first-agency');
        }

        public function get_icon()
        {
            return 'eicon-post-list';
        }

        public function get_categories()
        {
            return ['first-agency-addon'];
        }

        protected function register_controls()
        {
            $this->start_controls_section('items_section', [
                'label' => __('Posts', 'hs-first-agency'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]);

            $this->add_responsive_control(
                'count',
                [
                    'label' => esc_html__('Display Count', 'hs-first-agency'),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => -1,
                    'max' => 6,
                    'step' => 1,
                    'default' => 3,
                ]
            );

            $this->add_control(
                'column',
                [
                    'label' => esc_html__('Display Columns', 'hs-first-agency'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => '3',
                    'options' => [
                        '1' => esc_html__('1', 'hs-first-agency'),
                        '2' => esc_html__('2', 'hs-first-agency'),
                        '3'  => esc_html__('3', 'hs-first-agency'),
                        '4' => esc_html__('4', 'hs-first-agency'),
                    ],
                ]
            );

            $this->end_controls_section();
        }

        protected function render()
        {
            $settings = $this->get_settings_for_display();

                $related_args = [
                    'post_type' => 'post',
                    'posts_per_page' => $settings['count'],
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => 1
                ];

                $the_query = new WP_Query($related_args);
                if ($the_query->have_posts()) : ?>
                    <div class="posts grid gap-[30px] p-[10px] lg:p-0 grid-cols-1 lg:grid-cols-<?php echo esc_attr($settings['column']); ?>">
                        <?php
                        while ($the_query->have_posts()) :
                            $the_query->the_post(); ?>
                            <?php get_template_part('template-parts/sections/post-card', null); ?>
                        <?php
                        endwhile; ?>
                    </div>
<?php
                endif;
                wp_reset_postdata();
        }
    }
    Elementor\Plugin::instance()->widgets_manager->register_widget_type(
        new first_agency_Posts()
    );
}
