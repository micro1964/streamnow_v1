@extends('layouts.admin')

@section('title', tr('videos'))

@section('content-header',tr('videos'))

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

                <a href="{{route('admin.vod-videos.create')}}" style="float:right" class="btn btn-default">{{tr('upload_video')}}</a>

                <!-- EXPORT OPTION START -->

				@if(count($video_list) > 0 )
                
	                <ul class="admin-action btn btn-default pull-right" style="margin-right: 20px">
	                 	
						<li class="dropdown">
			                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			                  {{tr('export')}} <span class="caret"></span>
			                </a>
			                <ul class="dropdown-menu">
			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.vod-videos.export' , ['format' => 'xls'])}}">
			                  			<span class="text-red"><b>{{tr('excel_sheet')}}</b></span>
			                  		</a>
			                  	</li>

			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.vod-videos.export' , ['format' => 'csv'])}}">
			                  			<span class="text-blue"><b>{{tr('csv')}}</b></span>
			                  		</a>
			                  	</li>
			                </ul>
						</li>
					</ul>

				@endif
			</div>
				<!-- EXPORT OPTION END -->
            
            <div class="box-body">
            	<div class="table table-responsive">
              	<table id="datatable-withoutpagination" class="table table-bordered table-striped text-nowrap">

					<thead>					    
						<tr>
					      	<th>{{tr('id')}}</th>
					      	<th>{{tr('title')}}</th>
					      	<th>{{tr('ppv')}}</th>
					      	<th>{{tr('total')}} ({{Setting::get('currency')}})</th>
					      	<th>{{tr('admin')}} ({{Setting::get('currency')}})</th>
					      	<th>{{tr('user')}} ({{Setting::get('currency')}})</th>
					      	<th>{{tr('uploaded_by')}}</th>
 							<th>{{tr('user_status')}}</th>
					      	<th>{{tr('admin_status')}}</th>
					      	<th>{{tr('action')}}</th>
					    </tr>
					</thead>

					<tbody>

						@foreach($video_list as $i => $video)

						    <tr>
						      	<td>{{showEntries($_GET, $i+1)}}</td>

						      	<td><a href="{{route('admin.vod-videos.view',$video->vod_id)}}">{{$video->title}}</a></td>

						      	<td>
						      			
						      		@if($video->amount != 0)

						      			<span class="label label-success">{{tr('yes')}} -{{formatted_amount($video->amount)}}</span>

						      		@else
						      			<span class="label label-danger">{{tr('no')}}</span>
						      		@endif

						      	</td>

						      

						      	<td>
									{{formatted_amount($video->admin_amount+$video->user_amount)}}
						      	</td>

						      	<td>
						      		{{formatted_amount($video->admin_amount)}}
						      	</td>

						      	<td>
						      		{{formatted_amount($video->user_amount)}}
						      	</td>

						      	

						      	<td class="text-capitalize">
						      		{{$video->created_by ? $video->created_by : 'User'}}
						      	</td>

						      	<td>
						      		@if($video->status)

						      			<span class="label label-success">{{tr('approve')}}</span>

							      	@else

							      		<span class="label label-warning">{{tr('pending')}}</span>

						      		@endif
						      	</td>


						      	<td>
						      		@if($video->admin_status)

						      			<span class="label label-success">{{tr('approve')}}</span>

							      	@else

							      		<span class="label label-warning">{{tr('pending')}}</span>

						      		@endif
						      	</td>

						      	
								<td>	
									<div class="dropdown  {{$i <= 2 ? 'dropdown' : 'dropup'}}">
										
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{tr('action')}}
											<span class="caret"></span>
										</button>

										<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
											<li>
												@if(Setting::get('admin_delete_control'))
													<a href="javascript:;" class="btn disabled" style="text-align: left;"><b>&nbsp;{{tr('edit')}}</b></a>
												@else
													<a href="{{route('admin.vod-videos.edit',['id'=>$video->vod_id])}}"><b>&nbsp;{{tr('edit')}}</b></a>
												@endif
											</li>

											<li>
													
												<a href="{{route('admin.vod-videos.view',$video->vod_id)}}"><b>&nbsp;{{tr('view')}}</b></a>

											</li>

											<li>
								                <a href="" role="menuitem" tabindex="-1" data-toggle="modal" data-target="#{{$video->vod_id}}"><b>&nbsp;{{tr('pay_per_view')}}</b></a>
								            </li>


											<li>
												@if($video->admin_status)

													<a href="{{route('admin.vod-videos.status',['video_id'=>$video->vod_id, 'user_id'=>$video->user_id])}}"><b>&nbsp;{{tr('decline')}}</b></a>
												@else

													<a href="{{route('admin.vod-videos.status',['video_id'=>$video->vod_id,'user_id'=>$video->user_id])}}"><b>&nbsp;{{tr('approve')}}</b></a>
												@endif
											</li>

											@if(!$video->publish_status)

											<li>

												<a href="{{route('admin.vod-videos.publish',['video_id'=>$video->vod_id,'user_id'=>$video->user_id])}}"><b>&nbsp;{{tr('publish')}}</b></a>

											</li>

											@endif

											<li>

												@if(Setting::get('admin_delete_control'))

								                  	<a href="javascript:;" class="btn disabled" style="text-align: left">
								                  		<b>&nbsp;{{tr('delete')}}</b></a>
								                  	</a>

								                @else
								                	<a class="menuitem" tabindex="-1" href="{{route('admin.vod-videos.delete',['video_id'=>$video->vod_id, 'user_id'=>$video->user_id])}}" onclick="return confirm('Are You Sure?')"><b>&nbsp;{{tr('delete')}}</b></a>
						                  		@endif

											</li>
										</ul>

									</div>

								</td>
						    </tr>

						    <!-- Modal -->
							<div id="{{$video->vod_id}}" class="modal fade" role="dialog">
								  <div class="modal-dialog">
								  <form action="{{route('admin.vod-videos.ppv.create')}}" method="POST">
									    <!-- Modal content-->
									   	<div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal">&times;</button>
									        <h4 class="modal-title">{{tr('ppv')}}</h4>
									      </div>
									      <div class="modal-body">
									        <div class="row">

									        	<input type="hidden" name="ppv_created_by" id="ppv_created_by" value="{{Auth::guard('admin')->user()->name}}">
								            </div>
								            <br>
								            <input type="hidden" name="video_id" value="{{$video->vod_id}}">
								           	
								           	<input type="hidden" name="user_id" value="{{$video->user_id}}">

								            <div class="row">
									        	<div class="col-lg-3">
									        		<label>{{tr('type_of_subscription')}}</label>
									        	</div>
								                <div class="col-lg-9">
								                  <div>
								                        <input type="radio" name="type_of_subscription" value="{{ONE_TIME_PAYMENT}}" id="one_time_payment"@if($video->type_of_subscription == ONE_TIME_PAYMENT || $video->type_of_subscription == 0) checked @endif>&nbsp;<label>
								                        {{tr('one_time_payment')}}</label>&nbsp;
								                        <input type="radio" name="type_of_subscription" value="{{RECURRING_PAYMENT}}" id="recurring_payment" @if($video->type_of_subscription == RECURRING_PAYMENT) checked @endif>&nbsp;<label>{{tr('recurring_payment')}}</label>
								                  </div>
								                </div>
								            </div>

								            <input type="hidden" name="type_of_user" value="{{BOTH_USERS}}">

								            <?php /*<div class="row">
									        	<div class="col-lg-3">
									        		<label>{{tr('type_of_user')}}</label>
									        	</div>
								                <div class="col-lg-9">
								                  <div class="input-group">
								                        <input type="radio" name="type_of_user" value="{{NORMAL_USER}}" checked @if($video->type_of_user == NORMAL_USER || $video->type_of_user == 0) checked @endif>&nbsp;<label>
								                        {{tr('normal_users')}}</label>&nbsp;
								                         <input type="radio" name="type_of_user" value="{{PAID_USER}}" @if($video->type_of_user == PAID_USER) checked @endif>&nbsp;<label>
								                        {{tr('paid_users')}}</label>&nbsp;
								                         <input type="radio" name="type_of_user" value="{{BOTH_USERS}}" @if($video->type_of_user == BOTH_USERS) checked @endif>&nbsp;<label>
								                        {{tr('all_users')}}</label>&nbsp;
								                  </div>
								                </div>
								            </div>
								            <br> */?>
								            <div class="row">
									        	<div class="col-lg-3">
									        		<label>{{tr('amount')}}</label>
									        	</div>
								                <div class="col-lg-9">
								                       <input type="number" required value="{{$video->amount}}" name="amount" class="form-control" id="amount" placeholder="{{tr('amount')}}" step="any">
								                  <!-- /input-group -->
								                </div>
								            </div>
								          	</div>

									      	<div class="modal-footer">

									      	<div class="pull-left">

									      		@if($video->amount > 0)

									       			<a class="btn btn-danger" href="{{route('admin.vod-videos.ppv.delete',['video_id'=>$video->vod_id, 'user_id'=>$video->user_id])}}">{{tr('remove_pay_per_view')}}</a>

									       		@endif
									       	</div>
									        <div class="pull-right">
										        <button type="button" class="btn btn-default" data-dismiss="modal">{{tr('close')}}</button>
										        <button type="submit" class="btn btn-primary">{{tr('submit')}}</button>
										    </div>
										    <div class="clearfix"></div>
									      </div>
									    </div>
									</form>
								  </div>
								</div>
						@endforeach
						
					</tbody>
				
				</table>

				<div align="right" id="paglink"><?php echo $video_list->links(); ?></div>
				
			</div>
            </div>
          </div>
        </div>
    </div>

@endsection