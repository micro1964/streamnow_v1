@extends('layouts.admin')

@section('title', tr('videos'))

@section('content-header')


@if(isset($subscription)) {{$subscription->title}} - @endif 

{{ tr('videos') }} 

 
@endsection

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-video-camera"></i> {{tr('videos')}}</li>
@endsection

@section('content')

	@include('notification.notify')

	<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">

          	<div class="box-header label-primary">
                <b>{{tr('videos')}}</b>

                <!-- EXPORT OPTION START -->

				@if(count($data) > 0 )
                
	                <ul class="admin-action btn btn-default pull-right" style="margin-right: 20px">
	                 	
						<li class="dropdown">
			                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			                  {{tr('export')}} <span class="caret"></span>
			                </a>
			                <ul class="dropdown-menu">
			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.livevideos.export' , ['format' => 'xls'])}}">
			                  			<span class="text-red"><b>{{tr('excel_sheet')}}</b></span>
			                  		</a>
			                  	</li>

			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.livevideos.export' , ['format' => 'csv'])}}">
			                  			<span class="text-blue"><b>{{tr('csv')}}</b></span>
			                  		</a>
			                  	</li>
			                </ul>
						</li>
					</ul>

				@endif

                <!-- EXPORT OPTION END -->
            </div>
            
            <div class="box-body table-responsive">

              	<table id="datatable-withoutpagination" class="table table-bordered table-striped">

					<thead>					    
						<tr>
					      	<th>{{tr('id')}}</th>
					      	<th>{{tr('name')}}</th>
					      	<th>{{tr('title')}}</th>
					      	<th>{{tr('video_type')}}</th>
					      	<th>{{tr('payment')}}</th>
					      	<th>{{tr('streaming_status')}}</th>
					      	<th>{{tr('streamed_at')}}</th>
					      	<th>{{tr('viewer_count')}}</th>
					      	<th>{{tr('action')}}</th>
					    </tr>
					</thead>

					<tbody>

						@foreach($data as $i => $video)

						    <tr>
						      	<td>{{showEntries($_GET, $i+1)}}</td>

						      	<td>
						      		<a href="{{$video->user ? route('admin.users.view' , $video->user_id) : '#'}}"> {{$video->user ? $video->user->name : tr('user_not_available')}}</a>
						      	</td>

						      	<td>{{$video->title}}</td>

						      	<td>
						      			
						      		@if($video->type == TYPE_PUBLIC)

						      			<label class="label label-primary">{{TYPE_PUBLIC}}</label>

						      		@else
						      			<label class="label label-danger">{{TYPE_PRIVATE}}</label>
						      		@endif

						      	</td>

						      	<td>
						      			
						      		@if($video->payment_status)

						      			<label class="label label-warning">{{tr('payment')}}</label>

						      		@else
						      			<label class="label label-success">{{tr('free')}}</label>
						      		@endif

						      	</td>

						      	<td>
						      		@if($video->is_streaming)

                                        @if(!$video->status)

                                        <label class="label label-danger"><b>{{tr('video_call_started')}}</b></label>

                                        @else

                                            <label class="label label-danger"><b>{{tr('video_call_ended')}}</b></label>

                                        @endif

                                    @else

                                        <label class="label label-primary"><b>{{tr('video_call_initiated')}}</b></label>

                                    @endif
						      	</td>

						      	<td>{{common_date($video->created_at, Auth::guard('admin')->user()->timezone)}}</td>

						      	<td>{{$video->viewer_cnt}}</td>

						      	<td><a href="{{route('admin.videos.view' , $video->id)}}" class="btn btn-success"><b>{{tr('view')}}</b></a></td>
						      	
						      	@if(Setting::get('delete_video'))
						      	<td>
						      		<a onclick="return confirm('Are you sure ?');" href="{{route('admin.videos.delete' , $video->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;{{tr('delete')}}</a>
						      	</td>
						      	@endif

						    </tr>
						@endforeach
						
					</tbody>
				
				</table>

				<div align="right" id="paglink"><?php echo $data->links(); ?></div>
				
            </div>
          </div>
        </div>
    </div>

@endsection