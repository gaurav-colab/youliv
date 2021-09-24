<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use App\SiteSettings;
use App\Favorite;
use Auth;
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
    public function boot()
    {
		 Schema::defaultStringLength(191);
		 View::composer('*', function ($view) {
			 $fav_array=array();
			  $sitesetting = SiteSettings::first();
		       if($sitesetting)
			   {
				   $site_title=$sitesetting->title;
				   $meta_description=$sitesetting->meta_description;
			   }
			   else
			   {
				   $site_title="YouLiv: Rent verified, broker free rooms, flats, PG, houses | Book Now";
				   $meta_description="YouLiv assists you find and rent verified, brokerage free rooms, flats, PG, houses, apartments, and private hostels for working professionals, students in Chandigarh, Panchkula, Mohali. Book now! Your young living spaces, ladies pg and hotels, men pg and hostels with a free guided visit and personal assistance.";
			   }
			   
			   if(Auth::user())
			   {
				   $favs=Favorite::where([['user_id',Auth::user()->id]])->with('property')->get();				  
				   if(count($favs))
				   {
					   foreach($favs as $key=>$value)
					   {
						   array_push($fav_array,$value->property_id);
					   }
				   }
			   }
			   $server_path=config('app.server_path');
			   $view->with(compact('site_title','meta_description','fav_array','server_path'));
			
		 });
    }

}
