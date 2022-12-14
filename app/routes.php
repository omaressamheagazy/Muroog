<?php
declare(strict_types = 1 );
namespace App;

class Routes {
    private static  array $routes = [
        /*  =============    
                Pages     
        ============= */

        // Home page
        ['GET', '/', 'PagesController#index'],
        ['GET', '', 'PagesController#index'],
        // Project Page
        ['GET', '/project', 'PagesController#project'],
        // About page
        ['GET', '/about', 'PagesController#about'],
        // Contact Page
        ['GET', '/contact', 'PagesController#contact'],
        ['POST', '/contact', 'PagesController#contact'],
        // Project Detail page
        ['GET', '/project/[i:id]', 'PagesController#projectDetail'],
        // Service Pgae
        ['GET', '/service', 'PagesController#service'],
        
        
        /*  =============    
                Admin     
            ============= */

        // Get routes
        ['GET', '/admin', 'AdminController#index'],
        ['GET', '/admin/add', 'AdminController#add'],
        ['GET', '/admin/login', 'AdminController#login'],
        ['GET', '/admin/all', 'AdminController#allAdmin'],
        ['GET', '/admin/logout', 'AdminController#logout'],
        ['GET', '/admin/update/[i:id]', 'AdminController#update'],
        ['GET', '/admin/profile/[i:id]', 'AdminController#editProfile'],

        // Post Routes
        ['POST', '/admin/login', 'AdminController#login'],
        ['POST', '/admin/add', 'AdminController#add'],
        ['POST', '/admin/delete', 'AdminController#delete'],
        ['POST', '/admin/update', 'AdminController#update'],
        ['POST', '/admin/profile', 'AdminController#editProfile'],

        /*  =============    
                Password     
            ============= */

        // Get routes
        ['GET', '/reset', 'PasswordController#index'],
        ['GET', '/reset/update/[codeId:id]', 'PasswordController#update'],
        // Post routes
        ['POST', '/reset', 'PasswordController#add'],
        ['POST', '/reset/update', 'PasswordController#update'],



        
        
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
        ['POST', '/admin/building/delete', 'BuildingController#delete'],

        /*  =============    
            Error  
         ===========  */
        ['GET', '/error/404', 'ErrorController#index'],

        

    ];
        

    public static function registeredRoutes(): array {
        return static::$routes;
    }
}