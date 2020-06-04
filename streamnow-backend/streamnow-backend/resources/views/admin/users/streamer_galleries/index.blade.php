@extends('layouts.admin')

@section('title', tr('galleries'))

@section('content-header', tr('galleries'))

@section('breadcrumb')
  
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.users.index')}}">< <i class="fa fa-user"></i> {{tr('users')}}</a></li>
    <li><a href="{{route('admin.users.view', $user->id)}}">< <i class="fa fa-user"></i> {{tr('view')}}</a></li>
    <li class="active"><i class="fa fa-picture"></i> {{tr('galleries')}}</a></li>
@endsection

@section('styles')

<style type="text/css">




.gallery figure img {
  width: 100%;
  border-radius: 10px;
  -webkit-transition: all .3s ease-in-out;
  transition: all .3s ease-in-out;
  height: 200px;
}

.gallery figure a {
  position: absolute;
  top:0%;
  right:0%;
  background-color: #000;
  opacity: 0.7;
  padding: 7px 10px;
  border-radius: 50%;
  color: #fff;
}
</style>
@endsection

@section('content')

<div class="row">

  <div class="col-lg-12">

    @include('notification.notify')

    <a href="{{route('admin.streamer_galleries.upload',['user_id'=>$user->id])}}" class="btn btn-success pull-right">Add Photo</a>
    <div class="clearfix"></div>
    <br>


    <div class="gallery">

      @if (count($data) > 0 )
      @foreach($data as $gallery)

      <?php $delete_msg = tr('sure_want_to_delete');?>
      <figure class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
        <img src="{{$gallery->image}}" alt=""/>
        <a href="{{route('admin.streamer_galleries.delete', ['gallery_id'=>$gallery->gallery_id, 'user_id'=>$user->id])}}" onclick="return confirm('{{$delete_msg}}')" title="Remove Photo"><i class="fa fa-times"></i></a>
      </figure>
      @endforeach

      <div class="clearfix"></div>

      <div class="text-center">{{$data->links()}}</div>
      @else

        <div class="col-lg-12 text-center"><p>No photos available in gallery</p></div>

      @endif
    </div>

  </div>

</div>
@endsection


