@extends('layouts.admin')

@section('title', tr('redeems'))


@section('content-header')

	<span style="color:#1d880c !important">{{tr('redeems')}} : </span>  {{$user ? $user->name  : ""}}

@endsection

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.users.index')}}"><i class="fa fa-user"></i> {{tr('users')}}</a></li>
    <li class="active"><i class="fa fa-trophy"></i> {{tr('redeems')}}</li>
@endsection

@section('content')

	@include('notification.notify')

	<div class="row">

        <div class="col-xs-12">

          	<div class="box box-primary">

	          	<div class="box-header label-primary">

	                <b style="font-size:18px;">{{tr('redeems')}}</b>

	                <a href="{{route('admin.users.index')}}" class="btn btn-default pull-right">{{tr('view_users')}}</a>
	            </div>
            	
            	<div class="box-body">

					<table id="datatable-withoutpagination" class="table table-bordered table-striped">

						<thead>
						    <tr>
						      <th>{{tr('id')}}</th>
						      <th>{{tr('username')}}</th>
						      <th>{{tr('redeem_amount')}}</th>
						      <th>{{tr('paid_amount')}}</th>
						      <th>{{tr('sent_date')}}</th>
						      <th>{{tr('payment_mode')}}</th>
						      <th>{{tr('status')}}</th>
						      <th>{{tr('action')}}</th>
						    </tr>
						
						</thead>

						<tbody>

							@foreach($data as $i => $value)

							    <tr>

							      	<td>{{showEntries($_GET, $i+1)}}</td>

							      	<td>

							      		<a href="{{route('admin.users.view' , $value->user_id)}}">
							      			{{$value->user ? $value->user->name : tr('user_not_available')}}
							      		</a>

							      	</td>

							      	<td><b>{{formatted_amount($value->request_amount)}}</b></td>

							      	<td><b>{{formatted_amount($value->paid_amount)}}</b></td>

							      	<td>{{$value->created_at ? $value->created_at->diffForHumans() : ""}}</td>

							      	<td><b>{{$value->payment_mode}}</b></td>

							      	<td><b>{{redeem_request_status($value->status)}}</b></td>
							 
							      	<td>

							      		@if(in_array($value->status ,[REDEEM_REQUEST_SENT , REDEEM_REQUEST_PROCESSING]))

								      		<form action="{{route('admin.payout.invoice')}}" method="POST">

								      			<input type="hidden" name="redeem_request_id" value="{{$value->id}}">

								      			<input type="text" name="paid_amount" value="{{$value->request_amount}}">

								      			<input type="hidden" name="user_id" value="{{$value->user_id}}">

								      			<?php $confirm_message = tr('redeem_pay_confirm'); ?>

								      			<button type="submit" class="btn btn-success btn-sm" onclick='confirm("{{$confirm_message}}")'>{{tr('paynow')}}</button>
								      		</form>

								      	@else
								      		<span>-</span>
							      		@endif

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