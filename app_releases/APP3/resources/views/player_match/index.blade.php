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
		<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> اضافة اللاعبيين الاساسين
</a>
<div class="widget-content-white glossed">
		<div class="padded">
				<table id="playersteam" class="table table-striped table-bordered table-hover datatable">
						<thead>
								<tr>
										<th class="col-md-2">الفريق</th>
										<th class="col-md-2">اللاعب</th>
										<th class="col-md-2">من تاريخ</th>
										<th class="col-md-2">الى تاريخ</th>
										<th class="col-md-2">الخيارات</th>
								</tr>
						</thead>
						<tbody>
								@foreach ($tableData->getData()->data as $row)
								<tr>
										<td>{{ $row->Tname }}</td>
										<td>{{ $row->Pname }}</td>
										<td>{{ $row->from_time }}</td>
										<td>{{ $row->to_time }}</td>
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
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> اضافة اللاعبيين الاساسيين</h4>
            </div>
            <form role="form" method="POST" class="addForm" action="{{ url('/player_match/store') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('player_match.form')
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
            <form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('/player_match/update') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('player_match.formupdate')
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
			//  alert($match_id);
			$.ajax({
					url: '{{ url('player_match/getteams') }}',
					type: "POST",
					data:{
						match_id:$match_id
					},
					success: function(res){
				   	 $('#showteam').show();
							$('#team_id').html(res);
							selectplayers();
					},
					error: function(){
					}
				});
		}

		function selectteam_update(){
		$match_id=$('#match2').val();
		$.ajax({
				url: '{{ url('player_match/getteams') }}',
				type: "POST",
				data:{
					match_id:$match_id
				},
				success: function(res){
					 $('#showteam2').show();
						$('#team_id2').html(res);
						selectplayers();
				},
				error: function(){

				}
			});
	}


		function selectplayers(){
		$team_id=$('#team_id').val();
		$.ajax({
				url: '{{ url('player_match/getplayers') }}',
				type: "POST",
				data:{
					team_id:$team_id
				},
				success: function(res){
					 $('#showplayers').show();
					 $('#showplayers').html(res);
				},
				error: function(){
				}
			});
	}

	function selectplayers_update(){
	$team_id=$('#team_id2').val();
	$.ajax({
			url: '{{ url('player_match/getplayers') }}',
			type: "POST",
			data:{
				team_id:$team_id
			},
			success: function(res){
				 $('#showplayers2').show();
				 $('#showplayers2').html(res);
			},
			error: function(){
			}
		});
}

	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		selectteam_update();
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
								url: '{!!URL::route('addplayer_match')!!}',
								type: "POST",
								data: self.serialize(),
								success: function(res){
										$('.addForm')[0].reset();
										$('.alerts-list').append(
												'<li>\
														<div class="alert alert-success alert-dismissable">\
																<i class="icon-check-sign"></i>تم اضافة لاعب !\
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
																<i class="icon-remove-sign"></i> <strong>Opps!</strong> حدث خطأ ما.\
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
	             url: "{{ url('player_match') }}" + "/" + self.data('id') + "/edit" ,
	             type: "GET",
	             success: function(res){
	                 self.button('reset');
	                 $data = JSON.parse(res.data);
	                 populateForm($data, document.getElementsByClassName("editForm")[0] );
	                 $('#editplayersteamModal form').attr("data-id", self.data('id') );
	                 $('#editplayersteamModal').modal('show');
	             },
	             error: function(){
	                 self.button('reset');
	                 $('.alerts-list').append(
	                     '<li>\
	                         <div class="alert alert-danger alert-dismissable">\
	                             <i class="icon-remove-sign"></i> <strong>Opps!</strong> حدث خطأ ما.\
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
		 		                 url: "{{ url('player_match') }}" + "/" +  self.attr("data-id"),
		 		                 type: "POST",
		 		                 data: "_method=PUT&" + self.serialize(),
		 		                 success: function(res){
		 		                     $('#editplayersteamModal').modal('hide');
		 		                     $('.alerts-list').append(
		 		                         '<li>\
		 		                             <div class="alert alert-success alert-dismissable">\
		 		                                 <i class="icon-check-sign"></i> تم تعديل اللاعب بنجاح!\
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
		 		                                 <i class="icon-remove-sign"></i> <strong>Opps!</strong>حدث خطا ما.\
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
										{data: 'Tname', name: 'Tname'},
										{data: 'Pname', name: 'Pname'},
										{data: 'from_time', name: 'from_time'},
										{data: 'to_time', name: 'to_time'},
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
