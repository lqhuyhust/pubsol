<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?php echo $this->url . '/admin'; ?>">
            <svg class="sidebar-brand-icon align-middle" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="miter" color="#FFFFFF" style="margin-left: -3px">
                <path d="M12 4L20 8.00004L12 12L4 8.00004L12 4Z"></path>
                <path d="M20 12L12 16L4 12"></path>
                <path d="M20 16L12 20L4 16"></path>
            </svg>
            <span class="sidebar-brand-text align-items-middle ms-2">
                SDM
            </span>
        </a>
        <ul class="sidebar-nav fs-4">
            <?php
            $menu = [];
            $menu = array_merge($menu, [
                [['users', 'user',], 'users', 'Users', '<i class="fa-solid fa-user"></i>', ''],
                [['setting', 'setting',], 'setting', 'Setting', '<i class="fa-solid fa-gear"></i>', ''],
            ]);
            $menu = array_merge($menu, 
                [
                    [['logout'], 'logout', 'Logout', '<i class="fa-solid fa-right-from-bracket"></i>', '']
                ],
            );
            foreach ($menu as $row) {
                list($allow, $plural, $name, $icon, $submenu) = $row;
                preg_match('/^(\/admin\/' . $plural . ')(|\/)$/', $this->path_current, $match);
                if (is_array($match) && count($match)) {
                    $active = true;
                } else {
                    $active = false;
                    foreach ($allow as $single) {
                        $single = str_replace('/', '\/', $single);
                        preg_match('/^(\/admin\/' . $single . ')(|\/([0-9]*?))$/', $this->path_current, $match);
                        if (is_array($match) && count($match)) {
                            $active = true;
                            break;
                        }
                    }
                } ?>
                <li class="sidebar-item <?php echo $active ? 'active' : ''; ?>">
                    <a href="<?php echo $this->link_admin . $plural ?>" class="sidebar-link">
                        <?php echo $icon ?> <span class="align-middle"><?php echo $name ?></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>