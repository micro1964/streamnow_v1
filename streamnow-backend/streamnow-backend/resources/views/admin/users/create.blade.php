@extends('layouts.admin')

@section('title', tr('add_user'))

@section('content-header', tr('add_user'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.users.index')}}"><i class="fa fa-user"></i> {{tr('users')}}</a></li>
    <li class="active">{{tr('add_user')}}</li>
@endsection

@section('content')

@include('notification.notify')

    <div class="row">

        <div class="col-md-10 ">

            <div class="box box-primary">

                <div class="box-header label-primary">
                    <b>{{tr('add_user')}}</b>
                    <a href="{{route('admin.users.index')}}" style="float:right" class="btn btn-default">{{tr('view_users')}}</a>
                </div>

                <form class="form-horizontal" action="{{route('admin.users.save')}}" method="POST" enctype="multipart/form-data" role="form">

                    <input type="hidden" name="login_by" value="manual">
                    <input type="hidden" name="device_type" value="web">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">*{{tr('username')}}</label>

                            <div class="col-sm-10">
                                <input type="text" required pattern = "[a-zA-Z0-9\s\-\.]{2,100}" name="name" class="form-control" id="username" value="{{old('name')}}" placeholder="{{tr('username')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">*{{tr('email')}}</label>
                            <div class="col-sm-10">
                                <input type="email" required class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="{{tr('email')}}">
                            </div>
                        </div>


                         <div class="form-group">
                            <label for="is_content_creator" class="col-sm-2 control-label">{{tr('is_content_creator')}}</label>
                            <div class="col-sm-10">
                               <input type="checkbox" name="is_content_creator" id="is_content_creator" value="{{CREATOR_STATUS}}">&nbsp;{{tr('yes')}}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">*{{tr('password')}}</label>

                            <div class="col-sm-10">
                                <input type="password" required name="password" class="form-control" id="password" placeholder="{{tr('password')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            
                            <label for="confirm-password" class="col-sm-2 control-label">*{{tr('confirm_password')}}</label>

                            <div class="col-sm-10">
                                <input type="password" required name="password_confirmation" class="form-control" id="confirm-password" placeholder="{{tr('confirm_password')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-sm-2 control-label">{{tr('paypal_email')}}</label>

                            <div class="col-sm-10">
                                <input type="email" name="paypal_email" value="{{old('paypal_email')}}" class="form-control" id="paypal_email" placeholder="{{tr('paypal_email')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-sm-2 control-label">{{tr('description')}}</label>

                            <div class="col-sm-10">
                                <textarea type="text" name="description" class="form-control" placeholder="{{tr('description')}}" value="{{old('description')}}"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mobile" class="col-sm-2 control-label">{{tr('picture')}}</label>

                            <div class="col-sm-3">
                                <input type="file" name="picture" id="picture" onchange="loadFile(this, 'picture_preview')" style="width: 200px;" accept="image/png,image/jpeg" />

                                <p class="help-block">{{tr('image_square')}}. {{tr('upload_message')}}</p>
                                <br>
                                <img id="picture_preview" style="width: 150px;height: 150px;display: none;" />
                            </div>
                            <label for="mobile" class="col-sm-2 control-label">{{tr('cover')}}</label>

                            <div class="col-sm-3">
                                <input type="file" name="cover" id="cover" onchange="loadFile(this, 'cover_preview')" style="width: 200px;" accept="image/png,image/jpeg"/>
                                <p class="help-block">{{tr('rectangle_image')}}. {{tr('upload_message')}}</p>
                                <br>
                                <img id="cover_preview" style="width: 150px;height: 150px;display: none;"/>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="" class="btn btn-danger">{{tr('cancel')}}</a>
                        <button type="submit" class="btn btn-success pull-right">{{tr('submit')}}</button>
                    </div>
                </form>
            
            </div>

        </div>

    </div>

@endsection

@section('scripts')

<!-- Add Js files and inline js here -->

<script type="text/javascript">
function loadFile(event, id){
    // alert(event.files[0]);

    $("#"+id).show();

    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById(id);
      // alert(output);
      output.src = reader.result;
      //$("#c4-header-bg-container .hd-banner-image").css("background-image", "url("+this.result+")");
    };
    reader.readAsDataURL(event.files[0]);
}
</script>
@endsection
