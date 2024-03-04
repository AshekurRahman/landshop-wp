<div class="inner-content">

    <img src="<?php echo CODEXSE_ADDONS_ASSETS; ?>imgs/admin/codexse-logo.png" alt="" style="width: 100px;">

    <h2 class="title-big color-purple">Welcome to Codexse!</h2>
    <?php 
        if (!class_exists('WP_Site_Health')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-site-health.php';
        }

        $info = [];

        if (WP_Site_Health::get_instance()->php_memory_limit !== ini_get('memory_limit')) {
            $info['memory_limit'] = WP_Site_Health::get_instance()->php_memory_limit;
            $info['admin_memory_limit'] = ini_get('memory_limit');
        } else {
            $info['memory_limit'] = ini_get('memory_limit');
        }

        $hasLowMem = (str_replace("M",'',$info['memory_limit']) < 256)?true:false;
    ?>
    <div class="php-info">Your current PHP Memory Limit: <strong><?=$info['memory_limit']?></strong>
        <?php if($hasLowMem): ?>
        <p>(Increase your memory limit, or you can balance it by disabling the unused widgets and features)</p>
        <?php endif; ?>
    </div>

    <div class="welcome-buttongroup">
        <div 
            class="switch"
            :class="{ active: userType==='normal' }"
            @click="setUserType('normal')">
            <span class="radio"></span>
            <div class="switch-data">
                <span class="title">I’m a regular User</span>
                <span class="description">Configure it for me</span>
            </div>
        </div>
        <div 
            class ="switch"
            :class="{ active: userType==='pro' }"
            @click="setUserType('pro')">
            <span class="radio"></span>
            <div class="switch-data">
                <span class="title">I’m a power User</span>
                <span class="description">Let me configure it myself</span>
            </div>
        </div>
    </div>
    
    <cx-nav
    prev=""
    next="widgets"
    done=""
    @set-tab="setTab"
    ></cx-nav>
    
    <span class="skip-setup" @click="endWizard()">Skip Setup & Go to Dashboard</span>
</div>