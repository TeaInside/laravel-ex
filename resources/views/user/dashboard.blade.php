<div class="row">
	<div class="col-12-xs col-sm-12 col-lg-12">

		<!-- Edit Profile -->
		<div id="dashboard">
			<h2>{{{ trans('user_texts.dashboard') }}}</h2>
		   
			<div class="panel panel-default panel-charts">
			  <div class="panel-heading"> 
				<span class="glyphicon glyphicon-market-charts"></span> Your Stats 
			  </div>
			  <div class="panel-body">
				<table style="border:1px solid #dddddd;" class="table table-striped">
				  <tbody>
					<tr><td width="50%" align="right">Total Trades</td><td width="50%">{{ HTML::link('user/profile/trade-history', $total_trades) }}</td></tr>
					<tr><td width="50%" align="right">Open Orders</td><td width="50%">{{ HTML::link('user/profile/orders', $total_openordes) }}</td></tr>
					<tr><td width="50%" align="right">Deposits Last 24 Hrs</td><td width="50%">{{ HTML::link('user/profile/deposits', $deposit_twentyfourhours) }}</td></tr>
					<tr><td width="50%" align="right">Withdrawals Last 24 Hrs</td><td width="50%">{{ HTML::link('user/profile/withdrawals', $withdraw_twentyfourhours) }}</td></tr>
					<tr><td width="50%" align="right">Pending Deposits</td><td width="50%">{{ HTML::link('user/profile/deposits', $deposit_pendings) }}</td></tr>
				  </tbody>
				</table>
			  </div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"> 
				  <span class="glyphicon"></span> Your Referrals 
				</div>
				<div class="panel-body">        
					<center><i></i></center>
					<center>
						<button onclick="sm(this);" class="btn btn-primary">{{ trans('user_texts.send_invite_email') }}</button>
					</center>
					<center>
					<form method="post" action="javascript:void(0);" onsubmit="sendinvite();" style="display:none;" id="invite-form">
						<div>
							<label>Email to invite: </label><br/><input id="invite_email" size="50" type="email" name="email_invite" required>
						</div>
						<div >
							<label>Invite Message: </label><br/><textarea id="invite_message" style="width: 531px; height: 256px;" required>{{ trans('user_texts.default_invite_message', ["ref_link" => URL::to('/')."/referral/{$user->username}"]) }}</textarea>
						</div>
						<div style="margin-top:2px;">
							<button class="btn btn-primary" type="submit">{{ trans('user_texts.send') }}</button>
						</div>
					</form>
					</center>
					<h4>Referral Link Code:</h4>
					
					<table style="border:1px solid #dddddd;" class="table ">
					<tbody><tr><td align="center">{{URL::to('/')}}/referral/{{$user->username}}</td></tr>
					</tbody></table>   
					
					<h4>Stats:</h4>
					
					<table style="border:1px solid #dddddd;" class="table ">
					<tbody><tr><td align="center">Total Users Referred {{$total_referred}}</td></tr>
					</tbody></table>   

				   
				</div>
			</div> 
		</div>
	</div> 
</div>
<script type="text/javascript">
	// function sm()
	// {
	// 	bootbox.prompt({
	// 			title: "{{trans("user_texts.send_email_title")}}",
	// 			inputType: "text",
	// 			callback: function (result) {
	// 				if (result !== null) {
	// 					$.ajax({
	// 						type: "POST",
	// 						url: "{!! route('invite_user') !!}",
	// 						data: "_token={!! csrf_token() !!}&data="+encodeURIComponent(JSON.stringify({
	// 							"email": result
	// 						})),
	// 						success: function (res) {
	// 							if (typeof res["alert"] != "undefined") {
	// 								bootbox.alert({ 
	// 								  size: "small",
	// 								  title: "Error",
	// 								  message: res["alert"], 
	// 								  callback: function(){}
	// 								});
	// 							}
	// 							if (typeof res["redirect"] != "undefined") {
	// 								window.location = res["redirect"];
	// 							}
	// 						}
	// 					});
	// 				}
	// 			}
	// 	});
	// }
	function sm(a) {
		a.style.display = "none";
		$("#invite-form")[0].style.display = "";
	}
	function sendinvite() {
		$.ajax({
			url: "{!! route('invite_user') !!}",
			type: "POST",
			data: "data="+encodeURIComponent(JSON.stringify(
					{
						"email": document.getElementById("invite_email").value,
						"msg": document.getElementById("invite_message").value
					}
				))+"&_token={!! urlencode(csrf_token()) !!}",
			success: function (res) {
				if (typeof res["alert"] != "undefined") {
					bootbox.alert({ 
					  size: "small",
					  title: "",
					  message: res["alert"], 
					  callback: function(){}
					});
				}
				if (typeof res["redirect"] != "undefined") {
					window.location = res["redirect"];
				}
			}

		});
	}
</script>