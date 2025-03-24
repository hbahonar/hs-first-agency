<?php if (is_active_sidebar('left_sidebar')) : ?>
    <div class="sidebar-left sidebar px-[5px] lg:pl-[30px] rtl:lg:pr-[30px] mt-[30px] lg:mt-0">
        <?php dynamic_sidebar('left_sidebar'); ?>
    </div>
<?php endif; ?>