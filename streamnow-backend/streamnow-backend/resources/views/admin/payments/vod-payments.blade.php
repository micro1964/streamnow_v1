@extends('layouts.admin')

@section('title',tr('vod_payments'))

@section('content-header',tr('vod_payments'))

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
	<li class="active"><i class="fa fa-credit-card"></i>{{tr('vod_payments')}}</li>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box box-primary">
          			<div class="box-header label-primary">
                  

					<!-- EXPORT OPTION START -->

						@if(count($vod_payments) > 0 )
		                
			                <ul class="admin-action btn btn-default pull-right" style="margin-right: 30px">
			                 	
								<li class="dropdown">
					                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
					                  {{tr('export')}} <span class="caret"></span>
					                </a>
					                <ul class="dropdown-menu">
					                  	<li role="presentation">
					                  		<a role="menuitem" tabindex="-1" href="{{route('admin.vod-payments.export' , ['format' => 'xls'])}}">
					                  			<span class="text-red"><b>{{tr('excel_sheet')}}</b></span>
					                  		</a>
					                  	</li>

					                  	<li role="presentation">
					                  		<a role="menuitem" tabindex="-1" href="{{route('admin.vod-payments.export' , ['format' => 'csv'])}}">
					                  			<span class="text-blue"><b>{{tr('csv')}}</b></span>
					                  		</a>
					                  	</li>
					                </ul>
								</li>
							</ul>

						@endif
					</div>
			                <!-- EXPORT OPTION END -->

					<div class="box-body table-responsive">
					    @if(count($vod_payments)>0)

							<table id="datatable-withoutpagination" class="table table-bordered table-striped ">
								<thead>
									<tr>
										<th>{{tr('id')}}</th>
										<th>{{tr('title')}}</th>
										<th>{{tr('user_name')}}</th>
										<th>{{tr('payment_id')}}</th>
										<th>{{tr('amount')}}</th>
										<th>{{tr('admin_commission')}}</th>
										<th>{{tr(('user_commission'))}}</th>
										<th>{{tr(('payment_mode'))}}</th>
										<th>{{tr('coupon_code')}}</th>
								      	<th>{{tr('coupon_amount')}}</th>
								      	<th>{{tr('plan_amount')}}</th>
								      	<th>{{tr('final_amount')}}</th>
								      	<th>{{tr('is_coupon_applied')}}</th>
								      	<th>{{tr('coupon_reason')}}</th>
										<th>{{tr('status')}}</th>
									</tr>
								</thead>

								<tbody>
									@foreach($vod_payments as $i=>$value)
										<tr>
											<td>{{showEntries($_GET , $i+1)}}</td>

											<td><a href="{{route('admin.vod-videos.view',$value->video_id)}}">{{$value->vodVideo ? $value->vodVideo->title : "-" }}</a></td>

											<td><a href="{{route('admin.users.view' , $value->user_id)}}">{{$value->userVideos ? $value->userVideos->name : "-" }}</a></td>

											<td>{{$value->payment_id}}</td>

											<td>{{formatted_amount($value->amount)}}</td>

											<td>{{formatted_amount($value->admin_amount)}}</td>

											<td>{{formatted_amount($value->user_amount)}}</td>
											<td class="text-capitalize">{{$value->payment_mode}}</td>
											<td>{{$value->coupon_code}}</td>

								      	<td> {{formatted_amount($value->coupon_amount)}}</td>

								      	<td>{{formatted_amount($value->subscription_amount)}}</td>

								      	<td>{{formatted_amount($value->amount)}}</td>
								      	
								      	<td>
								      		@if($value->is_coupon_applied)
											<span class="label label-success">{{tr('yes')}}</span>
											@else
											<span class="label label-danger">{{tr('no')}}</span>
											@endif
								      	</td>
								      	<td>
								      		{{$value->coupon_reason ? $value->coupon_reason : '-'}}
								      	</td>
											<td>
												@if($value->amount > 0)
													<span class="label label-success">{{tr('paid')}}</span>
												@else
													<span class="label label-danger">{{tr('not_paid')}}</span>
												@endif
											</td>
									@endforeach
								</tbody>

							</table>
							<div align="right" id="paglink"><?php echo $vod_payments->links(); ?></div>
						@else
						<h3 class="no-result">{{tr('no_result_found')}}</h3>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection