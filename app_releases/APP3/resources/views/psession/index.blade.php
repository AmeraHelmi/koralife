@extends('app')
@section('content')
<div class="content-wrapper">
		<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<br>
								<ul class="alerts-list"></ul>
								<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
									<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> Add Psession
								</a>
								<div class="widget-content-white glossed">
										<div class="padded">
												<table id="psessions" class="table table-striped table-bordered table-hover datatable">
															<thead>
																	<tr>
																			<th class="col-md-4">Team</th>
																			<th class="col-md-3">Match</th>
																			<th class="col-md-2">Time</th>
																			<th class="col-md-2">Percent</th>
																			<th class="col-md-1">Actions</th>
																	</tr>
															</thead>
															<tbody>
																	@foreach ($tableData->getData()->data as $row)
																		<tr>
																				<td>{{ $row->team_id }}</td>
																				<td>{{ $row->match_id }}</td>
																				<td>{{ $row->time }}</td>
																				<td>{{ $row->percent }}</td>
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
                										<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> Add psession</h4>
            										</div>
            										<form role="form" method="POST" class="addForm" action="{{ url('/psession/store') }}" data-toggle="validator">
                											<div class="modal-body">
                    											@include('psession.form')
                											</div>
                											<div class="modal-footer">
                    											<button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
                    											<button type="submit" class="btn btn-primary" id="addNew">Submit and Add New</button>
                											</div>
            										</form>
        									</div>
    								</div>
									</div>
									<div class="modal fade" id="editpsessionModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    									<div class="modal-dialog">
        									<div class="modal-content">
            									<div class="modal-header">
                									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                									<h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> Update</h4>
														  </div>
            									<form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('/psession/update') }}" data-toggle="validator">
                										<div class="modal-body">
                    										@include('psession.form')
                										</div>
                										<div class="modal-footer">
                    											<button type="submit" id="submit" class="btn btn-primary">Update</button>
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
								url: '{!!URL::route('addpsession')!!}',
								type: "POST",
								data: self.serialize(),
								success: function(res){
										$('.addForm')[0].reset();
										$('.alerts-list').append(
												'<li>\
														<div class="alert alert-success alert-dismissable">\
																<i class="icon-check-sign"></i> psession has been successfully added!\
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
																<i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
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
	             url: "{{ url('psession') }}" + "/" + self.data('id') + "/edit" ,
	             type: "GET",
	             success: function(res){
	                 self.button('reset');
	                 $data = JSON.parse(res.data);
	                 populateForm($data, document.getElementsByClassName("editForm")[0] );
	                 $('#editpsessionModal form').attr("data-id", self.data('id') );
	                 $('#editpsessionModal').modal('show');
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
		 		                 url: "{{ url('psession') }}" + "/" +  self.attr("data-id"),
		 		                 type: "POST",
		 		                 data: "_method=PUT&" + self.serialize(),
		 		                 success: function(res){
		 		                     $('#editpsessionModal').modal('hide');
		 		                     $('.alerts-list').append(
		 		                         '<li>\
		 		                             <div class="alert alert-success alert-dismissable">\
		 		                                 <i class="icon-check-sign"></i> psession has been successfully updated!\
		 		                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
		 		                             </div>\
		 		                         </li>');
		 														 oTable.ajax.reload();

		 		                 },
		 		                 error: function(){
		 		                     $('#editpsessionModal').modal('hide')
		 		                     $('.alerts-list').append(
		 		                         '<li>\
		 		                             <div class="alert alert-danger alert-dismissable">\
		 		                                 <i class="icon-remove-sign"></i> <strong>Opps!</strong>something went wrong.\
		 		                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
		 		                             </div>\
		 		                         </li>');
		 		                         oTable.ajax.reload();
		 		                 }
		 		             });
		 		             e.preventDefault();
		 		         }
		 		      });

							oTable = $('#psessions').DataTable({
								"responsive": true,
								"stateSave": true,
								"deferLoading": {{ $tableData->getData()->recordsFiltered }},
								"columns": [
										{data: 'team_id', name: 'team_id'},
										{data: 'match_id', name: 'match_id'},
										{data: 'time', name: 'time'},
										{data: 'percent', name: 'percent'},
										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
