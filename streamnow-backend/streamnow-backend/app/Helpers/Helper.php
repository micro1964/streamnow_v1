<?php

namespace App\Helpers;

use Hash;

use App\User;

use File;

use Setting;

use Intervention\Image\ImageManagerStatic as Image;

use Log;

use Mailgun\Mailgun;

use Mail;

class Helper {

	public static function generate_token() {
        return Helper::clean(Hash::make(rand() . time() . rand()));
    }

    public static function generate_token_expiry() {
       // return time() + 24*3600*30;  // 30 days

         return time() + Setting::get('token_expiry_hour') * 3600;  // 30 days
    }

    public static function clean($string) {

        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function web_url() {
        return url('/');
    }

    public static function generate_email_code($value = "")
    {
        return uniqid($value);
    }

    public static function generate_email_expiry()
    {
        return time() + 24*3600*30;  // 30 days
    }

    /**
     * Used to generate index.php
     *
     * 
     */

    public static function generate_index_file($folder) {

        $filename = public_path()."/".$folder."/index.php"; 

        if(!file_exists($filename)) {

            $index_file = fopen($filename,'w');

            $sitename = Setting::get("site_name");

            fwrite($index_file, '<?php echo "You Are trying to access wrong path!!!!--|E"; ?>');       

            fclose($index_file);
        }
    
    }

    // Check whether email verification code and expiry

    public static function check_email_verification($verification_code , $data , &$error) {

        \Log::info("EMAIL Verification CODE".print_r($verification_code , true));


        // Check the data exists

        if($data) {

            // Check whether verification code is empty or not

            if($verification_code) {

                if ($verification_code !=  $data->verification_code ) {

                    $error = tr('varification_code_mismatch');

                    return FALSE;

                }

            }
                
            // Check whether verification code expiry 

            if ($data->verification_code_expiry > time() && $data->verification_code_expiry && $data->verification_code) {

                // Token is valid

                $error = NULL;

                return true;

            } else {

                $data->verification_code = Helper::generate_email_code();

                $data->verification_code_expiry = Helper::generate_email_expiry();

                $data->save();

                // If code expired means send mail to that user

                $subject = tr('new_user_signup').' '.Setting::get('site_name');
                $email_data = $data;
                $page = "emails.user.welcome";
                $email = $data['email'];
                $result = Helper::send_email($page,$subject,$email,$email_data);

                $error = tr('varification_code_expired');

                return FALSE;
            }
        }
   
    }


    public static function error_message($code, $other_key = "") {

        switch($code) {
            case 001 :
                $string = tr('invalid_input');
                break;
            case 002 :
                $string = tr('email_already_use');
                break;
            case 003 :
                $string = tr('went_wrong');
                break;
            case 102:
                $string = tr('email_already_use');
                break;
            case 103:
                $string = tr('token_expiry');
                break;
            case 104:
                $string = tr('invalid_token');
                break;
            case 105:
                $string = tr('invalid_email_password');
                break;
            case 106:
                $string = tr('all_fields_required');
                break;
            case 107:
                $string = tr('current_password_incorrect');
                break;
            case 108:
                $string = tr('password_do_not_match');
                break;
            case 109:
                $string = tr('account_verify');
                break;
            case 111:
                $string = tr('email_not_activated');
                break;
            case 131:
                $string = tr('old_password_doesnot_match');
                break;
            case 146:
                $string = tr('something_went_wrong');
                break;
            case 147 :
                $string = tr('streaming_stopped');
                break;
            case 148:
                $string = tr('not_yet_started');
                break;
            case 149 :
                $string = tr('no_video_found');
                break;
            case 150 :
                $string = tr('no_user_found');
                break;
            case 151 :
                $string = tr('no_followers');
                break;
            case 152 :
                $string = tr('already_follow');
                break;
            case 153 :
                $string = tr('already_blocked_user');
                break;
            case 154 :
                $string = tr('user_not_subscribed');
                break;
            case 155 :
                $string = tr('same_user_block_disable');
                break;
            case 156 :
                $string = tr('pay_see_view_video');
                break;
            case 157:
                $string = tr('redeem_disabled_by_admin');
                break;
            case 158:
                $string = tr('minimum_redeem_not_have');
                break;
            case 159:
                $string = tr('redeem_wallet_empty');
                break;
            case 160:
                $string = tr('redeem_request_status_mismatch');
                break;
            case 161:
                $string = tr('redeem_not_found');
                break;
            case 163:
                $string = tr('user_payment_details_not_found');
                break;
            case 164:
                $string = tr('subscription_autorenewal_already_cancelled');
                break;
            case 165:
                $string = tr('subscription_autorenewal_already_enabled');
                break;
            case 166 :
                $string = tr('publish_time_should_not_lesser');
                break;
            case 167:
                $string = tr('coupon_not_found');
                break;
            case 168:
                $string = tr('coupon_inactive_status');
                break;
            case 169:
                $string = tr('subscription_not_found');
                break;
            case 170:
                $string = tr('subscription_inactive_status');
                break;
            case 171:
                $string = tr('subscription_amount_should_be_grater');
                break;
            case 172:
                $string = tr('video_amount_should_be_grater');
                break;
            case 173:
                $string = tr('expired_coupon_code');
                break;
            case 174:
                $string = tr('card_add_failed');
                break; 

            case 175:
                $string = tr('failed_to_upload');
                break;

            case 502:
                $string = tr('user_account_declined_by_admin');
                break;
            case 503:
                $string = tr('user_account_email_not_verified');
                break;
            case 504:
                $string = tr('id_token_required');
                break;
            case 505:
                $string = tr('user_details_not_found');
                break;

            case 901:
                $string = tr('default_card_not_available');
                break;
            case 902:
                $string = tr('something_went_wrong_error_payment');
                break;
            case 903:
                $string = tr('payment_not_completed_pay_again');
                break;
             case 904:
                $string = tr('you_are_not_authroized_person');
                break;
            case 906:
                    $string = tr('video_data_not_found');
                    break;



            // Live Group

            case 907:
                $string = tr('live_groups_error');
                break;
            case 908:
                $string = tr('live_groups_not_found');
                break;
            case 909:
                $string = tr('live_group_access_denied');
                break;
            case 910:
                $string = tr('member_not_found');
                break;
            case 911:
                $string = tr('member_access_denied');
                break;
            case 912:
                $string = tr('member_already_in_group');
                break;
            case 913:
                $string = tr('member_not_in_group');
                break;
            case 914:
                $string = tr('owner_tried_as_member');
                break;
            case 915:
                $string = tr('owner_only_can_add_member');
                break;
            case 916:
                $string = tr('owner_only_can_remove_member');
                break;


                    
            default:
                $string = tr('unknown_error');
                break;
        }
        return $string;
        
    }

    public static function get_message($code, $other_key = "") {

        switch($code) {

            case 101:
                $string = tr('success');
                break;
            case 102:
                $string = tr('password_change_success');
                break;
            case 103:
                $string = tr('successfully_logged_in');
                break;
            case 104:
                $string = tr('successfully_logged_out');
                break;
            case 105:
                $string = tr('successfully_sign_up');
                break;
            case 106:
                $string = tr('mail_sent_successfully');
                break;
            case 107:
                $string = tr('ppv_payment_success');
                break;
            case 108:
                $string = tr('favourite_provider_delete');
                break;
            case 109:
                $string = tr('payment_mode_changed');
                break;
            case 110:
                $string = tr('payment_mode_changed');
                break;
            case 111:
                $string = tr('service_accepted');
                break;
            case 112:
                $string = tr('provider_started');
                break;
            case 113:
                $string = tr('arrived_service_location');
                break;
            case 114:
                $string = tr('service_started');
                break;
            case 115:
                $string = tr('service_completed');
                break;
            case 116:
                $string = tr('user_rating_done');
                break;
            case 117:
                $string = tr('request_cancelled_successfully');
                break;
            case 118:
                $string = tr('wishlist_added');
                break;
            case 119:
                $string = tr('payment_confirmed_successfully');
                break;
            case 120:
                $string = tr('history_added');
                break;
            case 121:
                $string = tr('history_deleted_successfully');
                break;
            case 122 :
                $string = tr('success_un_followed');

                break;

            case 123 :

                $string = tr('success_followed');

                break;

            case 124:

                $string = tr('user_blocked');

                break; 

            case 125:

                $string = tr('user_un_blocked');

                break; 

            case 126:
                $string = tr('autorenewal_enable_success');
                break;

            case 127:
                $string = tr('ppv_not_set');
                break;

            case 128:
                $string = tr('watch_video_success');
                break;

            case 129:
                $string = tr('pay_and_watch_video');
                break;

            // Live group

            case 130:
                $string = tr('live_groups_created_success');
                break; 
            case 131:
                $string = tr('live_groups_updated_success');
                break; 
            case 132:
                $string = tr('live_groups_deleted_success');
                break;
            case 133:
                $string = tr('member_added_success' , $other_key);
                break;
            case 134:
                $string = tr('member_removed_success' , $other_key);
                break;

            default:
                $string = "";
        
        }
        
        return $string;
    }

    // Convert all NULL values to empty strings
    public static function null_safe($arr) {
        $newArr = array();
        foreach ($arr as $key => $value) {
            $newArr[$key] = ($value == NULL && $value != 0) ? "" : $value;
        }
        return $newArr;
    }

    public static function send_email($page,$subject,$email,$email_data) {

        \Log::info("Email Notification ".Setting::get('email_notification'));
            
            if(envfile('MAIL_USERNAME') &&  envfile('MAIL_PASSWORD')) {
                                       
                try {

                    $site_url=url('/');

                    $isValid = 1;

                    if(envfile('MAIL_DRIVER') == 'mailgun' && Setting::get('MAILGUN_PUBLIC_KEY')) {

                        Log::info("isValid - STRAT");

                        # Instantiate the client.

                        $email_address = new Mailgun(Setting::get('MAILGUN_PUBLIC_KEY'));

                        $validateAddress = $email;

                        # Issue the call to the client.
                        $result = $email_address->get("address/validate", array('address' => $validateAddress));

                        # is_valid is 0 or 1

                        $isValid = $result->http_response_body->is_valid;

                        Log::info("isValid FINAL STATUS - ".$isValid);

                    }

                    if($isValid) {

                        \Log::info("Email Inside ");

                        if (Mail::queue($page, array('email_data' => $email_data,'site_url' => $site_url), 
                                function ($message) use ($email, $subject) {

                                    $message->to($email)->subject($subject);
                                }
                        )) {

                           //  return Helper::get_message(106);

                        } else {

                            throw new Exception(Helper::get_error_message(123));
                            
                        }

                    } else {

                       // throw new Exception(Helper::get_message(106), 106);

                    }
                    
                   /* $mail = \Mail::send($page, array('email_data' => $email_data , 'site_url' => $site_url), function ($message) use ($email, $subject) {
                            $message->to($email)->subject($subject);
                    });*/

                } catch(\Exception $e) {

                    return response()->json(['success' => false ,  'error_messages'=>$e->getMessage()]);
                }

                return response()->json(['success' => true , 'message'=>Helper::get_message(106)]);

            } else {
                return response()->json(['success' => false , 'error_messages'=>tr('mail_not_configured_properly')]);
            }
        
        // }
       
    }

    // Note: $error is passed by reference
    public static function is_token_valid($entity, $id, $token, &$error) {
        if (
            ( $entity== 'USER' && ($row = User::where('id', '=', $id)->where('token', '=', $token)->first()) ) 
        ) {
            if ($row->token_expiry > time()) {
                // Token is valid
                $error = NULL;
                return $row;
            } else {
                $error = array('success' => false, 'error_messages' => Helper::error_message(103), 'error_code' => 103);
                return FALSE;
            }
        }
        $error = array('success' => false, 'error_messages' => Helper::error_message(104), 'error_code' => 104);
        return FALSE;
    }

    public static function file_name() {

        $file_name = time();
        $file_name .= rand();
        $file_name = sha1($file_name);

        return $file_name;
    }

    public static function upload_avatar($folder,$picture,$boolean = 0,$default_filename = "") {

        $file_name = $default_filename ? $default_filename : Helper::file_name();

        $ext = $picture->getClientOriginalExtension();

        $local_url = $file_name . "." . $ext;

        $ext = $picture->getClientOriginalExtension();

        $picture->move(public_path()."/".$folder, $file_name . "." . $ext);

        $url = Helper::web_url().'/'.$folder."/".$local_url;

        if ($boolean) {

            // open an image file
            $img = Image::make(public_path()."/".$folder."/".$local_url);

            // resize image instance
            $img->resize(60, 60);

            // save image in desired format
            $img->save(public_path()."/uploads/user_chat_img/".$local_url);


            $boolean->chat_picture = Helper::web_url()."/uploads/user_chat_img/".$local_url;
        }

        return $url;
    
    }

    public static function delete_avatar($folder,$picture) {
        File::delete( public_path() . "/".$folder."/". basename($picture));
        return true;
    }

    public static function delete_picture($picture, $path) {
        File::delete( public_path() . "/". $path ."/". basename($picture));
        return true;
    }

    public static function search_user($id, $key,$skip,$take) {

        $query = User::where('status', DEFAULT_TRUE)
            ->where('name', 'like', "%".$key."%")
            ->skip($skip)
            ->take($take);

        if(is_numeric($id)) {

            $user = User::find($id);

            $is_content_creator = VIEWER_STATUS;

            if ($user) {

                $is_content_creator = $user->is_content_creator;

            }

            if ($is_content_creator == VIEWER_STATUS) {

                $query->where('is_content_creator', CREATOR_STATUS);

            }

            $query->whereNotIn('id', [$id]);
        }

        $model = $query->get();

        return $model;

    }

    public static function generate_password() {

        $new_password = time();
        $new_password .= rand();
        $new_password = sha1($new_password);
        $new_password = substr($new_password,0,8);
        return $new_password;
    }

    /**
     * Function name: RTMP Secure video url 
     *
     * @description: used to convert the video to rtmp secure link
     *
     * @created: vidhya R
     * 
     * @edited: 
     *
     * @param string $video_name
     *
     * @param string $video_link
     *
     * @return RTMP SECURE LINK or Normal video link
     */

    public static function convert_normal_video_to_hlssecure($video_name  = "", $video_link = "") {

        if(Setting::get('HLS_SECURE_VIDEO_URL') != "") {

            // HLS_STREAMING_URL
        
            // validity of the link in seconds (if rtmp and www are on two different machines, it is better to give a higher value, because there may be a time difference.

            $expires = date('U')+20;

            // secure_link_md5 "$secure_link_expires$uri$remote_addr cgshlockkey";

            $secret_word = "cgshlockkey"; 

            $user_remote_address = $_SERVER['REMOTE_ADDR']; 

            // Log::info("user_remote_address".$user_remote_address);

            // $user_remote_address = "49.249.233.178";

            $md5 = md5("$expires/$video_name$user_remote_address $secret_word", true);

            $md5 = base64_encode($md5); 

            $md5 = strtr($md5, '+/', '-_'); 

            $md5 = str_replace('=', '', $md5); 

            $hls = $video_name."?md5=".$md5."&expires=".$expires; 
            
            $secure_url = Setting::get('HLS_SECURE_VIDEO_URL').$hls;

            return $secure_url; 
        
        } elseif (Setting::get('HLS_STREAMING_URL')) {

            $hls_video_url = Setting::get('HLS_STREAMING_URL').$video_name;

            return $hls_video_url;

        } else {

            return $video_link;

        }
        
    }

    public static function delete_language_files($folder, $boolean, $filename)
    {
        if ($boolean) {
            $folder = base_path() . "/resources/lang/" .$folder;
            \File::cleanDirectory($folder);
            \Storage::deleteDirectory( $folder );
            rmdir( $folder );
        } else {
            \File::delete( base_path() . "/resources/lang/" . $folder ."/".$filename);
        }
        return true;
    }

    public static function readFileLength($file)  {

        $variableLength = 0;

        if (($handle = fopen($file, "r")) !== FALSE) {
             $row = 1;
             while (($data = fgetcsv($handle, 1000, "\n")) !== FALSE) {
                $num = count($data);
                $row++;
                for ($c=0; $c < $num; $c++) {
                    $exp = explode("=>", $data[$c]);
                    if (count($exp) == 2) {
                        $variableLength += 1; 
                    }
                }
            }
            fclose($handle);
        }

        return $variableLength;
    }

    public static function upload_language_file($folder, $picture, $filename) {

        $ext = $picture->getClientOriginalExtension();
        
        $picture->move(base_path() . "/resources/lang/".$folder ."/", $filename);

    }
}