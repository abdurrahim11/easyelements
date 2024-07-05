<?php

namespace EasyElements\Admin\Dashboard;


/**
 * Class Dashboard
 *
 * @package EasyElements\Admin\Dashboard
 */
class Dashboard {

    /**
     * Dashboard view load
     */
    public function page() {
        require_once ELE_PLUGIN_PATH . 'includes\admin\dashboard\templates\dashboard.php';
    }

}

