<?php

namespace App\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Jobs\Job;
use App\Helpers\Helper;
use App\User;
use App\Provider;
use Setting;
use Log;

use App\Repositories\PushNotificationRepository as PushRepo;

class sendPushNotification extends Job implements ShouldQueue {

    use InteractsWithQueue, SerializesModels;

    protected $id;
    protected $push_type;
    protected $page_type;
    protected $title;
    protected $message;
    protected $live_video_id;
    protected $push_data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $push_type , $page_type , $title, $message , $live_video_id = "",$push_data) {

        $this->id = $id;
        $this->push_type = $push_type;
        $this->page_type = $page_type;
        $this->title = $title;
        $this->message = $message;
        $this->live_video_id = $live_video_id;
        $this->push_data = $push_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {

        // Check the user type whether "USER" or "PROVIDER"

        if($this->push_type == LIVE_PUSH) {

            // Get the followers list

            $followers_list = followers($this->id);

            if(count($followers_list) > 0 ) {

                foreach ($followers_list as $key => $follower_details) {

                    PushRepo::push_notification($follower_details->device_token, $this->title, $this->message, $this->push_data, $follower_details->device_type);
                    
                }
            }
        }
            
           
    }
}
