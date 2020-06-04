<?php

/**************************************************
* Repository Name: VideoRepository
*
* Purpose: This repository used to do all functions related videos.
*
* @author - Shobana Chandrasekar
*
* Date Created: 22 June 2017
**************************************************/

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Helpers\Helper;

use Validator;

use Hash;

use Log;

use Setting;

use App\PayPerView;

use App\VodVideo;

use DB;

use Exception;

use Auth;

use App\User;

class VodRepository {

    /**
     * Function Name : vod_videos_save()
     *
     * To save the uploadeed video by the content creator
     *
     * @created: Shobana Chandrasekar
     *
     * @edited: -
     *
     * @param object $request - VOD details
     *
     * @return response of jsonsuccess/ failure mesage 
     */
    public static function vod_videos_save(Request $request) {
        
        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(),
                array(
                    'title'=>'required|max:128',
                    'description'=>'required',
                    'image'=> $request->video_id ? 'mimes:jpeg,jpg,bmp,png' : 'required|mimes:jpeg,jpg,bmp,png',
                    'video'=> $request->video_id ? 'mimes:mp4' : 'required|mimes:mp4',
                    'video_id'=>'exists:vod_videos,unique_id,user_id,'.$request->user_id,
                    'user_id'=>'required|exists:users,id,status,'.DEFAULT_TRUE
                ));

            if ($validator->fails()) {

                // Error messages added in response for debugging
                
                $errors = implode(',',$validator->messages()->all());

                throw new Exception($errors, 101);


            } else {

                $user = User::find($request->user_id);

                $model = $request->video_id ? VodVideo::where('unique_id',$request->video_id)->first() :  new VodVideo;

                if (!$model) {

                    $model = new VodVideo;

                }

                $model->title = $request->title;

                $model->description = $request->description;

                $model->unique_id = $model->title;
                
                if ($request->hasFile('image')) {

                    if ($model->id) {

                        Helper::delete_avatar('uploads/images/vod', $model->image);

                    } 

                    $model->image = Helper::upload_avatar('uploads/images/vod', $request->file('image'), 0);

                }

                if ($request->hasFile('video')) {

                    if ($model->id) {

                        Helper::delete_avatar('uploads/videos/vod', $model->video);

                    } 

                    $model->video = Helper::upload_avatar('uploads/videos/vod', $request->file('video'), 0);

                }        

                $model->status = VOD_APPROVED_BY_USER;

                $model->admin_status = VOD_APPROVED_BY_ADMIN;      

                $model->user_id = $request->user_id;

                $model->created_by = $request->created_by ? $request->created_by : ADMIN;

                $timezone = $user ? $user->timezone : 'Asia/Kolkata';

                $current_date_time = date('Y-m-d H:i:s');

                $converted_current_datetime = convertTimeToUSERzone($current_date_time, $timezone);

                // Check the publish type based on that convert the time to timezone

                if ($request->publish_type == PUBLISH_LATER) {

                    $date_time = $request->publish_time;

                    $strtotime = strtotime($date_time);

                    $current_strtotime = strtotime($converted_current_datetime);

                    if ($strtotime <= $current_strtotime) {

                        throw new Exception(Helper::error_message(166), 166);

                    }

                    $model->publish_time = date('Y-m-d H:i:s', $strtotime);

                    // Based on publishing time the status will change

                    $model->publish_status = VIDEO_NOT_YET_PUBLISHED;

                } else {

                    $model->publish_time = $converted_current_datetime;

                    $model->publish_status = VIDEO_PUBLISHED;

                }

                if ($model->save()) {


                } else {

                    throw new Exception(tr('video_not_upload_proper'));
                    
                }
            }

            DB::commit();

            $model = VodVideo::vodResponse()->find($model->id);
            
            $response_array = ['success'=>true, 'message'=>tr('video_uploaded_success'), 'data'=>$model];

            return response()->json($response_array);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);

        }

    }

    /**
     * Function Name : vod_videos_status()
     *
     * To changes the video status as approve/decline by using this functonion
     *
     * @created: Shobana Chandrasekar
     *
     * @edited: -
     *
     * @param object $request - user id, token , status
     *
     * @return response of success/failure message
     */
    public static function vod_videos_status(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(),
                array(
                    'video_id'=>'required|exists:vod_videos,id,user_id,'.$request->user_id
                ));

            if ($validator->fails()) {

                // Error messages added in response for debugging
                
                $errors = implode(',',$validator->messages()->all());

                throw new Exception($errors, 101);


            } else {

                $model = VodVideo::find($request->video_id);

                if ($request->decline_by == CREATOR) {

                    $model->status = $model->status ? VOD_DECLINED_BY_USER : VOD_APPROVED_BY_USER;

                    $status = $model->status;

                } else {

                    $model->admin_status = $model->admin_status ? VOD_DECLINED_BY_ADMIN : VOD_APPROVED_BY_ADMIN;

                    $status = $model->admin_status;

                }

                if ($model->save()) {

                   

                } else {

                    throw new Exception(tr('vod_failure_status'));
                    
                }
            }

            DB::commit();

            $response_array = ['success'=>true, 'message'=>($status) ? tr('video_approve_success') : tr('video_decline_success')];

            return response()->json($response_array);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);

        }

    }

    /**
     * Function Name : vod_videos_delete
     *
     * To delete vod video based on the video id
     *
     * @created: Shobana Chandrasekar
     *
     * @edited: -
     *
     * @param object $request - User id, token & Video id
     *
     * @return response of json success/failure message
     */
    public static function vod_videos_delete(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(),
                array(
                    'video_id'=>'required|exists:vod_videos,id,user_id,'.$request->user_id,
                ));

            if ($validator->fails()) {

                // Error messages added in response for debugging
                
                $errors = implode(',',$validator->messages()->all());

                throw new Exception($errors, 101);


            } else {

                $model = VodVideo::find($request->video_id);

                $image = $model->image;

                $video = $model->video;

                if ($model->delete()) {

                    if ($image) {

                        Helper::delete_avatar('uploads/images/vod', $image);

                    }

                    if ($video) {

                        Helper::delete_avatar('uploads/videos/vod', $video);

                    }

                } else {

                    throw new Exception(tr('vod_delete_failure'));
                    
                }

            }

            DB::commit();

            $response_array = ['success'=>true, 'message'=>tr('vod_delete_success')];

            return response()->json($response_array);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);

        }
    
    }


    /**
     * Function Name : vod_videos_set_ppv()
     *
     * To set pay per view in VOD video based on video id
     *
     * @created: Shobana Chandrasekar
     *
     * @edited: -
     *
     * @param object $request - User id, token, video id, ppv details
     *
     * @return response of json success/failure message
     */
    public static function vod_videos_set_ppv(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(),
                array(
                    'video_id'=>'required|exists:vod_videos,id,user_id,'.$request->user_id.',status,'.DEFAULT_TRUE,
                    'amount'=>'required|numeric|min:0.1|max:100000',
                    'type_of_subscription'=>'required|in:'.ONE_TIME_PAYMENT.','.RECURRING_PAYMENT,
                    'type_of_user'=>'required|in:'.NORMAL_USER.','.PAID_USER.','.BOTH_USERS,
                ), array(

                    'exists'=>'The selected video not available',
                ));

            if ($validator->fails()) {

                // Error messages added in response for debugging
                
                $errors = implode(',',$validator->messages()->all());

                throw new Exception($errors, 101);

            } else {

                $model = VodVideo::find($request->video_id);

                $model->amount = $request->amount;

                $model->type_of_user = $request->type_of_user;

                $model->type_of_subscription = $request->type_of_subscription;

                $model->is_pay_per_view = PPV_ENABLED;

                if ($model->save()) {

                } else {

                    throw new Exception(tr('ppv_couldnt_set'));
                    
                }

            }

            DB::commit();

            $response_array = ['success'=>true, 'message' => tr('ppv_set_success')];

            return response()->json($response_array);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);

        }

    }


    /**
     * Function Name : vod_videos_remove_ppv()
     *
     * To remove pay per view in VOD video based on video id
     *
     * @created: Shobana Chandrasekar
     *
     * @edited: -
     *
     * @param object $request - User id, token, video id, ppv details
     *
     * @return response of json success/failure message
     */
    public static function vod_videos_remove_ppv(Request $request) {

        try {


            DB::beginTransaction();

            $validator = Validator::make($request->all(),
                array(
                    'video_id'=>'required|exists:vod_videos,id,user_id,'.$request->user_id.',status,'.DEFAULT_TRUE,
                ), array(

                    'exists'=>'The selected video not available',
                ));

            if ($validator->fails()) {

                // Error messages added in response for debugging
                
                $errors = implode(',',$validator->messages()->all());

                throw new Exception($errors, 101);


            } else {

                $model = VodVideo::find($request->video_id);

                $model->amount = 0 ;

                $model->type_of_user = 0;

                $model->type_of_subscription = 0;

                $model->is_pay_per_view = PPV_DISABLED;

                if ($model->save()) {

                } else {

                    throw new Exception(tr('ppv_couldnt_remove'));
                    
                }

            }

            DB::commit();

            $response_array = ['success'=>true, 'message' => tr('ppv_remove_success')];

            return response()->json($response_array);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);

        }

    }

    /**
     * Function Name : vod_videos_publish()
     *
     * To Publish the video for user
     *
     * @created_by - Shobana Chandrasekar
     *
     * @updated_by - -  
     *
     * @param object $request : Video details with user details
     *
     * @return Flash Message
     */
    public static function vod_videos_publish(Request $request) {

        try {

            $validator = Validator::make($request->all(),
                array(
                    'video_id'=>'required|exists:vod_videos,id,user_id,'.$request->user_id
                ));

            if ($validator->fails()) {

                // Error messages added in response for debugging
                
                $errors = implode(',',$validator->messages()->all());

                throw new Exception($errors, 101);


            } else {

                $model = VodVideo::find($request->video_id);

                $user = User::find($request->user_id);

                $model->publish_status = VIDEO_PUBLISHED;

                $timezone = $user ? $user->timezone : 'Asia/Kolkata';

                $current_date_time = date('Y-m-d H:i:s');

                $converted_current_datetime = convertTimeToUSERzone($current_date_time, $timezone);

                // Check the publish type based on that convert the time to timezone

                $model->publish_time = $converted_current_datetime;

                if ($model->save()) {


                } else {

                    throw new Exception(tr('vod_published_video_failure'));
                    
                }

            }

            $response_array = ['success'=>true , 'message'=>tr('vod_published_video_success')];

            return response()->json($response_array);

        } catch (Exception $e) {

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getcode()];

            return response()->json($response_array);

        }
    }

}