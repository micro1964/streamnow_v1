<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Excel;

use App\User;

use App\LiveVideo;

use App\UserSubscription;

use App\LiveVideoPayment;

use App\VodVideo;

use App\PayPerView;

use Exception;

use Setting;



class AdminExportController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');  
    }
    
    /**
	 * Function Name: users_export()
	 *
	 * @uses used export the users details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function users_export(Request $request) {

    	try {

    		// Get the admin selected format for download

    		$format = $request->format ? $request->format : 'xls';

	    	$download_filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid();

	    	$result = User::orderBy('created_at' , 'desc')->get();

	    	// Check the result is not empty

	    	if(count($result) == 0) {
            	
            	return redirect()->route('admin.users.index')->with('flash_error' , tr('no_user_found'));

	    	}

	    	Excel::create($download_filename, function($excel) use($result)
		    {
		        $excel->sheet('USERS', function($sheet) use($result) 
		        {

	 				$sheet->row(1, function($first_row) {
	                    $first_row->setAlignment('center');

	                });

	                $sheet->setHeight(50);

					$sheet->setAutoSize(true);

					$sheet->setAllBorders('thin');
			        
			        $sheet->setFontFamily('Comic Sans MS');

					$sheet->setFontSize(15);
				
					// Set height for a single row

		    		$sheet->setAutoFilter();

		    		$title = tr('users_management');

			        $sheet->loadView('exports.users')->with('data' , $result)->with('title' , $title);

			    });
		    
		    })->export($format);

            return redirect()->route('admin.users.index')->with('flash_success' , tr('export_success'));

		} catch(\Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.users.index')->with('flash_error' , $error);

        }

    }

     /**
	 * Function Name: livevideos_export()
	 *
	 * @uses used export the video details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function livevideos_export(Request $request) {

    	try {

    		// Get the admin selected format for download

    		$format = $request->format ? $request->format : 'xls';

	    	$download_filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid();

	    	$result = LiveVideo::orderBy('created_at' , 'desc')->get();

	    	// Check the result is not empty

	    	if(count($result) == 0) {
            	
            	return redirect()->route('admin.videos.videos_list')->with('flash_error' , tr('no_results_found'));

	    	}

	    	Excel::create($download_filename, function($excel) use($result)
		    {
		        $excel->sheet('LIVEVIDEO', function($sheet) use($result) 
		        {

	 				$sheet->row(1, function($first_row) {
	                    $first_row->setAlignment('center');

	                });

	                $sheet->setHeight(50);

					$sheet->setAutoSize(true);

					$sheet->setAllBorders('thin');
			        
			        $sheet->setFontFamily('Comic Sans MS');

					$sheet->setFontSize(15);
				
					// Set height for a single row

		    		$sheet->setAutoFilter();

		    		$title = tr('live_videos_management');

			        $sheet->loadView('exports.live_videos')->with('data' , $result)->with('title' , $title);

			    });
		    
		    })->export($format);

            return redirect()->route('admin.videos.videos_list')->with('flash_success' , tr('export_success'));

		} catch(\Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.videos.videos_list')->with('flash_error' , $error);

        }

    }

   	/**
	 * Function Name: subscriptions_export()
	 *
	 * @uses used export the subscription details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function subscriptions_export(Request $request) {

    	try {

    		// Get the admin selected format for download

    		$format = $request->format ? $request->format : 'xls';

	    	$download_filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid();

	    	$result = UserSubscription::orderBy('created_at' , 'desc')->get();

	    	// Check the result is not empty

	    	if(count($result) == 0) {
            	
            	return redirect()->route('admin.payments.user-payments')->with('flash_error' , tr('no_results_found'));

	    	}

	    	Excel::create($download_filename, function($excel) use($result)
		    {
		        $excel->sheet('SUBSCRIPTION', function($sheet) use($result) 
		        {

	 				$sheet->row(1, function($first_row) {
	                    $first_row->setAlignment('center');

	                });

	                $sheet->setHeight(50);

					$sheet->setAutoSize(true);

					$sheet->setAllBorders('thin');
			        
			        $sheet->setFontFamily('Comic Sans MS');

					$sheet->setFontSize(15);
				
					// Set height for a single row

		    		$sheet->setAutoFilter();

		    		$title = tr('subscription_management');

			        $sheet->loadView('exports.subscription')->with('data' , $result)->with('title' , $title);

			    });
		    
		    })->export($format);

            return redirect()->route('admin.payments.user-payments')->with('flash_success' , tr('export_success'));

		} catch(\Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.payments.user-payments')->with('flash_error' , $error);

        }

    }


    /**
	 * Function Name: payperview_export()
	 *
	 * @uses used export the payperview payments details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function payperview_export(Request $request) {

    	try {

    		// Get the admin selected format for download

    		$format = $request->format ? $request->format : 'xls';

	    	$download_filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid();

	    	$result = LiveVideoPayment::orderBy('created_at' , 'desc')->get();

	    	// Check the result is not empty

	    	if(count($result) == 0) {
            	
            	return redirect()->route('admin.payments.video-payments')->with('flash_error' , tr('no_results_found'));

	    	}

	    	Excel::create($download_filename, function($excel) use($result)
		    {
		        $excel->sheet('PAYPERVIEW', function($sheet) use($result) 
		        {

	 				$sheet->row(1, function($first_row) {
	                    $first_row->setAlignment('center');

	                });

	                $sheet->setHeight(50);

					$sheet->setAutoSize(true);

					$sheet->setAllBorders('thin');
			        
			        $sheet->setFontFamily('Comic Sans MS');

					$sheet->setFontSize(15);
				
					// Set height for a single row

		    		$sheet->setAutoFilter();

		    		$title = tr('subscription_management');

			        $sheet->loadView('exports.payperview')->with('data' , $result)->with('title' , $title);

			    });
		    
		    })->export($format);

            return redirect()->route('admin.payments.video-payments')->with('flash_success' , tr('export_success'));

		} catch(\Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.payments.video-payments')->with('flash_error' , $error);

        }


    }

    /**
	 * Function Name: vod_payments_export()
	 *
	 * @uses used export the vod payments details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function vod_payments_export(Request $request) {

    	try {

    		// Get the admin selected format for download

    		$format = $request->format ? $request->format : 'xls';

	    	$download_filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid();

	    	$result = PayPerView::orderBy('created_at' , 'desc')->get();

	    	// Check the result is not empty

	    	if(count($result) == 0) {
            	
            	return redirect()->route('admin.vod-videos.payments.list')->with('flash_error' , tr('no_results_found'));

	    	}

	    	Excel::create($download_filename, function($excel) use($result)
		    {
		        $excel->sheet('VOD-PAYMENTS', function($sheet) use($result) 
		        {

	 				$sheet->row(1, function($first_row) {
	                    $first_row->setAlignment('center');

	                });

	                $sheet->setHeight(50);

					$sheet->setAutoSize(true);

					$sheet->setAllBorders('thin');
			        
			        $sheet->setFontFamily('Comic Sans MS');

					$sheet->setFontSize(15);
				
					// Set height for a single row

		    		$sheet->setAutoFilter();

		    		$title = tr('vod_management');

			        $sheet->loadView('exports.vod-payments')->with('data' , $result)->with('title' , $title);

			    });
		    
		    })->export($format);

            return redirect()->route('admin.vod-videos.payments.list')->with('flash_success' , tr('export_success'));

		} catch(\Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.vod-videos.payments.list')->with('flash_error' , $error);

        }
    }

     /**
	 * Function Name: vod_videos_export()
	 *
	 * @uses used export the vod videos details into the selected format
	 *
	 * @created Maheswari
	 *
	 * @edited Maheswari
	 *
	 * @param string format (xls, csv or pdf)
	 *
	 * @return redirect users page with success or error message 
	 */
    public function vod_videos_export(Request $request) {

    	try {

    		// Get the admin selected format for download

    		$format = $request->format ? $request->format : 'xls';

	    	$download_filename = routefreestring(Setting::get('site_name'))."-".date('Y-m-d-h-i-s')."-".uniqid();

	    	$result = VodVideo::orderBy('created_at' , 'desc')->get();

	    	// Check the result is not empty

	    	if(count($result) == 0) {
            	
            	return redirect()->route('admin.vod-videos.index')->with('flash_error' , tr('no_results_found'));

	    	}

	    	Excel::create($download_filename, function($excel) use($result)
		    {
		        $excel->sheet('VOD-VIDEOS', function($sheet) use($result) 
		        {

	 				$sheet->row(1, function($first_row) {
	                    $first_row->setAlignment('center');

	                });

	                $sheet->setHeight(50);

					$sheet->setAutoSize(true);

					$sheet->setAllBorders('thin');
			        
			        $sheet->setFontFamily('Comic Sans MS');

					$sheet->setFontSize(15);
				
					// Set height for a single row

		    		$sheet->setAutoFilter();

		    		$title = tr('vod_management');

			        $sheet->loadView('exports.vod-videos')->with('data' , $result)->with('title' , $title);

			    });
		    
		    })->export($format);

            return redirect()->route('admin.vod-videos.index')->with('flash_success' , tr('export_success'));

		} catch(\Exception $e) {

            $error = $e->getMessage();

            return redirect()->route('admin.vod-videos.index')->with('flash_error' , $error);

        }
    }
}
