@extends('admin')
@section('content')
<div class="content-wrapper">
		<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<br>
								<ul class="alerts-list"></ul>
								<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
										<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> الفريق الفائز بالبطوله
								</a>
								<div class="widget-content-white glossed">
										<div class="padded">
												<table id="winners" class="table table-striped table-bordered table-hover datatable">
															<thead>
																	<tr>
																			<th class="col-md-2">البطوله</th>
																			<th class="col-md-1">الفريق</th>
																			<th class="col-md-2"> تاريخ الفوز</th>
																			<th class="col-md-2"> عدد الاهداف</th>
																			<th class="col-md-2"> عدد النقاط</th>
																			<th class="col-md-2"> خيارات </th>
																	</tr>
															</thead>
															<tbody>
																@foreach ($tableData->getData()->data as $row)
																<tr>
																		<td>{{ $row->championship_name }}</td>
																		<td>{{ $row->team_name }}</td>
																		<td>{{ $row->winners_win_date }}</td>
																		<td>{{ $row->winners_goals }}</td>
																		<td>{{ $row->winners_points }}</td>
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
                								<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> الفريق الفائز بالبطوله</h4>
            							</div>
            							<form role="form" method="POST" class="addForm" action="{{ url('/winner/store') }}" data-toggle="validator">
                								<div class="modal-body">
                    								@include('winner.form')
                								</div>
                								<div class="modal-footer">
                    									<button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
                    									<button type="submit" class="btn btn-primary" id="addNew">موافق وأضافة جديد</button>
                								</div>
            							</form>
        							</div>
    							</div>
							</div>
							<div class="modal fade" id="editwinnerModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    							<div class="modal-dialog">
        							<div class="modal-content">
            							<div class="modal-header">
                							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                							<h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تحديث</h4>
            							</div>
            							<form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('/winner/update') }}" data-toggle="validator">
                								<div class="modal-body">
                    								@include('winner.form')
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
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script>
		$(function()
		{
    		$('#datetime12').combodate();
		});
</script>
<script type="text/javascript">
		$(document).ready(function()
		{
				function populateForm(response, frm)
				{
        		var i;
        		for (i in response)
						{
            		if (i in frm.elements)
                frm.elements[i].value = response[i];
        		}
    		}
				$("#submitForm").on('click', function(e)
				{
        		$('#addModal').modal('hide');
    		});
				$("#addModal form").on('submit', function(e)
				{
						if (!e.isDefaultPrevented())
						{
								var self = $(this);
								$.ajax({
											url: '{!!URL::route('addwinner')!!}',
											type: "POST",
											data: self.serialize(),
											success: function(res){
												$('.addForm')[0].reset();
												$('.alerts-list').append(
												'<li>\
									<div class="alert alert-success alert-dismissable">\
						<i class="icon-check-sign"></i> تم اضافة فريق فائز بالبطوله بنج____اح!\
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
	             url: "{{ url('winner') }}" + "/" + self.data('id') + "/edit" ,
	             type: "GET",
	             success: function(res){
	                 self.button('reset');
	                 $data = JSON.parse(res.data);
	                 populateForm($data, document.getElementsByClassName("editForm")[0] );
	                 $('#editwinnerModal form').attr("data-id", self.data('id') );
	                 $('#editwinnerModal').modal('show');
	             },
	             error: function(){
	                 self.button('reset');
	                   $('.alerts-list').append(
	                     '<li>\
	                         <div class="alert alert-danger alert-dismissable">\
	                             <i class="icon-remove-sign"></i> <strong>Opps!</strong> حدث خطأ.\
	                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
	                         </div>\
	                     </li>');
	             }
	         });
	     });

		 				 /* update Form Submission */
$("#editwinnerModal form").validator().on('submit', function(e){
		 		         if (!e.isDefaultPrevented())
		 		         {
		 		             var self = $(this);
		 		             $.ajax({
		 		                 url: "{{ url('winner') }}" + "/" +  self.attr("data-id"),
		 		                 type: "POST",
		 		                 data: "_method=PUT&" + self.serialize(),
		 		                 success: function(res){
		 		                     $('#editwinnerModal').modal('hide');
		 		                     $('.alerts-list').append(
		 		                         '<li>\
		 		                             <div class="alert alert-success alert-dismissable">\
		 		                                 <i class="icon-check-sign"></i> winner has been successfully updated!\
		 		                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
		 		                             </div>\
		 		                         </li>');
		 														 oTable.ajax.reload();

		 		                 },
		 		                 error: function(){
		 		                     $('#editwinnerModal').modal('hide')
		 		                  	                   $('.alerts-list').append(
	                     '<li>\
	                         <div class="alert alert-danger alert-dismissable">\
	                             <i class="icon-remove-sign"></i> <strong>Opps!</strong> حدث خطأ.\
	                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
	                         </div>\
	                     </li>');
		 		                         oTable.ajax.reload();
		 		                 }
		 		             });
		 		             e.preventDefault();
		 		         }
		 		      });

							oTable = $('#winners').DataTable({
								"responsive": true,
								"stateSave": true,
								"deferLoading": {{ $tableData->getData()->recordsFiltered }},
								"columns": [
										{data: 'championship_name', name: 'championship_name'},
										{data: 'team_name', name: 'team_name'},
										{data: 'winners_win_date', name: 'winners_win_date'},
										{data: 'winners_goals', name: 'winners_goals'},
										{data: 'winners_points', name: 'winners_points'},
										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
