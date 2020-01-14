<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {

            $menuPrincipal = array();

            $event->menu->add('MENU');

            $menus = Menu::whereNull('a001_id_pai')->where('a001_status', 1)->orderBy('a001_ordem', 'ASC')->get();


            foreach ( $menus as $value) {

                $urlPrincial = isset($value->a001_url) ? $value->a001_url : null;

                $menuPrincipal[$value->a001_id_menu] = ['id' => $value ->a001_id_menu, 'text' => $value->a001_descricao, 'name' => $urlPrincial, 'can' => 'show-'.$urlPrincial];
            }


            foreach ( $menuPrincipal as $value) {

                $rolesSub = Menu::where('a001_id_pai', $value['id'])->where('a001_status', 1)->orderBy('a001_ordem', 'ASC')->get();

               foreach ($rolesSub as $sub) {
                       $menuPrincipal[$value['id']]['submenu'][] = ['text' => $sub->a001_descricao,  'url' =>  $sub->a001_url,];

               }
            }


            foreach ($menuPrincipal as $value) {

                $subMenu = array();

                if(isset( $value['submenu'])) {
                    $url = 'submenu';

                    foreach ( $value['submenu'] as $subb) {
                        $subMenu[] = $subb;
                    }

                } else {
                    $url = 'url';
                    $subMenu = $value['name'];
                }

                $event->menu->add([
                    'text' =>  $value['text'],
                    'icon'    => 'fas fa-fw fa-share',
                     $url => $subMenu

                ]);

            }

        });
    }
}
