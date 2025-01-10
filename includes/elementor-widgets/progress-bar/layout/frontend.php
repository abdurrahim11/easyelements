<div class="ele-progress-bar-wrapper ele-progress-bar-layout-<?php echo esc_attr( $settings['layout'] ); ?>">
    <?php if ( $settings['title'] && '15' !== $settings['layout'] ) { ?>
        <div class="ele-progress-content">
            <span class="ele-progress-title"><?php echo esc_html( $settings['title'] ); ?></span>
        </div>
    <?php } ?>
    <div class="ele-progress-bar">
        <div class="ele-progress-track">
            <?php if ( 'yes' === $settings['show_count'] && '15' !== $settings['layout'] ) { ?>
                <div class="ele-progress-counter">
                    <?php if ( '5' === $settings['layout'] ) { ?>
                        <span class="ele-progress-control"></span>
                    <?php } ?>
                    <?php if ( '6' === $settings['layout'] ) { ?>
                        <span class="ele-progress-count-less-wrapper">
                            <span class="ele-progress-count-less">90</span>%
                        </span>
                    <?php } ?>
                    <span class="ele-progress-count">90</span>%
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if ( '15' === $settings['layout'] && ( 'yes' === $settings['show_count'] || $settings['title'] ) ) { ?>
        <div class="ele-progress-content">
            <?php if ( 'yes' === $settings['show_count'] ) { ?>
                <div class="ele-progress-counter">
                    <span class="ele-progress-count">90</span>%
                </div>
            <?php } ?>
            <?php if ( $settings['title'] ) { ?>
                <span class="ele-progress-title"><?php echo esc_html( $settings['title'] ); ?></span>
            <?php } ?>
        </div>
    <?php } ?>
</div>