  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{Auth::guard('admin')->user()->picture ? Auth::guard('admin')->user()->picture : asset('placeholder.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::guard('admin')->user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{Auth::guard('admin')->user()->email}}</a>
        </div>

        <div class="clearfix"></div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li id="dashboard">
          <a href="{{route('admin.dashboard')}}">
            <i class="fa fa-dashboard"></i> <span id="tour-one">{{tr('dashboard')}}</span>
          </a>
        </li>

        <li class="treeview" id="users">

                <a href="#">
                    <i class="fa fa-user"></i> <span>{{tr('users')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li id="add-user">
                        <a href="{{route('admin.users.create')}}"><i class="fa fa-circle-o">
                        </i>{{tr('add_user')}}</a>
                    </li>

                    <li id="view-user"><a href="{{route('admin.users.index')}}"><i class="fa fa-circle-o"></i>{{tr('view_users')}}</a></li>
                </ul>
    
        </li>

        <li id="live_groups">
                <a href="{{route('admin.live_groups.index')}}">
                    <i class="fa fa-group"></i> <span>{{tr('live_groups')}}</span> 
                </a>
            </li>

        <li class="treeview" id="live_videos">

                <a href="#">
                    <i class="fa fa-wifi"></i> <span>{{tr('videos')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <li id="live_videos_idx"><a href="{{route('admin.videos.index')}}"><i class="fa fa-circle-o"></i>{{tr('live_videos')}}</a></li>
                    <li id="list_videos"><a href="{{route('admin.videos.videos_list')}}"><i class="fa fa-circle-o"></i>{{tr('videos_list')}}</a></li>
                </ul>
          </li>
       
        
          <li class="treeview" id="videos">

                <a href="#">
                    <i class="fa fa-video-camera"></i> <span>{{tr('vod_videos')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li id="upload_video"><a href="{{route('admin.vod-videos.create')}}"><i class="fa fa-circle-o"></i>{{tr('upload_video')}}</a></li>
                    <li id="view_videos"><a href="{{route('admin.vod-videos.index')}}"><i class="fa fa-circle-o"></i>{{tr('view_videos')}}</a></li>
                </ul>
          </li>


          <li class="treeview" id="custom_live_videos">
                <a href="{{route('admin.custom.live')}}">
                    <i class="fa fa-wifi"></i> <span>{{tr('custom_live_videos')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <li id="create_live_video">
                        <a href="{{route('admin.custom.live.create')}}">
                            <i class="fa fa-circle-o"></i>{{tr('create_custom_live_video')}}
                        </a>
                    </li>

                    <li id="custom_live_videos_index">
                        <a href="{{route('admin.custom.live')}}">
                            <i class="fa fa-circle-o"></i>{{tr('custom_live_videos')}}
                        </a>
                    </li>
                </ul>

            </li> 
       
         <li class="treeview" id="subscriptions">

                <a href="#">
                    <i class="fa fa-key"></i> <span>{{tr('subscriptions')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <li id="subscriptions-add"><a href="{{route('admin.subscriptions.create')}}"><i class="fa fa-circle-o"></i>{{tr('add_subscription')}}</a></li>
                    <li id="view-subscription"><a href="{{route('admin.subscriptions.index')}}"><i class="fa fa-circle-o"></i>{{tr('view_subscriptions')}}</a></li>
                     <li id="automatic"><a href="{{route('admin.automatic.subscribers')}}"><i class="fa fa-circle-o"></i>{{tr('automatic_subscribers')}}</a></li>
                    <li id="cancelled"><a href="{{route('admin.cancelled.subscribers')}}"><i class="fa fa-circle-o"></i>{{tr('cancelled_subscribers')}}</a></li>
                </ul>
          </li>

          <!-- Coupon Section-->
            <li class="treeview" id="coupons">

                <a href="#">
                    <i class="fa fa-gift"></i><span>{{tr('coupons')}}</span><i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li id="add-coupons"><a href="{{route('admin.add.coupons')}}"><i class="fa fa-circle-o"></i>{{tr('add_coupon')}}</a></li>
                    <li id = "view-coupons"><a href="{{route('admin.coupon.list')}}"><i class="fa fa-circle-o"></i>{{tr('view_coupon')}}</a></li>
                </ul>
            </li>

          <li class="treeview" id="payments">
                <a href="{{route('admin.subscription.payments')}}">
                    <i class="fa fa-money"></i> <span>{{tr('payments')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <li id="revenue_system"><a href="{{route('admin.revenue.system')}}"><i class="fa fa-circle-o"></i>{{tr('revenue_system')}}</a></li>

                    <li id="subscription_payments"><a href="{{route('admin.subscription.payments')}}"><i class="fa fa-circle-o"></i>{{tr('subscription_payments')}}</a></li>

                    <li id="video_payments"><a href="{{route('admin.videos.payments')}}"><i class="fa fa-circle-o"></i>{{tr('video_payments')}}</a></li>

                    <li id="vod-payments"><a href="{{route('admin.vod-videos.payments.list')}}"><i class="fa fa-circle-o"></i>{{tr('vod_payments')}}</a></li>
                </ul>
            </li>

            <li id="redeems">
                <a href="{{route('admin.users.redeems')}}">
                    <i class="fa fa-trophy"></i> <span>{{tr('redeems')}}</span> 
                </a>
            </li>

            @if(Setting::get('is_multilanguage_enabled') == FALSE)
                <li id="languages">
                    <a href="{{route('admin.languages.index')}}">
                        <i class="fa fa-globe"></i> <span>{{tr('languages')}}</span>
                    </a>

                    <ul class="treeview-menu">

                        <li id="languages-create"><a href="{{route('admin.languages.create')}}"><i class="fa fa-circle-o"></i>{{tr('add_language')}}</a></li>

                        <li id="languages-view"><a href="{{route('admin.languages.index')}}"><i class="fa fa-circle-o"></i>{{tr('view_languages')}}</a></li>
                        
                    </ul>
                </li>
            @endif
            
            <li id="settings">
                <a href="{{route('admin.settings')}}">
                    <i class="fa fa-gears"></i> <span>{{tr('settings')}}</span>
                </a>
            </li>

            <li id="help">
                <a href="{{route('admin.help')}}">
                    <i class="fa fa-question-circle"></i> <span>{{tr('help')}}</span>
                </a>
            </li>

            <li class="treeview" id="viewpages">

                <a href="#">
                    <i class="fa fa-picture-o"></i> <span>{{tr('pages')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">

                    <li id="add_page"><a href="{{route('admin.pages.create')}}"><i class="fa fa-circle-o"></i>Add Page</a></li>
                    <li id="view_pages"><a href="{{route('admin.pages.index')}}"><i class="fa fa-circle-o"></i>View Page</a></li>
                </ul>
            </li>

            <li class="treeview" id="templates">

                <a href="#">
                    <i class="fa fa-envelope"></i> <span>{{tr('templates')}}</span> <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu">
                    <li id="notification_template"><a href="{{route('admin.templates.notification_template_index')}}"><i class="fa fa-circle-o"></i>{{tr('notification_templates')}}</a></li>
                </ul>
            </li>


            <li id="profile">
                <a href="{{route('admin.profile')}}">
                    <i class="fa fa-diamond"></i> <span>{{tr('account')}}</span>
                </a>
            </li>

            <li>
                <a href="{{route('admin.logout')}}">
                    <i class="fa fa-sign-out"></i> <span>{{tr('sign_out')}}</span>
                </a>
            </li>
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>