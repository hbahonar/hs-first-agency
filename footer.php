</main>
<?php
$is_footer_active = false;
$footer_column_count = get_theme_mod('first_agency_footer_columns', '1');
for ($counter = 1; $counter <= $footer_column_count; $counter++) {
    if (is_active_sidebar('footer' . $counter)) {
        $is_footer_active = true;
    }
} ?>
<?php
if ($is_footer_active) : ?>
    <footer class="site-footer">
        <div class="inner-footer p-[60px_30px] grid grid-cols-1 lg:grid-cols-<?php echo esc_attr($footer_column_count) ?> gap-[60px] px-[5px] lg:px-[60px]">
            <?php for ($counter = 1; $counter <= $footer_column_count; $counter++) : ?>
                <div class="footer w-full">
                    <?php if (is_active_sidebar('footer' . $counter)) : ?>
                        <?php dynamic_sidebar('footer' . $counter); ?>
                    <?php endif; ?>
                </div>
            <?php endfor; ?>
        </div>
        <?php if (has_nav_menu('footer-menu')): ?>
            <nav class="footer-menu">
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer-menu',
                    'menu' => 'footer-menu',
                    'container' => 'div',
                ]); ?>
            </nav>
        <?php endif; ?>
    </footer>
<?php endif; ?>

<?php
$copyright = get_theme_mod('first_agency_copyright_text', '© {year} {site_name}');
if (!empty($copyright)) :
?>
    <div class="site-copyright flex items-center justify-center py-[15px] text-[0.9rem]">
        <?php
        $copyright = str_replace("{year}", date("Y"), $copyright);
        $copyright = str_replace("{site_name}", get_bloginfo('name'), $copyright);
        $copyright = str_replace("{description}", get_bloginfo('description'), $copyright);

        echo wp_kses_post($copyright);
        ?>
    </div>
<?php endif; ?>
</div>
<?php wp_footer(); ?>

</body>

</html>