<?php
namespace App\Http\Controllers\Traits;

trait UserLinks {
    public function linkList()
    {
        return $data = array(
            'user_sidebar' => session('user_links'), 
            'sidebarGroup' => session('link_group'), 
        );
    }
}