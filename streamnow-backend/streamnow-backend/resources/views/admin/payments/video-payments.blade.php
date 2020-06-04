@extends('layouts.admin')

@section('title', tr('video_payments'))

@section('content-header',tr('video_payments'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-money"></i> {{tr('video_payments')}}</li>
@endsection

@section('content')

@include('notification.notify')

	<div class="row">
        <div class="col-xs-12">
          <div class="box">          	

          	<div class="box-header label-primary">
                  
                <b style="font-size:18px;">{{tr('video_payments')}}</b>
                <!-- EXPORT OPTION START -->

				@if(count($data) > 0 )
                
	                <ul class="admin-action btn btn-default pull-right" style="margin-right: 60px">
	                 	
						<li class="dropdown">
			                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			                  {{tr('export')}} <span class="caret"></span>
			                </a>
			                <ul class="dropdown-menu">
			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.payperview.export' , ['format' => 'xls'])}}">
			                  			<span class="text-red"><b>{{tr('excel_sheet')}}</b></span>
			                  		</a>
			                  	</li>

			                  	<li role="presentation">
			                  		<a role="menuitem" tabindex="-1" href="{{route('admin.payperview.export' , ['format' => 'csv'])}}">
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

            	@if(count($data) > 0)

	              	<table id="datatable-withoutpagination" class="table table-bordered table-striped">

						<thead>
						    <tr>
						      <th>{{tr('id')}}</th>
						      <th>{{tr('video')}}</th>
						      <th>{{tr('name')}}</th>
						      <th>{{tr('payment_id')}}</th>
						      <th>{{tr('amount')}}</th>
						      <th>{{tr('admin_commission')}}</th>
						      <th>{{tr('user_commission')}}</th>
						      <th>{{tr('payment_mode')}}</th>
						      <th>{{tr('coupon_code')}}</th>
						      <th>{{tr('coupon_amount')}}</th>
						      <th>{{tr('plan_amount')}}</th>
						      <th>{{tr('final_amount')}}</th>
						      <th>{{tr('is_coupon_applied')}}</th>
						      <th>{{tr('coupon_reason')}}</th>
						      <th>{{tr('status')}}</th>
						      <!-- <th>{{tr('expiry_date')}}</th> -->
						    </tr>
						</thead>

						<tbody>

							@foreach($data as $i => $payment)

							    <tr>
							      	<td>{{showEntries($_GET ,$i+1)}}</td>
							      	<td><a href="#">{{$payment->getVideo ? $payment->getVideo->title : ""}}</a></td>
							      	<td>
							      		@if($payment->paiduser)

							      			<a href="{{route('admin.users.view' , $payment->user_id)}}"> {{$payment->paiduser ? $payment->paiduser->name : ""}} </a></td>

							      		@else
							      			-
							      		@endif
							      		
							      	<td>{{$payment->payment_id}}</td>
							      	<td>{{formatted_amount($payment->amount)}}</td>
							      	<td>{{formatted_amount($payment->admin_amount)}}</td>
							      	<td>{{formatted_amount($payment->user_amount)}}</td>
							      	<td class="text-capitalize">{{$payment->payment_mode}}</td>
							      		<td>{{$payment->coupon_code}}</td>

							      	<td>{{formatted_amount($payment->coupon_amount)}}</td>

							      	<td> {{formatted_amount($payment->live_video_amount)}}</td>

							      	<td>{{formatted_amount($payment->amount)}}</td>
							      	
							      	<td>
							      		@if($payment->is_coupon_applied)
										<span class="label label-success">{{tr('yes')}}</span>
										@else
										<span class="label label-danger">{{tr('no')}}</span>
										@endif
							      	</td>
							      	<td>
							      		{{$payment->coupon_reason ? $payment->coupon_reason : '-'}}
							      	</td>
							      	<td class="text-center">

					      			@if($payment->status)
						      			<span class="label label-success">{{tr('paid')}}</span>
						      		@else
						      			<span class="label label-danger">{{tr('not_paid')}}</span>
						      		@endif
						      	</td>
							      	<!-- <td>{{date('d M Y',strtotime($payment->expiry_date))}}</td> -->
							    </tr>					

							@endforeach
						</tbody>
					</table>
					<div align="right" id="paglink"><?php echo $data->links(); ?></div>
				@else
					<h3 class="no-result">{{tr('no_result_found')}}</h3>
				@endif
            </div>
          </div>
    </div>

@endsection


