<?php
declare(strict_types = 1 );
namespace App;

class Routes {
    private static  array $routes = [
        // Get routes
        ['GET', '/', 'PagesController#index'],
        ['GET', '/product', 'ProductController#index'],
        
        ['GET', '/product/add', 'ProductController#add'],
        ['GET', '/product/edit/[i:id]', 'ProductController#edit'],
        ['GET', '/product/update/[i:id]', 'ProductController#update'],
        // Post routes
        ['POST', '/product/delete', 'ProductController#delete'],
        ['POST', '/product/add', 'ProductController#add'],
        ['POST', '/product/update', 'ProductController#update'],

        /*  =============    
                Admin     
            ============= */

        // Get routes
        ['GET', '/admin', 'AdminController#index'],
        ['GET', '/admin/login', 'AdminController#login'],
        // Post Routes
        ['POST', '/admin/login', 'AdminController#login'],
        
        /* =============    
                Location  
           ============= */

        // Get Routes
        ['GET', '/admin/location', 'LocationController#index'],
        ['GET', '/admin/location/add', 'LocationController#add'],
        ['GET', '/admin/location/update/[i:id]', 'LocationController#update'],

        // Post Routes
        ['POST', '/admin/location/add', 'LocationController#add'],
        ['POST', '/admin/location/delete', 'LocationController#delete'],
        ['POST', '/admin/location/update', 'LocationController#update'],

        /*  =============    
                Category  
            ===========  */

        // Get Routes
        ['GET', '/admin/category', 'CategoryController#index'],
        ['GET', '/admin/category/add', 'CategoryController#add'],
        ['GET', '/admin/category/update/[i:id]', 'CategoryController#update'],

        // Post Routes
        ['POST', '/admin/category/add', 'CategoryController#add'],
        ['POST', '/admin/category/delete', 'CategoryController#delete'],
        ['POST', '/admin/category/update', 'CategoryController#update'],

        /*  =============    
            Building  
         ===========  */

        // Get routes
        ['GET', '/admin/building', 'BuildingController#index'],
        ['GET', '/admin/building/add', 'BuildingController#add'],
        ['GET', '/admin/building/update', 'BuildingController#update'],
        ['GET', '/admin/building/update/[i:id]', 'BuildingController#update'],

        // Post routes 
        ['Post', '/admin/building/add', 'BuildingController#add'],
        ['POST', '/admin/building/update', 'BuildingController#update'],








    ];
        

    public static function registeredRoutes(): array {
        return static::$routes;
    }
}