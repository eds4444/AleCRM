<?php
/**
 * Plugin Name:       AleCRM
 * Plugin URI:        https://alethemes.com/alecrm
 * Description:       Плагин для организации работы предприятия.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.3
 * Author:            Dmitry
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       alecrm
 * Domain Path:       /lang
*/

//проверка, если обращается к коду CMS то переходим дальше, если сторонний ресурс то die
if ( !defined('ABSPATH')) {
    die ('у вас нет прав просмативать эту страницу');
}


//вывод пункта меню
function alecrm_show_nav_item(){
   add_menu_page(
       esc_html__( 'Welcome to plugin page', 'alecrm'),// esc указываем для разных языков
       esc_html__( 'AleCRM Options', 'alecrm'),//название кнопки в админке
       'manage_options',//кто будет работать
       'alecrm-options',//идентификатор в строке поиска для подключения файлов при активации этого плагина
       'alecrm_show_content',//функция вывода
       'dashicons-art', //иконка
       9//если надо две кнопки но выделенных позиций не хватает, ставим не уникальные номера(одинаковые)
        
   );
};
add_action('admin_menu', 'alecrm_show_nav_item'); //хук которым цепляемся к админ меню для добавления нашей кнопки


//подгрузка языковых пакетов
function alecrm_load_plugin_textdomain(){
    load_plugin_textdomain('alecrm', FALSE, basename( dirname( __FILE__)) . '/lang/' );    
}
add_action('plugins_loaded', 'alecrm_load_plugin_textdomain');


//тело нашей страницы
function alecrm_show_content(){//ф-я которая выводит функционал плагина
    esc_html_e('Hello', 'alecrm');// ф-я _е включает себя echo и нужна для перевода текста

    echo '<br>' . esc_html__('First', 'alecrm');
}

//регистрация скриптов и стилей css js
function alecrm_register_assets(){
    wp_register_style('alecrm_styles', plugins_url('assets/css/admin.css', __FILE__));
    wp_register_script('alecrm_scripts', plugins_url('assets/js/admin.js', __FILE__));
}
add_action('admin_enqueue_scripts', 'alecrm_register_assets');//хук, искать wp hook list


//подключение скриптов и стилей css js
function alecrm_load_assets($hook){
     //проверкой подключаем стили и скрипты только на странице нашего плагина
     if ($hook != 'toplevel_page_alecrm-options') {
         return;
     }
     wp_enqueue_style('alecrm_styles');
     wp_enqueue_script('alecrm_scripts');                                    
}
add_action('admin_enqueue_scripts', 'alecrm_load_assets');




















