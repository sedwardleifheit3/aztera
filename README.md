# aztera-enartis
Web Application to manage wine sensors. We are building this for AZTERA, main client is Enartis.

[![Laravel 5.5](https://travis-ci.org/laravel/framework.svg)](https://github.com/laravel/laravel) 


----

**Initial Setup**

**Install required packages**
`composer update`

**Migration**
`php artisan migrate`

**Refresh**
`php artisan migrate --seed`

**Compiling Assets (Laravel Mix)**

*Development
    `npm run watch'
    `npm run dev`
*Production  
    `npm run production`

    
##Frontend

**Javascript**
    /resources
        /assets
            /js
                /components   -- one component per entity (example clients, staffs)
                /vendors      -- plugins, which are from nifty theme
                api-core.js   -- API core
                app.js        -- Main scripts (all required scripts, should be declared here
                                          

**SASS**
     /resources
        /assets
            /sass
                app.scss            --  Main
                _variables.scss     --  Variables
                _adjustments.scss   -- override style here 
                

##REST API
    /app/Http/Controllers/Api                
                # aztera
