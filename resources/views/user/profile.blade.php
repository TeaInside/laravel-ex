@extends('layouts.default')
@section('content')
	
	<div style="padding: 20px 30px; background: rgb(243, 156, 18) none repeat scroll 0% 0%; z-index: 999999; font-size: 16px; font-weight: 600;">
		<a class="pull-right" href="#" data-toggle="tooltip" data-placement="left" title="Never show me this again!" style="color: rgb(255, 255, 255); font-size: 20px;">×</a>
		<a href="#" style="color: rgba(255, 255, 255, 0.9); display: inline-block; margin-right: 10px; text-decoration: none;">
			Invite friends and users and earn on their commission fees!
		</a>
		<a class="btn btn-default btn-sm" href="#" style="margin-top: -5px; border: 0px none; box-shadow: none; color: rgb(243, 156, 18); font-weight: 600; background: rgb(255, 255, 255) none repeat scroll 0% 0%;">
		Let's Do It!
		</a>
	</div>
	
	<section class="content-header">
      <h1>
        {{{ Config::get('config_custom.company_name') }}}
        <small>Version 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fas fa-tachometer-alt" ></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
	
	<section class="content">
	<div class="row">
		<div class="col-12-xs col-sm-12 col-lg-12">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Account Menu</h3>

            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li @if($page == 'dashboard') class="active" @endif>{{ HTML::link('user/profile/dashboard', trans('user_texts.dashboard')) }}</li>
				
				<li @if($page == 'balances') class="active" @endif>{{ HTML::link('user/profile/balances', trans('user_texts.balance')) }}</li>
				<li @if($page == 'deposit' || $page == 'deposits') class="active" @endif>{{ HTML::link('user/profile/deposits', trans('user_texts.deposit')) }}</li>
				<li @if($page == 'withdrawals' || $page=='withdraw') class="active" @endif>{{ HTML::link('user/profile/withdrawals', trans('user_texts.withdrawals')) }}</li>
				<li @if($page == 'orders') class="active" @endif>{{ HTML::link('user/profile/orders', trans('user_texts.orders')) }}</li>
				<li @if($page == 'trade-history') class="active" @endif>{{ HTML::link('user/profile/trade-history', trans('user_texts.trade_history')) }}</li>
				<li @if($page == 'coin-giveaway') class="active" @endif>{{ HTML::link('user/profile/coin-giveaway', trans('user_texts.coin_giveaway')) }}</li>
				<li @if($page == 'viewtranferout' || $page == 'viewtranferin') class="active" @endif>
					<a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
					  Transfers <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					  <li @if($page == 'viewtranferout') class="active" @endif>{{ HTML::link('user/profile/viewtranferout', trans('user_texts.view_transfer_out')) }}</li> 
					  <li class="divider"></li>
					  <li @if($page == 'viewtranferin') class="active" @endif>{{ HTML::link('user/profile/viewtranferin', trans('user_texts.view_transfer_in')) }}</li>
					</ul>
				</li>
				

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Account & Settings</h3>

            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
				<li @if($page == '') class="active" @endif>{{ HTML::link('user/profile', trans('user_texts.profile')) }}</li>
				<li @if($page == 'two-factor-auth') class="active" @endif>{{ HTML::link('user/profile/two-factor-auth', trans('user_texts.security')) }}</li>
				<li @if($page == 'login-history') class="active" @endif>{{ HTML::link(route('login_history'), trans('user_texts.login_history')) }}</li>
				<li @if($page == 'ip-whitelist' || $page == 'ip-whitelist') class="active" @endif>
					<a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
					  {{trans('user_texts.ip_whitelist')}} <span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
					  <li @if($page == 'ip-whitelist' && isset($_GET["p"]) && $_GET["p"] === "login") class="active" @endif>{{ HTML::link(route('whitelist_ip', ["login"]), trans('user_texts.ip_whitelist_login')) }}</li> 
					  <li class="divider"></li>
					  <li @if($page == 'ip-whitelist' && isset($_GET["p"]) && $_GET["p"] === "trade") class="active" @endif>{{ HTML::link(route('whitelist_ip', ["trade"]), trans('user_texts.ip_whitelist_trade')) }}</li>
					  <li class="divider"></li>
					   <li @if($page == 'ip-whitelist' && isset($_GET["p"]) && $_GET["p"] === "withdraw") class="active" @endif>{{ HTML::link(route('whitelist_ip', ["withdraw"]), trans('user_texts.ip_whitelist_withdraw')) }}</li>
					</ul>
				</li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">

            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              <div class="table-responsive2 mailbox-messages">
                
				<div id='profile-content' >
				<!-- Information -->
				@if($page == '')
					@php 
						$need2fa = true; 
						$formId = "registerForm";
						$json2FASession = "[]";
					@endphp
					@include('user.edit_profile')
				@elseif($page == 'two-factor-auth')
					@include('user.formtwofactor')
				@elseif($page == 'balances')
					@include('user.balances')
				@elseif($page == 'deposits')
					@include('user.deposits')
				@elseif($page == 'withdrawals')
					@include('user.withdrawals')
				@elseif($page == 'orders')
					@include('user.orders')
				@elseif($page == 'trade-history')
					@include('user.tradehistory')
				@elseif($page == 'deposit')
					@include('user.deposit')
				@elseif($page == 'withdraw')
					@php 
						$need2fa = true; 
						$formId = "wihtdrawForm";
						$json2FASession = "[]";
					@endphp
					@include('user.withdraw')
				@elseif($page == 'dashboard')
					@include('user.dashboard')
				@elseif($page == 'transfercoin')
					@include('user.transfercoin')
				@elseif($page == 'viewtranferout')
					@include('user.transfers_out')
				@elseif($page == 'viewtranferin')
					@include('user.transfers_in')
				@elseif($page == 'ecoinstraderpoint')
					@include('user.info_points')
				@elseif($page == 'mining-settings')
					@include('user.mining_settings')
				@elseif($page == 'deposits-point')
					@include('user.deposits_point')
				@elseif($page == 'coin-giveaway')
					@include('user.coin_giveaway')
				@elseif($page == 'login-history')
					@include('user.login_history')
				@elseif($page == 'ip-whitelist')
					@include('user.ip_whitelist')
				@elseif($page == 'referred-users')
					@include('user.referred_users')
				@endif
			</div>
			
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border ">
              <div class="">

              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
	  <!-- /.col-12 -->
    </div>
	</section>

@stop