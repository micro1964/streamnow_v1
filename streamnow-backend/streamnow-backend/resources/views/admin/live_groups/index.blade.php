@extends('layouts.admin.layout')

@section('title', tr('live_groups'))

@section('content-header', tr('live_groups'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-group" style="color: green"></i> {{tr('live_groups')}}</li>
@endsection

@section('content')

	@include('notification.notify')

	<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">

          	<div class="box-header label-primary">
                <b>{{tr('live_groups')}}</b>
            </div>
            
            <div class="box-body table-responsive">

              	<table id="example1" class="table table-bordered table-striped">

					<thead>
					    <tr>
					      	<th>{{tr('id')}}</th>
					      	<th>{{tr('username')}}</th>
					      	<th>{{tr('live_group')}}</th>
					      	<th>{{tr('total_members')}}</th>
					      	<!-- <th>{{tr('status')}}</th> -->
					      	<!-- <th>{{tr('action')}}</th> -->
					    </tr>
					</thead>

					<tbody>
					
						@foreach($data as $i => $value)

						    <tr>
						      	<td>{{$i+1}}</td>

						      	<td><a href="{{route('admin.users.view' , $value->owner_id)}}"> {{$value->owner_name}}</a></td>

						      	<td>
						      		<a href="{{route('admin.live_groups.view' , ['live_group_id' => $value->live_group_id])}}">
						      			{{$value->live_group_name}}
						      		</a>
						      	</td>

						      	<td>{{$value->total_members}}</td>
						      
						      	<!-- <td class="text-center">

					      			@if($value->status)
						      			<span class="label label-success">{{tr('approved')}}</span>
						      		@else
						      			<span class="label label-warning">{{tr('pending')}}</span>
						      		@endif

						      	</td> -->

						    </tr>
						@endforeach
					</tbody>
				
				</table>
			
            </div>
          </div>
        </div>
    </div>

@endsection
