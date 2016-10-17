@extends('admin')
@section('content')
<div class="content-wrapper">
		<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<br>
								<ul class="alerts-list delete"></ul>
								<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
										<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> أضافة نادى فى المجموعه
								</a>
								<div class="widget-content-white glossed">
										<div class="padded">
												<table id="cities" class="table table-striped table-bordered table-hover datatable">
															<thead>
																		<tr>
																				<th class="col-md-2">الفريق</th>
																				<th class="col-md-3">البطوله</th>
																				<th class="col-md-2">خيارات</th>
																			</tr>
																</thead>
																<tbody>
																		@foreach ($tableData->getData()->data as $row)
																		<tr>
																				<td>{{ $row->team_name }}</td>
																				<td>{{ $row->Championship }}</td>
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
                										<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> أضافه نادى</h4>
            										</div>
            										<form role="form" method="POST" class="addForm" action="{{ url('/team_group/store') }}" data-toggle="validator">
                											<div class="modal-body">
                    											@include('team_group.form')
                											</div>
                											<div class="modal-footer">
                    												<button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
                    												<button type="submit" class="btn btn-primary" id="addNew">موافق وأضافة جديد</button>
																			</div>
																</form>
        										</div>
												</div>
										</div>
										<div class="modal fade" id="editcityModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    										<div class="modal-dialog">
        										<div class="modal-content">
            										<div class="modal-header">
                										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                										<h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تحديث</h4>
            										</div>
            										<form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('team_group/update') }}" data-toggle="validator">
                											<div class="modal-body">
                    												@include('team_group.form')
                											</div>
                											<div class="modal-footer">
                    												<button type="submit" id="submit" class="btn btn-primary">تحديث</button>
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
<script type="text/javascript">
	function select_team(){
	$team_type=$('#team_type').val();
  if($team_type === 'منتخب'){
		$('.nations').show();
		$('.teams').hide();
	}
	else{
			$('.teams').show();
    	$('.nations').hide();
		}
}

function select_type(){
$champ_type=$('#champ_type').val();
if($champ_type === 'كأس'){
	$('#group').show();
	$('#role').show();
}
else{
	$('#group').hide();
	$('#role').hide();
	}
}

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
								url: '{!!URL::route('addteam_group')!!}',
								type: "POST",
								data: self.serialize(),
								success: function(res){
										$('.addForm')[0].reset();
										$('.alerts-list').append(
												'<li>\
														<div class="alert alert-success alert-dismissable">\
																<i class="icon-check-sign"></i> تم أضافة مجموعه بنجـــــاح!\
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
																<i class="icon-remove-sign"></i> <strong>Opps!</strong> حدث خطأ.\
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
	             url: "{{ url('team_group') }}" + "/" + self.data('id') + "/edit" ,
	             type: "GET",
	             success: function(res){
	                 self.button('reset');
	                 $data = JSON.parse(res.data);
	                 populateForm($data, document.getElementsByClassName("editForm")[0] );
	                 $('#editcityModal form').attr("data-id", self.data('id') );
	                 $('#editcityModal').modal('show');
	             },
	             error: function(){
	                 self.button('reset');
	                 $('.alerts-list').append(
	                     '<li>\
	                         <div class="alert alert-danger alert-dismissable">\
	                             <i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
	                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
	                         </div>\
	                     </li>');
	             }
	         });
	     });


		 				 /* update Form Submission */
		 		     $("#editcityModal form").validator().on('submit', function(e){
		 		         if (!e.isDefaultPrevented())
		 		         {
		 		             var self = $(this);
		 		             $.ajax({
		 		                 url: "{{ url('team_group') }}" + "/" +  self.attr("data-id"),
		 		                 type: "POST",
		 		                 data: "_method=PUT&" + self.serialize(),
		 		                 success: function(res){
		 		                     $('#editcityModal').modal('hide');
		 		                     $('.alerts-list').append(
		 		                         '<li>\
		 		                             <div class="alert alert-success alert-dismissable">\
		 		                                 <i class="icon-check-sign"></i>تم تحديث البيانات بنجــــاح!\
		 		                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
		 		                             </div>\
		 		                         </li>');
		 														 oTable.ajax.reload();

		 		                 },
		 		                 error: function(){
		 		                     $('#editcityModal').modal('hide')
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

							oTable = $('#cities').DataTable({
								"processing": true,
								"serverSide": true,
								"responsive": true,
								"deferLoading": {{ $tableData->getData()->recordsFiltered }},
								"columns": [
										{data: 'team_name', name: 'team_name'},
										{data: 'Championship', name: 'Championship'},
										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});
							$('#addModal').on('shown.bs.modal', function () {
										$('.addForm')[0].reset();
										$('.chosen-select-it', this).chosen({disable_search_threshold: 10});
										$('.chosen-select-multiple', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
								});


								$('.group-search').chosen({disable_search_threshold: 10});
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>

	@endsection
