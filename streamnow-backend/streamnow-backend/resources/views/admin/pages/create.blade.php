@extends('layouts.admin')

@section('title', tr('pages'))

@section('content-header', tr('pages'))

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li class="active"><i class="fa fa-book"></i> {{tr('pages')}}</li>
@endsection

@section('content')

    @include('notification.notify')

  	<div class="row">

	    <div class="col-md-10">

	        <div class="box box-primary">

	            <div class="box-header label-primary">
	                <b>{{tr('add_page')}}</b>
	                <a href="{{route('admin.pages.index')}}" style="float:right" class="btn btn-default">{{tr('pages')}}</a>
	            </div>

	            <form  action="{{route('admin.pages.save')}}" method="POST" enctype="multipart/form-data" role="form">

	                <div class="box-body">

	                	<div class="form-group floating-label">

	                     	<label for="select2">{{tr('page_type')}} * </label>

                            <select id="select2" name="type" class="form-control">

                                <option value="">{{tr('choose')}} {{tr('page_type')}}</option>
                                <option value="about" selected="true">{{tr('about')}}</option>
                                <option value="terms">{{tr('terms')}}</option>
                                <option value="privacy">{{tr('privacy')}}</option>
                                <option value="contact">{{tr('contact')}}</option>
                                <option value="help">{{tr('help')}}</option>
                                <option value="faq">{{tr('faq')}}</option>
                                <option value="others">{{tr('others')}}</option>

                            </select>
                            
                        </div>

	                	<div class="form-group">
	                        <label for="title">{{tr('title')}} * </label>
	                        <input type="text" class="form-control" required name="title" id="title" placeholder="{{tr('enter_title')}}" value="{{ old('title') }}">
	                    </div>

	                    <div class="form-group">
	                        <label for="heading">{{tr('heading')}} * </label>
	                        <input type="text" class="form-control" required name="heading" id="heading" placeholder="{{tr('enter_heading')}}" value="{{ old('heading') }}">
	                    </div>

	                    <div class="form-group">
	                        <label for="description">{{tr('description')}} * </label>

	                        <textarea id="ckeditor" name="description" required class="form-control" placeholder="{{tr('enter_text')}}" value="{{ old('description') }}"></textarea>
	                        
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
    <script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'ckeditor' );
    </script>
@endsection


