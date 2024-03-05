<?php
namespace Codexse_Addons\Elementor;

defined( 'ABSPATH' ) || die();

class Icons_Manager {

    public static function init() {
        add_filter( 'elementor/icons_manager/additional_tabs', [ __CLASS__, 'add_codexse_icons_tab' ] );
    }

    public static function add_codexse_icons_tab( $tabs ) {
        $tabs['codexse-icons'] = [
            'name' => 'codexse-icons',
            'label' => __( 'Codexse Icons', 'codexse-elementor-addons' ),
            'url' => CODEXSE_ADDONS_ASSETS . 'fonts/style.min.css',
            'enqueue' => [ CODEXSE_ADDONS_ASSETS . 'fonts/style.min.css' ],
            'prefix' => 'hm-',
            'displayPrefix' => 'hm',
            'labelIcon' => 'cx cx-codexseaddons',
            'ver' => CODEXSE_ADDONS_VERSION,
            'fetchJson' => CODEXSE_ADDONS_ASSETS . 'fonts/codexse-icons.js?v=' . CODEXSE_ADDONS_VERSION,
            'native' => false,
        ];
        return $tabs;
    }

    /**
     * Get a list of codexse icons
     *
     * @return array
     */
    public static function get_codexse_icons() {
        return [
            'cx cx-3d-rotate' => '3d-rotate',
            'cx cx-degree' => 'degree',
            'cx cx-accordion-horizontal' => 'accordion-horizontal',
            'cx cx-accordion-vertical' => 'accordion-vertical',
            'cx cx-alarm-clock' => 'alarm-clock',
            'cx cx-alien-gun' => 'alien-gun',
            'cx cx-alien' => 'alien',
            'cx cx-anchor' => 'anchor',
            'cx cx-android' => 'android',
            'cx cx-angle-down' => 'angle-down',
            'cx cx-angle-left' => 'angle-left',
            'cx cx-angle-right' => 'angle-right',
            'cx cx-angle-up' => 'angle-up',
            'cx cx-apple' => 'apple',
            'cx cx-arrow-left' => 'arrow-left',
            'cx cx-arrow-right' => 'arrow-right',
            'cx cx-arrow-zoom-out' => 'arrow-zoom-out',
            'cx cx-arrow-corner' => 'arrow-corner',
            'cx cx-arrow-down' => 'arrow-down',
            'cx cx-arrow-left1' => 'arrow-left1',
            'cx cx-arrow-right1' => 'arrow-right1',
            'cx cx-arrow-up' => 'arrow-up',
            'cx cx-article' => 'article',
            'cx cx-avatar-man' => 'avatar-man',
            'cx cx-avatar-woman' => 'avatar-woman',
            'cx cx-badge1' => 'badge1',
            'cx cx-badge2' => 'badge2',
            'cx cx-badge3' => 'badge3',
            'cx cx-bamboo' => 'bamboo',
            'cx cx-basketball' => 'basketball',
            'cx cx-battery' => 'battery',
            'cx cx-beach-seat' => 'beach-seat',
            'cx cx-bell' => 'bell',
            'cx cx-bicycle' => 'bicycle',
            'cx cx-blog-content' => 'blog-content',
            'cx cx-bluetooth' => 'bluetooth',
            'cx cx-board' => 'board',
            'cx cx-body' => 'body',
            'cx cx-bomb' => 'bomb',
            'cx cx-bond-hand' => 'bond-hand',
            'cx cx-bond' => 'bond',
            'cx cx-bonsai' => 'bonsai',
            'cx cx-book' => 'book',
            'cx cx-bowl' => 'bowl',
            'cx cx-brick-wall' => 'brick-wall',
            'cx cx-brush-paint' => 'brush-paint',
            'cx cx-brush-roll' => 'brush-roll',
            'cx cx-brush' => 'brush',
            'cx cx-bug' => 'bug',
            'cx cx-bulb' => 'bulb',
            'cx cx-calculation' => 'calculation',
            'cx cx-calendar' => 'calendar',
            'cx cx-camera' => 'camera',
            'cx cx-candle' => 'candle',
            'cx cx-candles' => 'candles',
            'cx cx-car' => 'car',
            'cx cx-card' => 'card',
            'cx cx-caret-down' => 'caret-down',
            'cx cx-caret-fill-down' => 'caret-fill-down',
            'cx cx-caret-fill-left' => 'caret-fill-left',
            'cx cx-caret-fill-right' => 'caret-fill-right',
            'cx cx-caret-fill-up' => 'caret-fill-up',
            'cx cx-caret-left' => 'caret-left',
            'cx cx-caret-right' => 'caret-right',
            'cx cx-caret-up' => 'caret-up',
            'cx cx-carousal' => 'carousal',
            'cx cx-cart-empty' => 'cart-empty',
            'cx cx-cart-full' => 'cart-full',
            'cx cx-caution' => 'caution',
            'cx cx-chair' => 'chair',
            'cx cx-chair2' => 'chair2',
            'cx cx-chat-bubble-single' => 'chat-bubble-single',
            'cx cx-chat-bubble' => 'chat-bubble',
            'cx cx-cheese' => 'cheese',
            'cx cx-chef-cap' => 'chef-cap',
            'cx cx-clip-board' => 'clip-board',
            'cx cx-clip' => 'clip',
            'cx cx-cloud-down' => 'cloud-down',
            'cx cx-cloud-up' => 'cloud-up',
            'cx cx-cloud' => 'cloud',
            'cx cx-code-browser' => 'code-browser',
            'cx cx-code-clean' => 'code-clean',
            'cx cx-code' => 'code',
            'cx cx-cog' => 'cog',
            'cx cx-color-card' => 'color-card',
            'cx cx-color-plate' => 'color-plate',
            'cx cx-compass-math' => 'compass-math',
            'cx cx-compass' => 'compass',
            'cx cx-corner' => 'corner',
            'cx cx-crop' => 'crop',
            'cx cx-cross-circle' => 'cross-circle',
            'cx cx-cross-game' => 'cross-game',
            'cx cx-cross-gap' => 'cross-gap',
            'cx cx-cross' => 'cross',
            'cx cx-crown' => 'crown',
            'cx cx-cube' => 'cube',
            'cx cx-cup-coffee' => 'cup-coffee',
            'cx cx-cup' => 'cup',
            'cx cx-currency-paper' => 'currency-paper',
            'cx cx-interface' => 'dashboard',
            'cx cx-delivery-van' => 'delivery-van',
            'cx cx-diamond-ring' => 'diamond-ring',
            'cx cx-direction-both' => 'direction-both',
            'cx cx-direction-right' => 'direction-right',
            'cx cx-disable-person' => 'disable-person',
            'cx cx-disc' => 'disc',
            'cx cx-dislike' => 'dislike',
            'cx cx-dollar-on-hand' => 'dollar-on-hand',
            'cx cx-door-path' => 'door-path',
            'cx cx-Download-circle' => 'Download-circle',
            'cx cx-download' => 'download',
            'cx cx-drag-inside' => 'drag-inside',
            'cx cx-drag-outside' => 'drag-outside',
            'cx cx-drag' => 'drag',
            'cx cx-drawer' => 'drawer',
            'cx cx-dribbble' => 'dribbble',
            'cx cx-dropper' => 'dropper',
            'cx cx-egg-fry' => 'egg-fry',
            'cx cx-ellipsis-fill-h' => 'ellipsis-fill-h',
            'cx cx-ellipsis-fill-v' => 'ellipsis-fill-v',
            'cx cx-ellipsis-horizontal' => 'ellipsis-horizontal',
            'cx cx-ellipsis-vertical' => 'ellipsis-vertical',
            'cx cx-emo-normal' => 'emo-normal',
            'cx cx-emo-sad' => 'emo-sad',
            'cx cx-emo-smile' => 'emo-smile',
            'cx cx-envelop' => 'envelop',
            'cx cx-facebook' => 'facebook',
            'cx cx-fancy-futton' => 'fancy-futton',
            'cx cx-feeder' => 'feeder',
            'cx cx-file-cabinet' => 'file-cabinet',
            'cx cx-file-rotate' => 'file-rotate',
            'cx cx-file' => 'file',
            'cx cx-files' => 'files',
            'cx cx-film-roll' => 'film-roll',
            'cx cx-film' => 'film',
            'cx cx-finger-index' => 'finger-index',
            'cx cx-finger-print' => 'finger-print',
            'cx cx-fire-flame' => 'fire-flame',
            'cx cx-flag' => 'flag',
            'cx cx-flip-card1' => 'flip-card1',
            'cx cx-flip-card2' => 'flip-card2',
            'cx cx-folder-network' => 'folder-network',
            'cx cx-folder' => 'folder',
            'cx cx-football' => 'football',
            'cx cx-footer' => 'footer',
            'cx cx-form' => 'form',
            'cx cx-forward' => 'forward',
            'cx cx-fountain-pen' => 'fountain-pen',
            'cx cx-gender-female' => 'gender-female',
            'cx cx-gender-male' => 'gender-male',
            'cx cx-gender-sign' => 'gender-sign',
            'cx cx-gender' => 'gender',
            'cx cx-ghost' => 'ghost',
            'cx cx-gift-box' => 'gift-box',
            'cx cx-globe1' => 'globe1',
            'cx cx-globe2' => 'globe2',
            'cx cx-globe3' => 'globe3',
            'cx cx-globe4' => 'globe4',
            'cx cx-google' => 'google',
            'cx cx-graduate-cap' => 'graduate-cap',
            'cx cx-graph-bar' => 'graph-bar',
            'cx cx-graph-pie' => 'graph-pie',
            'cx cx-graph' => 'graph',
            'cx cx-grid-even' => 'grid-even',
            'cx cx-grid-masonry' => 'grid-masonry',
            'cx cx-grid-twist' => 'grid-twist',
            'cx cx-grid' => 'grid',
            'cx cx-group' => 'group',
            'cx cx-hand-mike' => 'hand-mike',
            'cx cx-hand-watch' => 'hand-watch',
            'cx cx-hand' => 'hand',
            'cx cx-header' => 'header',
            'cx cx-headphone' => 'headphone',
            'cx cx-headset' => 'headset',
            'cx cx-heart-beat' => 'heart-beat',
            'cx cx-hexa' => 'hexa',
            'cx cx-highlighter' => 'highlighter',
            'cx cx-home' => 'home',
            'cx cx-hot-spot' => 'hot-spot',
            'cx cx-hotdog' => 'hotdog',
            'cx cx-ice-cream' => 'ice-cream',
            'cx cx-icon-box' => 'icon-box',
            'cx cx-imac' => 'imac',
            'cx cx-image-compare' => 'image-compare',
            'cx cx-image-slider' => 'image-slider',
            'cx cx-image' => 'image',
            'cx cx-inbox' => 'inbox',
            'cx cx-infinity' => 'infinity',
            'cx cx-info' => 'info',
            'cx cx-injection' => 'injection',
            'cx cx-instagram' => 'instagram',
            'cx cx-jar-chemical' => 'jar-chemical',
            'cx cx-key' => 'key',
            'cx cx-language-change' => 'language-change',
            'cx cx-laptop' => 'laptop',
            'cx cx-layer' => 'layer',
            'cx cx-lens' => 'lens',
            'cx cx-like' => 'like',
            'cx cx-line-graph-pointed' => 'line-graph-pointed',
            'cx cx-link' => 'link',
            'cx cx-linkedin' => 'linkedin',
            'cx cx-linux' => 'linux',
            'cx cx-list-2' => 'list-2',
            'cx cx-list-group' => 'list-group',
            'cx cx-list' => 'list',
            'cx cx-location-pointer' => 'location-pointer',
            'cx cx-lock' => 'lock',
            'cx cx-logo-carousel' => 'logo-carousel',
            'cx cx-logo-grid' => 'logo-grid',
            'cx cx-lotus' => 'lotus',
            'cx cx-love' => 'love',
            'cx cx-madel' => 'madel',
            'cx cx-magic-wand' => 'magic-wand',
            'cx cx-magnet' => 'magnet',
            'cx cx-mail-open' => 'mail-open',
            'cx cx-man-range' => 'man-range',
            'cx cx-map-marker' => 'map-marker',
            'cx cx-map-pointer' => 'map-pointer',
            'cx cx-measurement' => 'measurement',
            'cx cx-memory' => 'memory',
            'cx cx-menu-price' => 'menu-price',
            'cx cx-micro-chip' => 'micro-chip',
            'cx cx-microphone1' => 'microphone1',
            'cx cx-microphone2' => 'microphone2',
            'cx cx-mobile' => 'mobile',
            'cx cx-money-bag' => 'money-bag',
            'cx cx-money' => 'money',
            'cx cx-monitor' => 'monitor',
            'cx cx-mouse' => 'mouse',
            'cx cx-muscle' => 'muscle',
            'cx cx-net' => 'net',
            'cx cx-network1' => 'network1',
            'cx cx-network2' => 'network2',
            'cx cx-newspaper' => 'newspaper',
            'cx cx-nuclear-circle' => 'nuclear-circle',
            'cx cx-office-file' => 'office-file',
            'cx cx-pacman' => 'pacman',
            'cx cx-paper-fold' => 'paper-fold',
            'cx cx-paper-plane-alt' => 'paper-plane-alt',
            'cx cx-paper-plane' => 'paper-plane',
            'cx cx-pause' => 'pause',
            'cx cx-pen-head' => 'pen-head',
            'cx cx-pen-pencil' => 'pen-pencil',
            'cx cx-pen-scale' => 'pen-scale',
            'cx cx-pen-paper' => 'pen-paper',
            'cx cx-pen' => 'pen',
            'cx cx-pencil' => 'pencil',
            'cx cx-pendrive' => 'pendrive',
            'cx cx-phone' => 'phone',
            'cx cx-pillar' => 'pillar',
            'cx cx-pin-man-range' => 'pin-man-range',
            'cx cx-pin-man' => 'pin-man',
            'cx cx-pin' => 'pin',
            'cx cx-plane' => 'plane',
            'cx cx-play-end' => 'play-end',
            'cx cx-play-next' => 'play-next',
            'cx cx-play-previous' => 'play-previous',
            'cx cx-play-start' => 'play-start',
            'cx cx-play-button' => 'play-button',
            'cx cx-play-store' => 'play-store',
            'cx cx-play' => 'play',
            'cx cx-playing-card' => 'playing-card',
            'cx cx-plus-box' => 'plus-box',
            'cx cx-plus-circle' => 'plus-circle',
            'cx cx-plus-gap' => 'plus-gap',
            'cx cx-plus-open' => 'plus-open',
            'cx cx-popup' => 'popup',
            'cx cx-power' => 'power',
            'cx cx-printer' => 'printer',
            'cx cx-progress-bar' => 'progress-bar',
            'cx cx-promo' => 'promo',
            'cx cx-pulse' => 'pulse',
            'cx cx-puzzle' => 'puzzle',
            'cx cx-question' => 'question',
            'cx cx-quote' => 'quote',
            'cx cx-radar' => 'radar',
            'cx cx-radiation' => 'radiation',
            'cx cx-reading-glass-alt' => 'reading-glass-alt',
            'cx cx-reading-glass' => 'reading-glass',
            'cx cx-recycle-bin' => 'recycle-bin',
            'cx cx-recycle' => 'recycle',
            'cx cx-refresh-time' => 'refresh-time',
            'cx cx-reply' => 'reply',
            'cx cx-responsive-device' => 'responsive-device',
            'cx cx-review' => 'review',
            'cx cx-rocket1' => 'rocket1',
            'cx cx-rocket2' => 'rocket2',
            'cx cx-rss' => 'rss',
            'cx cx-safety-cap' => 'safety-cap',
            'cx cx-safety-kit' => 'safety-kit',
            'cx cx-sand-watch' => 'sand-watch',
            'cx cx-scale' => 'scale',
            'cx cx-scanner' => 'scanner',
            'cx cx-scissor' => 'scissor',
            'cx cx-screen' => 'screen',
            'cx cx-search' => 'search',
            'cx cx-seo' => 'seo',
            'cx cx-server-network' => 'server-network',
            'cx cx-server' => 'server',
            'cx cx-share' => 'share',
            'cx cx-shield' => 'shield',
            'cx cx-ship' => 'ship',
            'cx cx-shirt' => 'shirt',
            'cx cx-shopping-bag1' => 'shopping-bag1',
            'cx cx-shopping-bag2' => 'shopping-bag2',
            'cx cx-shopping-bag3' => 'shopping-bag3',
            'cx cx-shopping-bag4' => 'shopping-bag4',
            'cx cx-shuffle' => 'shuffle',
            'cx cx-shutter' => 'shutter',
            'cx cx-sign-in' => 'sign-in',
            'cx cx-sign-out' => 'sign-out',
            'cx cx-sitemap1' => 'sitemap1',
            'cx cx-sitemap2' => 'sitemap2',
            'cx cx-skart' => 'skart',
            'cx cx-skull' => 'skull',
            'cx cx-skyscraper' => 'skyscraper',
            'cx cx-slider-doc' => 'slider-doc',
            'cx cx-slider-h-range' => 'slider-h-range',
            'cx cx-slider-image' => 'slider-image',
            'cx cx-slider-range-h' => 'slider-range-h',
            'cx cx-slider-v-open' => 'slider-v-open',
            'cx cx-slider-video' => 'slider-video',
            'cx cx-slider' => 'slider',
            'cx cx-smart-watch' => 'smart-watch',
            'cx cx-snow' => 'snow',
            'cx cx-spa-face' => 'spa-face',
            'cx cx-spa-stone-flower' => 'spa-stone-flower',
            'cx cx-spa-stone' => 'spa-stone',
            'cx cx-spark' => 'spark',
            'cx cx-speaker-off' => 'speaker-off',
            'cx cx-speaker-on' => 'speaker-on',
            'cx cx-spoon-fork' => 'spoon-fork',
            'cx cx-spoon' => 'spoon',
            'cx cx-star' => 'star',
            'cx cx-step-flow' => 'step-flow',
            'cx cx-steps' => 'steps',
            'cx cx-stop-watch' => 'stop-watch',
            'cx cx-stop' => 'stop',
            'cx cx-support-call' => 'support-call',
            'cx cx-tab' => 'tab',
            'cx cx-table-lamp' => 'table-lamp',
            'cx cx-tablet' => 'tablet',
            'cx cx-tag' => 'tag',
            'cx cx-target-arrow' => 'target-arrow',
            'cx cx-target' => 'target',
            'cx cx-target1' => 'target1',
            'cx cx-team-carousel' => 'team-carousel',
            'cx cx-team-member' => 'team-member',
            'cx cx-tennis-ball' => 'tennis-ball',
            'cx cx-terminal' => 'terminal',
            'cx cx-testimonial-carousel' => 'testimonial-carousel',
            'cx cx-testimonial' => 'testimonial',
            'cx cx-text-animation' => 'text-animation',
            'cx cx-theatre' => 'theatre',
            'cx cx-tick-circle' => 'tick-circle',
            'cx cx-tick' => 'tick',
            'cx cx-tickets' => 'tickets',
            'cx cx-tie-knot' => 'tie-knot',
            'cx cx-tie' => 'tie',
            'cx cx-timeline' => 'timeline',
            'cx cx-toggle' => 'toggle',
            'cx cx-tools' => 'tools',
            'cx cx-tree-square' => 'tree-square',
            'cx cx-twitter-bird' => 'twitter-bird',
            'cx cx-twitter' => 'twitter',
            'cx cx-ufo' => 'ufo',
            'cx cx-umbralla' => 'umbralla',
            'cx cx-unlock' => 'unlock',
            'cx cx-up-down' => 'up-down',
            'cx cx-upload' => 'upload',
            'cx cx-upward-top-right' => 'upward-top-right',
            'cx cx-user-female' => 'user-female',
            'cx cx-user-id' => 'user-id',
            'cx cx-user-male' => 'user-male',
            'cx cx-video-camera' => 'video-camera',
            'cx cx-water-drop' => 'water-drop',
            'cx cx-weather-cloud-day' => 'weather-cloud-day',
            'cx cx-weather-cloud' => 'weather-cloud',
            'cx cx-weather-day-rain' => 'weather-day-rain',
            'cx cx-weather-day-snow' => 'weather-day-snow',
            'cx cx-weather-day-windy-rain' => 'weather-day-windy-rain',
            'cx cx-weather-flood' => 'weather-flood',
            'cx cx-weather-night-cloud' => 'weather-night-cloud',
            'cx cx-weather-rain-alt' => 'weather-rain-alt',
            'cx cx-weather-rain' => 'weather-rain',
            'cx cx-weather-snow' => 'weather-snow',
            'cx cx-weather-sun-rain' => 'weather-sun-rain',
            'cx cx-weather-sun' => 'weather-sun',
            'cx cx-weather-sunny-day' => 'weather-sunny-day',
            'cx cx-weather-thunder' => 'weather-thunder',
            'cx cx-weather-windy-rain' => 'weather-windy-rain',
            'cx cx-webcam1' => 'webcam1',
            'cx cx-webcam2' => 'webcam2',
            'cx cx-weight-scale' => 'weight-scale',
            'cx cx-windows' => 'windows',
            'cx cx-wine-glass2' => 'wine-glass2',
            'cx cx-wine-glass' => 'wine-glass',
            'cx cx-worker-cap' => 'worker-cap',
            'cx cx-youtube' => 'youtube',
            'cx cx-centralize' => 'centralize',
            'cx cx-add-section' => 'add-section',
            'cx cx-advanced-heading' => 'advanced-heading',
            'cx cx-air-baloon' => 'air-baloon',
            'cx cx-arrow2' => 'arrow2',
            'cx cx-bicycle2' => 'bicycle2',
            'cx cx-bond2' => 'bond2',
            'cx cx-bond3' => 'bond3',
            'cx cx-bond4' => 'bond4',
            'cx cx-calendar2' => 'calendar2',
            'cx cx-carousel' => 'carousel',
            'cx cx-code-page' => 'code-page',
            'cx cx-comment-circle' => 'comment-circle',
            'cx cx-comment-square' => 'comment-square',
            'cx cx-copy' => 'copy',
            'cx cx-cursor' => 'cursor',
            'cx cx-envelop2' => 'envelop2',
            'cx cx-factory' => 'factory',
            'cx cx-finger-point' => 'finger-point',
            'cx cx-finger-swipe-both' => 'finger-swipe-both',
            'cx cx-finger-swipe-corner' => 'finger-swipe-corner',
            'cx cx-finger-swipe-left' => 'finger-swipe-left',
            'cx cx-finger-swipe-up' => 'finger-swipe-up',
            'cx cx-finger-swipe' => 'finger-swipe',
            'cx cx-finger-touch' => 'finger-touch',
            'cx cx-folder-sync' => 'folder-sync',
            'cx cx-graph-bar2' => 'graph-bar2',
            'cx cx-graph-pie2' => 'graph-pie2',
            'cx cx-heading-h' => 'heading-h',
            'cx cx-heading-html' => 'heading-html',
            'cx cx-heart' => 'heart',
            'cx cx-home2' => 'home2',
            'cx cx-indent-left' => 'indent-left',
            'cx cx-indent-right' => 'indent-right',
            'cx cx-lock-close' => 'lock-close',
            'cx cx-lock-open' => 'lock-open',
            'cx cx-map-pointer-add' => 'map-pointer-add',
            'cx cx-map-pointer-check' => 'map-pointer-check',
            'cx cx-map-pointer-delete' => 'map-pointer-delete',
            'cx cx-map-pointer2' => 'map-pointer2',
            'cx cx-map' => 'map',
            'cx cx-navigation1' => 'navigation1',
            'cx cx-navigation2' => 'navigation2',
            'cx cx-page-export' => 'page-export',
            'cx cx-page-sync' => 'page-sync',
            'cx cx-piramid' => 'piramid',
            'cx cx-plug' => 'plug',
            'cx cx-point-marker' => 'point-marker',
            'cx cx-quote2' => 'quote2',
            'cx cx-refresh-check' => 'refresh-check',
            'cx cx-refresh' => 'refresh',
            'cx cx-refresh2' => 'refresh2',
            'cx cx-scrolling-image' => 'scrolling-image',
            'cx cx-sign-turn-right' => 'sign-turn-right',
            'cx cx-speedometer' => 'speedometer',
            'cx cx-sticky' => 'sticky',
            'cx cx-sync-cloud' => 'sync-cloud',
            'cx cx-sync' => 'sync',
            'cx cx-sync2' => 'sync2',
            'cx cx-table-lamp2' => 'table-lamp2',
            'cx cx-target2' => 'target2',
            'cx cx-timeline-spiral' => 'timeline-spiral',
            'cx cx-tv' => 'tv',
            'cx cx-vespa' => 'vespa',
            'cx cx-codexseaddons' => 'codexseaddons',
        ];
    }
}

Icons_Manager::init();
