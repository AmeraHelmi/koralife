@extends('admin')
@section('styles')
<style type="text/css" media="all">
	/* fix rtl for demo */
	.chosen-rtl .chosen-drop { left: -9000px; }
</style>
@endsection
@section('content')
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
<br>
<ul class="alerts-list delete">
</ul>
<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
		<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> اضافة اصابه
</a>
<div class="widget-content-white glossed">
		<div class="padded">
				<table id="playersteam" class="table table-striped table-bordered table-hover datatable">
						<thead>
								<tr>
										<th class="col-md-2">المباراه</th>
										<th class="col-md-2">أسم اللعب</th>
										<th class="col-md-2">الاصابه </th>
										<th class="col-md-2">من</th>
										<th class="col-md-2">الى</th>
										<th class="col-md-2">خيارات</th>
								</tr>
						</thead>
						<tbody>
								@foreach ($tableData->getData()->data as $row)
								<tr>
										<td>{{ $row->T1name }}</td>
										<td>{{ $row->P_name }}</td>
										<td>{{ $row->Player_injured_name }}</td>
										<td>{{ $row->Player_injured_from }}</td>
										<td>{{ $row->Player_injured_to }}</td>
										<td>{!!$row->actions !!}</td>
								</tr>
								@endforeach
						</tbody>
				</table>
		</div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> اضافة أصابه</h4>
            </div>
            <form role="form" method="POST" class="addForm" action="{{ url('/player_injured_history/store') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('player_injured_history.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
                    <button type="submit" class="btn btn-primary" id="addNew">موافق واضافة جديد</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editplayersteamModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تعديل</h4>
            </div>
            <form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('/player_injured_history/update') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('player_injured_history.formupdate')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
                </div>
            </form>
        </div>
    </div>
</div>


					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection

	@section('scripts')
		<script>
	$(function(){
			$('#datetime1').combodate();
			$('#datetime2').combodate();
	});
	</script>
		<script type="text/javascript">
			function selectteam(){
			$match_id=$('#match').val();
			$.ajax({
					url: '{{ url('player_injured_history/getteams') }}',
					type: "POST",
					data:{
						match_id:$match_id
					},
					success: function(res){
				   	 $('#showteam').show();
					$('#team_id').html(res);
					},
					error: function(){
					}
				});
		}

		//update
		function selectteam2(){
			$match_id=$('#match2').val();
			$.ajax({
					url: '{{ url('player_injured_history/getteams') }}',
					type: "POST",
					data:{
						match_id:$match_id
					},
					success: function(res){
					 $('#team_id2').html(res);					
					},
					error: function(){
					}
				});
		}



		function selectplayers1(){
		$team_id=$('#team_id').val();
		$.ajax({
				url: '{{ url('player_injured_history/getplayers') }}',
				type: "POST",
				data:{
					team_id:$team_id
				},
				success: function(res){
					 $('#showplayers1').show();
					 $('#player1_id').html(res);
				},
				error: function(){
				}
			});
	}

	//update
	function selectplayers2(){
		$team_id=$('#team_id2').val();
		$.ajax({
				url: '{{ url('player_injured_history/getplayers') }}',
				type: "POST",
				data:{
					team_id:$team_id
				},
				success: function(res){
					 $('#showplayers2').show();
					 $('#player2_id').html(res);
				},
				error: function(){
				}
			});
	}
	


	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		function populateForm(response, frm) {
        var i;
        for (i in response) {
            if (i in frm.elements)
                frm.elements[i].value = response[i];
        }
    }

		$("#submitForm").on('click', function(e){
        $('#addModal').modal('hide');
    });

		$("#addModal form").on('submit', function(e){
				if (!e.isDefaultPrevented())
				{
						var self = $(this);
						$.ajax({
								url: '{!!URL::route('addplayer_injured_history')!!}',
								type: "POST",
								data: self.serialize(),
								success: function(res){
										$('.addForm')[0].reset();
   										$('.alerts-list').append(
					'<li>\
							<div class="alert alert-success alert-dismissable">\
									<i class="icon-check-sign"></i> تم أضافة اصابة لاعب بنجــــــاح!\
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
							</div>\
					</li>');
												oTable.ajax.reload();

										oTable.draw();
								},
								error: function(){
										$('#addModal').modal('hide')
										$('.alerts-list').append(
												'<li>\
														<div class="alert alert-danger alert-dismissable">\
																<i class="icon-remove-sign"></i> <strong>Opps!</strong> حدث خطا.\
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
														</div>\
												</li>');
									}
						});
						e.preventDefault();
				}
		 });


	     /* Edit Form */
	     $(document.body).validator().on('click', '.edit', function() {

	    var self = $(this);
	         self.button('loading');
	         $.ajax({
	             url: "{{ url('player_injured_history') }}" + "/" + self.data('id') + "/edit" ,
	             type: "GET",
	             success: function(res){
	                 self.button('reset');
	                 $data = JSON.parse(res.data);
	                 populateForm($data, document.getElementsByClassName("editForm")[0] );
	                 $('#editplayersteamModal form').attr("data-id", self.data('id') );
	                 $('#editplayersteamModal').modal('show');
						selectteam2();
	             },
	             error: function(){
	                 self.button('reset');
		 		                     $('.alerts-list').append(
                     '<li>\
                         <div class="alert alert-danger alert-dismissable">\
                             <i class="icon-remove-sign"></i> <strong>Opps!</strong>حدث خطأ.\
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                         </div>\
                     </li>');
	             }
	         });
	     });


		 				 /* update Form Submission */
		 		     $("#editplayersteamModal form").validator().on('submit', function(e){
		 		         if (!e.isDefaultPrevented())
		 		         {
		 		             var self = $(this);
		 		             $.ajax({
		 		                 url: "{{ url('player_injured_history') }}" + "/" +  self.attr("data-id"),
		 		                 type: "POST",
		 		                 data: "_method=PUT&" + self.serialize(),
		 		                 success: function(res){
		 		                     $('#editplayersteamModal').modal('hide');
		 		                     $('.alerts-list').append(
     '<li>\
         <div class="alert alert-success alert-dismissable">\
             <i class="icon-check-sign"></i> تم تحديث البيانات بنجـــــاح!\
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
         </div>\
     </li>');
		 							oTable.ajax.reload();

		 		                 },
		 		                 error: function(){
		 		                     $('#editplayersteamModal').modal('hide')
		 				 		                     $('.alerts-list').append(
                     '<li>\
                         <div class="alert alert-danger alert-dismissable">\
                             <i class="icon-remove-sign"></i> <strong>Opps!</strong>حدث خطأ.\
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                         </div>\
                     </li>');
		 		                         oTable.ajax.reload();
		 		                 }
		 		             });
		 		             e.preventDefault();
		 		         }
		 		      });

							oTable = $('#playersteam').DataTable({
								"processing": true,
								"serverSide": true,
								"responsive": true,
								"deferLoading": {{ $tableData->getData()->recordsFiltered }},
								"columns": [
										{data: 'T1name', name: 'T1name'},
										{data: 'P_name', name: 'P_name'},
										{data: 'Player_injured_name', name: 'Player_injured_name'},
										{data: 'Player_injured_from', name: 'Player_injured_from'},
										{data: 'Player_injured_to', name: 'Player_injured_to'},
										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});

	$('#addModal').on('shown.bs.modal', function () {
        $('.addForm')[0].reset();
        $('.chosen-select-it', this).chosen({disable_search_threshold: 10});
        $('.chosen-select-multiple', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
    });
    $('#editplayersteamModal').on('shown.bs.modal', function () {
        $('.chosen-select-it', this).chosen({disable_search_threshold: 10});
        $('.chosen-select-multiple', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
    });
    // $('#groupModal').on('shown.bs.modal', function () {
    //     $('.chosen-select-it', this).chosen({disable_search_threshold: 10});
    //     $('.chosen-select-multiple', this).chosen({disable_search_threshold: 10});
    // });
    $('.group-search').chosen({disable_search_threshold: 10});

});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>

	@endsection
