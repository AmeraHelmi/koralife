@extends('admin')
@section('content')
<style>
	.table-bordered{width: 50%;margin: auto;}
	#input{width: 54px; display: inline-block;text-align: center;}
	.content-wrapper{padding: 0px;}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td
{
	vertical-align: middle;
	text-align:center;
	width: auto !important;
	color:#337ab7;

}
.control-label{color:#337ab7;}
#finish{color:#337ab7 !important;font-size: 18px;font-weight: bold;}

</style>
<div class="content-wrapper">
	<div class="container-fluid">
<ul class="alerts-list"></ul>
		<div class="row">
			<div class="col-md-12">

        <table class="table table-striped table-bordered table-hover">
         <thead>
             @foreach($match as $matchdetail)
            <tr>
		            <th>{{ $matchdetail->T1name }}</th>
		            <th>{{ $matchdetail->T2name }}</th>
						<th>edit</th>
            </tr>
         </thead>
         <tbody>
           <tr>
             <td><label class="control-label">الاهداف</label><br>
               <input type="text" id="input" value="{{ $matchdetail->team1_goals }}" class="form-control" disabled>
           </td>
               <td><label class="control-label">الاهداف</label><br>
                    <input type="text" id="input" value="{{ $matchdetail->team2_goals }}" class="form-control" disabled>
             </td>
						 <td>
						 		<button type="button" class="btn btn-primary text-capitalize" data-toggle="modal" data-target="#addgoal">add</button>
						 </td>
           </tr>
           <tr>
             <td>
               <label class="control-label">ضربه ركنيه</label><br>
                  <input type="text" id="input" value="{{ $matchdetail->T1corners }}"  class="form-control" disabled>
           </td>

           <td><label class="control-label">ضربه ركنيه</label><br>
               <input type="text" id="input" value="{{ $matchdetail->T2corners }}"  class="form-control" disabled>
         </td>
				 <td>
				 		<button type="button" class="btn btn-primary text-capitalize" data-toggle="modal" data-target="#addcorner" >add</button>
				 </td>
      </tr>
      <tr>
        <td><label class="control-label">تسلل</label><br>
            <input type="text" id="input" value="{{ $matchdetail->T1offsides }}"   class="form-control" disabled>
      </td>
      <td><label class="control-label">تسلل</label><br>
            <input type="text" id="input"  value="{{ $matchdetail->T2offsides }}"  class="form-control" disabled>
    </td>
		<td>
				<button type="button" class="btn btn-primary text-capitalize" data-toggle="modal" data-target="#addoffside" >add</button>
		</td>
 </tr>
 <tr>
   <td><label class="control-label">ضربة جزاء</label><br>
		 <input type="text" id="input" value="{{ $matchdetail->T1penalties }}"   class="form-control" disabled>
 </td>
 <td><label class="control-label">ضربة جزاء</label><br>
    <input type="text" id="input" value="{{ $matchdetail->T2penalties }}"   class="form-control" disabled>
</td>
<td>
		<button type="button" class="btn btn-primary text-capitalize" data-toggle="modal" data-target="#addpenalty" >add</button>
</td>
</tr>
<tr>
  <td><label class="control-label">كروت</label><br>
      <input type="text" id="input" value="{{ $matchdetail->T1cards }}"   class="form-control" disabled>
  </td>
<td><label class="control-label">كروت</label><br>
   <input type="text" id="input" value="{{ $matchdetail->T2cards }}"   class="form-control" disabled>
</td>
<td>
		<button type="button" class="btn btn-primary text-capitalize" data-toggle="modal" data-target="#addcard" >add</button>
</td>
</tr>
<tr>
  <td><label class="control-label">اخطاء</label><br>
     <input type="text" id="input" value="{{ $matchdetail->T1E }}"   class="form-control" disabled>
</td>
<td><label class="control-label">اخطاء</label><br>
  <input type="text" id="input" value="{{ $matchdetail->T2E }}"   class="form-control" disabled>
</td>
<td>
		<button type="button" class="btn btn-primary text-capitalize" data-toggle="modal" data-target="#adderror" >add</button>
</td>
</tr>
<tr>
  <td><label class="control-label">استحواذ</label><br>
  <input type="text" id="input" value="{{ $matchdetail->T1psessions }}%"   class="form-control" disabled>
</td>
<td><label class="control-label">استحواذ</label><br>
  <input type="text" id="input" value="{{ $matchdetail->T2psessions }}%"   class="form-control" disabled>
</td>
<td>
		<button type="button" class="btn btn-primary text-capitalize" data-toggle="modal" data-target="#addPsession" >add</button>
</td>
</tr>
<tr>
<td colspan="3">
<a href="#" id="finish">انهـــــــــاء التعديلات</a>
<form id="save2" role="form" method="POST" class="addForm" action="{{ url('/now/save') }}" data-toggle="validator" style="display:none;">
<input type="hidden" name="T1" value="{{ $matchdetail->T1ID }}"  class="t1">
<input type="hidden" name="T2" value="{{ $matchdetail->T2ID }}"  class="t2">
<input type="hidden" name="match_id" value="{{ $matchdetail->match_id }}"  class="match_id">
	<button type="submit" id="save" class="btn btn-danger"  style="width: 115px;">أنهاء</button>
</form>
</td>
</tr>
</tbody>
</table>


<!-- penalty -->
<div class="modal fade" id="addpenalty" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add penalty</h4>
						</div>
						<form role="form" method="POST" class="addForm" action="{{ url('/now/store') }}" data-toggle="validator">
								<div class="modal-body">
										@include('Editor.form')
								</div>
								<div class="modal-footer">
										<button type="submit" id="submitForm" class="btn btn-primary">Submit</button>

								</div>
						</form>
				</div>
		</div>
</div>
<!--offside-->
<div class="modal fade" id="addoffside" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add offside</h4>
						</div>
						<form role="form" method="POST" class="addForm" action="{{ url('/now/offside') }}" data-toggle="validator">
								<div class="modal-body">
										@include('Editor.offside')
								</div>
								<div class="modal-footer">
										<button type="submit" id="submitFormoffside" class="btn btn-primary">Submit</button>

								</div>
						</form>
				</div>
		</div>
</div>
<!--corner-->
<div class="modal fade" id="addcorner" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add corner</h4>
						</div>
						<form role="form" method="POST" class="addForm" action="{{ url('/now/corner') }}" data-toggle="validator">
								<div class="modal-body">
										@include('Editor.corner')
								</div>
								<div class="modal-footer">
										<button type="submit" id="submitFormcorner" class="btn btn-primary">Submit</button>

								</div>
						</form>
				</div>
		</div>
</div>

<!--Psession-->
<div class="modal fade" id="addPsession" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add Psession</h4>
						</div>
						<form role="form" method="POST" class="addForm" action="{{ url('/now/Psession') }}" data-toggle="validator">
								<div class="modal-body">
										@include('Editor.Psession')
								</div>
								<div class="modal-footer">
										<button type="submit" id="submitFormPsession" class="btn btn-primary">Submit</button>

								</div>
						</form>
				</div>
		</div>
</div>
<!-- error -->
<div class="modal fade" id="adderror" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add error</h4>
						</div>
						<form role="form" method="POST" class="addForm" action="{{ url('/now/error') }}" data-toggle="validator">
								<div class="modal-body">
										@include('Editor.error')
								</div>
								<div class="modal-footer">
										<button type="submit" id="submitFormerror" class="btn btn-primary">Submit</button>

								</div>
						</form>
				</div>
		</div>
</div>
<!-- card -->
<div class="modal fade" id="addcard" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add card</h4>
						</div>
						<form role="form" method="POST" class="addForm" action="{{ url('/now/card') }}" data-toggle="validator">
								<div class="modal-body">
										@include('Editor.card')
								</div>
								<div class="modal-footer">
										<button type="submit" id="submitFormcard" class="btn btn-primary">Submit</button>

								</div>
						</form>
				</div>
		</div>
</div>
<!-- goals -->
<div class="modal fade" id="addgoal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		<div class="modal-dialog">
				<div class="modal-content">
						<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add goal</h4>
						</div>
						<form role="form" method="POST" class="addForm" action="{{ url('/now/goal') }}" data-toggle="validator">
								<div class="modal-body">
										@include('Editor.goal')
								</div>
								<div class="modal-footer">
										<button type="submit" id="submitFormgoal" class="btn btn-primary">Submit</button>

								</div>
						</form>
				</div>
		</div>
</div>
@endforeach

			</div>



	</div>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$('#finish').on("click",function(){
$('#save2').show();
});
	function getplayers(){
	$team_id=$('#team_id').val();
	$.ajax({
			url: '{{ url('now/getplayers') }}',
			type: "POST",
			data:{
				team_id:$team_id
			},
			success: function(res){
					$('#showplayer').show();
					$('#player_id').html(res);
			},
			error: function(){
			}
		});
}

function offside(){
$team_id=$('#teamid').val();
$.ajax({
		url: '{{ url('now/getplayers') }}',
		type: "POST",
		data:{
			team_id:$team_id
		},
		success: function(res){
				$('#showplayer2').show();
				$('#player_id2').html(res);
		},
		error: function(){
		}
	});
}
function corner(){
$team_id=$('#teamid1').val();
$.ajax({
		url: '{{ url('now/getplayers') }}',
		type: "POST",
		data:{
			team_id:$team_id
		},
		success: function(res){
				$('#showplayer3').show();
				$('#player_id3').html(res);
		},
		error: function(){
		}
	});
}
function Psession(){
$team_id=$('#teamid2').val();
$.ajax({
		url: '{{ url('now/getplayers') }}',
		type: "POST",
		data:{
			team_id:$team_id
		},
		success: function(res){
				$('#showplayer4').show();
				$('#player_id4').html(res);
		},
		error: function(){
		}
	});
}
function error(){
$team_id=$('#team_id5').val();
$.ajax({
		url: '{{ url('now/getplayers') }}',
		type: "POST",
		data:{
			team_id:$team_id
		},
		success: function(res){
				$('#showplayer5').show();
				$('#player_id5').html(res);
		},
		error: function(){
		}
	});
}
function card(){
$team_id=$('#team_id6').val();
$.ajax({
		url: '{{ url('now/getplayers') }}',
		type: "POST",
		data:{
			team_id:$team_id
		},
		success: function(res){
				$('#showplayer6').show();
				$('#player_id6').html(res);
		},
		error: function(){
		}
	});
}
function goal(){
$team_id=$('#team_id9').val();
$.ajax({
		url: '{{ url('now/getplayers') }}',
		type: "POST",
		data:{
			team_id:$team_id
		},
		success: function(res){
				$('#showplayer9').show();
				$('#player_id9').html(res);
		},
		error: function(){
		}
	});
}

		$(document).ready(function() {
			$("#submitForm").on('click', function(e){
					$('#addpenalty').modal('hide');
			});
			$("#submitFormoffside").on('click', function(e){
					$('#addoffside').modal('hide');
			});
			$("#submitFormcorner").on('click', function(e){
					$('#addcorner').modal('hide');
			});
			$("#submitFormPsession").on('click', function(e){
					$('#addPsession').modal('hide');
			});
			$("#submitFormerror").on('click', function(e){
					$('#adderror').modal('hide');
			});
			$("#submitFormcard").on('click', function(e){
					$('#addcard').modal('hide');
			});
			$("#submitFormgoal").on('click', function(e){
					$('#addgoal').modal('hide');
			});



			$("#addpenalty form").on('submit', function(e){
					if (!e.isDefaultPrevented())
					{
							var self = $(this);
							$.ajax({
									url: '{{url('/now/store')}}',
									type: "POST",
									data: self.serialize(),
									success: function(res){
											$('.alerts-list').append(
													'<li>\
															<div class="alert alert-success alert-dismissable">\
																	<i class="icon-check-sign"></i> penalty has been successfully added!\
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
															</div>\
													</li>');
													   window.location.reload('1000');
									},
									error: function(){
											$('#addpenalty').modal('hide')
											$('.alerts-list').append(
													'<li>\
															<div class="alert alert-danger alert-dismissable">\
																	<i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
															</div>\
													</li>');
									}
							});
							e.preventDefault();
					}
			 });

			 $("#addoffside form").on('submit', function(e){
 					if (!e.isDefaultPrevented())
 					{
 							var self = $(this);
 							$.ajax({
 									url: '{{url('/now/offside')}}',
 									type: "POST",
 									data: self.serialize(),
 									success: function(res){
 											$('.alerts-list').append(
 													'<li>\
 															<div class="alert alert-success alert-dismissable">\
 																	<i class="icon-check-sign"></i> offside has been successfully added!\
 																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
 															</div>\
 													</li>');
 													   window.location.reload('1000');
 									},
 									error: function(){
 											$('#addoffside').modal('hide')
 											$('.alerts-list').append(
 													'<li>\
 															<div class="alert alert-danger alert-dismissable">\
 																	<i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
 																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
 															</div>\
 													</li>');
 									}
 							});
 							e.preventDefault();
 					}
 			 });


			 $("#addcorner form").on('submit', function(e){
			  					if (!e.isDefaultPrevented())
			  					{
			  							var self = $(this);
			  							$.ajax({
			  									url: '{{url('/now/corner')}}',
			  									type: "POST",
			  									data: self.serialize(),
			  									success: function(res){
			  											$('.alerts-list').append(
			  													'<li>\
			  															<div class="alert alert-success alert-dismissable">\
			  																	<i class="icon-check-sign"></i> corner has been successfully added!\
			  																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
			  															</div>\
			  													</li>');
			  													   window.location.reload('1000');
			  									},
			  									error: function(){
			  											$('#addcorner').modal('hide')
			  											$('.alerts-list').append(
			  													'<li>\
			  															<div class="alert alert-danger alert-dismissable">\
			  																	<i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
			  																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
			  															</div>\
			  													</li>');
			  									}
			  							});
			  							e.preventDefault();
			  					}
			  			 });


							 $("#addPsession form").on('submit', function(e){
										if (!e.isDefaultPrevented())
										{
												var self = $(this);
												$.ajax({
														url: '{{url('/now/Psession')}}',
														type: "POST",
														data: self.serialize(),
														success: function(res){
																$('.alerts-list').append(
																		'<li>\
																				<div class="alert alert-success alert-dismissable">\
																						<i class="icon-check-sign"></i> Psession has been successfully added!\
																						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
																				</div>\
																		</li>');
																			 window.location.reload('1000');
														},
														error: function(){
																$('#addPsession').modal('hide')
																$('.alerts-list').append(
																		'<li>\
																				<div class="alert alert-danger alert-dismissable">\
																						<i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
																						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
																				</div>\
																		</li>');
														}
												});
												e.preventDefault();
										}
								 });

								 			 $("#adderror form").on('submit', function(e){
								  					if (!e.isDefaultPrevented())
								  					{
								  							var self = $(this);
								  							$.ajax({
								  									url: '{{url('/now/error')}}',
								  									type: "POST",
								  									data: self.serialize(),
								  									success: function(res){
								  											$('.alerts-list').append(
								  													'<li>\
								  															<div class="alert alert-success alert-dismissable">\
								  																	<i class="icon-check-sign"></i> error has been successfully added!\
								  																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
								  															</div>\
								  													</li>');
								  													   window.location.reload('1000');
								  									},
								  									error: function(){
								  											$('#adderror').modal('hide')
								  											$('.alerts-list').append(
								  													'<li>\
								  															<div class="alert alert-danger alert-dismissable">\
								  																	<i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
								  																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
								  															</div>\
								  													</li>');
								  									}
								  							});
								  							e.preventDefault();
								  					}
								  			 });
												 $("#addcard  form").on('submit', function(e){
									  					if (!e.isDefaultPrevented())
									  					{
									  							var self = $(this);
									  							$.ajax({
									  									url: '{{url('/now/card')}}',
									  									type: "POST",
									  									data: self.serialize(),
									  									success: function(res){
									  											$('.alerts-list').append(
									  													'<li>\
									  															<div class="alert alert-success alert-dismissable">\
									  																	<i class="icon-check-sign"></i> card has been successfully added!\
									  																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
									  															</div>\
									  													</li>');
									  													   window.location.reload('1000');
									  									},
									  									error: function(){
									  											$('#addcard').modal('hide')
									  											$('.alerts-list').append(
									  													'<li>\
									  															<div class="alert alert-danger alert-dismissable">\
									  																	<i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
									  																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
									  															</div>\
									  													</li>');
									  									}
									  							});
									  							e.preventDefault();
									  					}
									  			 });
													 $("#addgoal  form").on('submit', function(e){
															 if (!e.isDefaultPrevented())
															 {
																	 var self = $(this);
																	 $.ajax({
																			 url: '{!!URL::route('addgoal')!!}',
																			 type: "POST",
																			 data: self.serialize(),
																			 success: function(res){
																					 $('.alerts-list').append(
																							 '<li>\
																									 <div class="alert alert-success alert-dismissable">\
																											 <i class="icon-check-sign"></i> goal has been successfully added!\
																											 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
																									 </div>\
																							 </li>');
																									window.location.reload('1000');
																			 },
																			 error: function(){
																					 $('#addgoal').modal('hide')
																					 $('.alerts-list').append(
																							 '<li>\
																									 <div class="alert alert-danger alert-dismissable">\
																											 <i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
																											 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
																									 </div>\
																							 </li>');
																			 }
																	 });
																	 e.preventDefault();
															 }
														});
 });
 </script>
@endsection
