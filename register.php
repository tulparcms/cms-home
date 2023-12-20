<?php
/**
 * bu eklenti CMS için
 */
defined('HOME_FOLDER') or define('HOME_FOLDER', 'tulparcms/cms-home-main');
defined('HOME_LANG') or define('HOME_LANG', 'tulparcms/cms-home-main::localize.');

if(is_file(__DIR__.'/model/TcmsHome.php')){
    include_once(__DIR__.'/model/TcmsHome.php');
}
if(is_file(__DIR__.'/controller/TcmsHomeController.php')){
    include_once(__DIR__.'/controller/TcmsHomeController.php');
}
TCMS()->addAction('localize', 'cms_home_localize', 1);
function cms_home_localize(){
    $path = storage_path('tcms/'.HOME_FOLDER.'/lang');
    \Lang::addNamespace(HOME_FOLDER, $path);
}
TCMS()->addAction('routing', 'cms_home_routing', 1);
function cms_home_routing(){
    Route::group([
        'prefix'=>\Tulparstudyo\Cms\CmsLoader::ADMIN,
        'as'=>\Tulparstudyo\Cms\CmsLoader::ADMIN.'.home.',
        'middleware' => ['web', \Tulparstudyo\Cms\CmsLoader::AUTH]
    ], function() {
        Route::get('/', ['App\\Http\\Controllers\\TcmsHomeController', 'index'])->name('index');
    });
}
TCMS()->addFilter('system_menu', 'cms_home_system_menu', 1);
function cms_home_system_menu($menu, $data){
    $menu[] = new  \Tulparstudyo\Cms\CmsMenuItem(
        'home',
        __('tulparstudyo/cms-home::localize.Dahboard') ,
        route('admin.home.index'),
        'class',
        'icon');
    return $menu;
}
