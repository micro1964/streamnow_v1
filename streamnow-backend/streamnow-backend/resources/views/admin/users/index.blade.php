@extends('layouts.admin')

@section('title', tr('users'))

@section('content-header')

@if(isset($subscription)) {{$subscription->title}} - @endif {{ tr('users') }} 

@endsection

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-user"></i> {{tr('users')}}</li>
@endsection

@section('content')

	@include('notification.notify')

	<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">

          	<div class="box-header label-primary">
                <b>{{tr('users')}}</b>
                <a href="{{route('admin.users.create')}}" style="float:right" class="btn btn-default">{{tr('add_user')}}</a>

                <!-- EXPORT OPTION START -->

				@if(count($data) > 0 )
                
	                <ul class="admin-action btn btn-default pull-right" style="margin-right: 20px;">
	                 	
						<li class="dropdown">
			                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			                  {{tr('export')}} <span class="caret"></span>
			                </a>
			                <ul class="dropdown-menu">
			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.users.export' , ['format' => 'xls'])}}">
			                  			<span class="text-red"><b>{{tr('excel_sheet')}}</b></span>
			                  		</a>
			                  	</li>

			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.users.export' , ['format' => 'csv'])}}">
			                  			<span class="text-blue"><b>{{tr('csv')}}</b></span>
			                  		</a>
			                  	</li>
			                </ul>
						</li>
					</ul>

				@endif

                <!-- EXPORT OPTION END -->
            </div>
            
            <div class="box-body  table-responsive">

              	<table id="datatable-withoutpagination" class="table table-bordered table-striped">

					<thead>					    
						<tr>
					      	<th>{{tr('id')}}</th>
					      	<th>{{tr('username')}}</th>
					      	<th>{{tr('email')}}</th>
					      	<th>{{tr('verify')}}</th>      	
					      	<th>{{tr('content_creator')}}</th>
					      	<!-- <th>{{tr('blocked_me_by_others')}}</th> -->
					      	<!-- <th>{{tr('user_type')}}</th> -->
					      	<th>{{tr('is_logged')}}</th>
					      	<th>{{tr('clear_login')}}</th>
					      	<th>{{tr('status')}}</th>
					      	<th>{{tr('action')}}</th>
					    </tr>
					</thead>

					<tbody>

						@foreach($data as $i => $user)

						    <tr>
						      	<td>{{showEntries($_GET, $i+1)}}</td>
						      	<td>
						      		<a href="{{route('admin.users.view' , $user->id)}}" target="_blank"> 
						      			{{$user->name}}
						      			
							      			@if($user->user_type)

								      			<span class="text-green pull-right"><i class="fa fa-check-circle"></i></span>

								      		@else

								      			<span class="text-red pull-right"><i class="fa fa-times"></i></span>

								      		@endif

						      		</a>

						      	</td>

						      	<td>{{$user->email}}</td>

						      	<td>
						      			
						      		@if($user->is_verified)

						      			<label class="text-green">{{tr('verified')}}</label>

						      		@else
						      			<a href="{{route('admin.users.verify' , $user->id)}}" class="btn btn-xs btn-danger">{{tr('verify')}}</a>
						      		@endif

						      	</td>

						      	<td class="text-center">
						      		
						      		@if($user->is_content_creator)

						      			<i class="label label-success">{{tr('yes')}}</i>

							      	@else

							      		<i class="label label-danger">{{tr('no')}}</i>

						      		@endif

						      	</td>

						      	<?php /*<td>
						      		<a href="{{route('admin.users.block_list' ,array('blocked_by_others'=>$user->id))}}" class="btn btn-xs btn-warning">

						      			<b>{{count($user->blockedMeByOthers)}} {{tr('users')}}</b>
						      		</a>
						      	</td> 
						     

						      	<td>
						      			
						      		@if($user->user_type)

						      			<label class="btn btn-xs btn-success">{{tr('premium')}}</label>

						      		@else
						      			<label class="btn btn-xs btn-danger">{{tr('normal')}}</label>
						      		@endif
						      	</td>*/?>
						      	
						      	
							<td class="text-center">	

	
							      		@if($user->login_status)

							      			<i class="label label-success">{{tr('yes')}}</i>

								      	@else

								      		<i class="label label-danger">{{tr('no')}}</i>

							      		@endif
						      	</td>

						      	<td class="text-center">
						      		
						      		<a href="{{route('admin.users.clear-login', ['id'=>$user->id])}}"><span class="label label-warning">{{tr('clear')}}</span></a>

						      	</td>
								<td class="text-center">
						      		
						      		@if($user->status)

						      			<span class="label label-success">{{tr('approved')}}</span>

							      	@else

							      		<span class="label label-danger">{{tr('declined')}}</span>

						      		@endif

						      	</td>
								<td>
									<div class="dropdown {{$i <= 2 ? 'dropdown' : 'dropup'}}">
										
										<button class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											{{tr('action')}}
											<span class="caret"></span>
										</button>

										<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
											<li>
												@if(Setting::get('admin_delete_control'))
													<a href="javascript:;" class="btn disabled" style="display: inline-block"><b><i class="fa fa-edit"></i>{{tr('edit')}}</b></a>
												@else
													<a href="{{route('admin.users.edit' , array('id' => $user->id))}}"><b><i class="fa fa-edit"></i>&nbsp;{{tr('edit')}}</b></a>
												@endif
											</li>

											<li>
												<a href="{{route('admin.users.view' , $user->id)}}">		
													<span class="text-green"><b><i class="fa fa-eye"></i>&nbsp;{{tr('view')}}</b></span>
												</a>

											</li>

											<li class="divider" role="presentation"></li>

											@if($user->is_content_creator)

											


											<li>
												<a href="{{route('admin.streamer_galleries.list' ,$user->id)}}">		
													<span class="text-yellow"><b><i class="fa fa-picture-o"></i>&nbsp;{{tr('galleries')}}</b></span>
												</a>

											</li>
					
											<li class="divider" role="presentation"></li>

											@endif

											<?php /*<li>
											<a href="{{route('admin.users.followers' , array('id' => $user->id))}}"><b><i class="fa fa-users"></i>&nbsp;{{tr('followers')}}</b></a>
											</li>

											<li>
											<a href="{{route('admin.users.followings' , array('id' => $user->id))}}"><b><i class="fa fa-users"></i>&nbsp;{{tr('followings')}}</b></a>

											</li> */?>


											<li>
												@if(!$user->status)
													<a onclick="return confirm(&quot;{{$user->name}} - {{tr('user_approve_confirmation')}}&quot;);" href="{{route('admin.users.approve' , array('id' => $user->id))}}"><b><i class="fa fa-check"></i>&nbsp;{{tr('approve')}}</b></a>
												@else

													<a onclick="return confirm(&quot;{{$user->name}} - {{tr('user_decline_confirmation')}}&quot;); " href="{{route('admin.users.approve' , array('id' => $user->id))}}"><b><i class="fa fa-times"></i>&nbsp;{{tr('decline')}}</b></a>
												@endif
											</li>

											<li class="divider" role="presentation"></li>

											<li>
												@if(Setting::get('admin_delete_control'))

								                  	<a href="javascript:;" class="btn disabled" style="text-align: left">
								                  		<span class="text-red"><b><i class="fa fa-close"></i>&nbsp;{{tr('delete')}}</b></span>
								                  	</a>

								                @else
						                  			<a onclick="return confirm(&quot;{{$user->name}} - {{tr('user_delete_confirmation')}}&quot;);" href="{{route('admin.users.delete', array('id' => $user->id))}}">
						                  				<span class="text-red"><b><i class="fa fa-close"></i>&nbsp;{{tr('delete')}}</b></span>
						                  			</a>
						                  		@endif

											</li>

											<?php /*

											@if($user->is_content_creator)

											<li>
												<a href="{{route('admin.subscriptions.plans' , $user->id)}}">		
													<span class="text-green"><b><i class="fa fa-eye"></i>&nbsp;{{tr('subscription_plans')}}</b></span>
												</a>

											</li>
											

											@else

												<li>
													<a href="{{route('admin.become.creator' , ['id'=>$user->id])}}">		
														<span class="text-green"><b><i class="fa fa-eye"></i>&nbsp;{{tr('become_a_creator')}}</b></span>
													</a>

												</li>
											@endif */?>

										</ul>

									</div>

								</td>

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
