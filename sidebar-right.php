<?php if (is_active_sidebar('right_sidebar')) : ?>
    <div class="sidebar-right sidebar px-[5px] lg:pr-[30px] rtl:lg:pl-[30px] mt-[30px] lg:mt-0">
        <?php dynamic_sidebar('right_sidebar'); ?>
    </div>
<?php endif; ?>