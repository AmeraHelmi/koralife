@extends('admin')
@section('styles')
@endsection
@section('content')
<div class="content-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<br>
<ul class="alerts-list delete"></ul>
<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> أضافة تحليل
</a>
				<div class="widget-content-white glossed">
						<div class="padded">
								<table id="analysis" class="table table-striped table-bordered table-hover datatable">
										<thead>
												<tr>
														<th class="col-md-2">مباراه</th>
														<th class="col-md-2">التحليل</th>
														<th class="col-md-4">التاريخ</th>
														<th class="col-md-2">المؤلف</th>
														<th class="col-md-2">خيارات</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($tableData->getData()->data as $row)
													<tr>
															<td>{{ $row->T1name }}</td>
															<td>{{ $row->analysis }}</td>
															<td>{{ $row->analysis_date }}</td>
															<td>{{ $row->Author }}</td>
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
									<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> أضافة تحليل</h4>
								</div>
								<form role="form" method="POST" class="addForm" action="{{ url('/analysis/store') }}" data-toggle="validator">
									<div class="modal-body">
										@include('analysis.form')
									</div>
									<div class="modal-footer">
										<button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
										<button type="submit" class="btn btn-primary" id="addNew">موافق وأضافة جديد</button>
									</div>
											</form>
							</div>
					</div>
				</div>
				<div class="modal fade" id="editanalysisModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تحديث</h4>
							</div>
							<form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('/analysis/update') }}" data-toggle="validator">
									<div class="modal-body">
										@include('analysis.formupdate')
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
<script>
$(function(){
$('#datetime12').combodate();
});
$(function(){
$('#datetime122').combodate();
});
function select_match(){
$championship_id=$('#championship_id').val();
$.ajax({
url: '{{ url('analysis/get_match') }}',
type: "POST",
data:{
championship_id:$championship_id
},
success:function(res)
{
$('#show_match').show();
$('#match').html(res);
},
error:function(){

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
		url: '{!!URL::route('addanalysis')!!}',
		type: "POST",
		data: self.serialize(),
		success: function(res){
				$('.addForm')[0].reset();
$('.alerts-list').append(
'<li>\
<div class="alert alert-success alert-dismissable">\
        <i class="icon-check-sign"></i> تمت الأضافه بنجـــــــــــاح!\
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
url: "{{ url('analysis') }}" + "/" + self.data('id') + "/edit" ,
type: "GET",
success: function(res){
self.button('reset');
$data = JSON.parse(res.data);
populateForm($data, document.getElementsByClassName("editForm")[0] );
$('#editanalysisModal form').attr("data-id", self.data('id') );
$('#editanalysisModal').modal('show');
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
$("#editanalysisModal form").validator().on('submit', function(e){
     if (!e.isDefaultPrevented())
     {
         var self = $(this);
         $.ajax({
             url: "{{ url('analysis') }}" + "/" +  self.attr("data-id"),
             type: "POST",
             data: "_method=PUT&" + self.serialize(),
             success: function(res){
                 $('#editanalysisModal').modal('hide');
                 $('.alerts-list').append(
                     '<li>\
                         <div class="alert alert-success alert-dismissable">\
                             <i class="icon-check-sign"></i> تم تعديل التحليل بنجاح!\
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                         </div>\
                     </li>');
				oTable.ajax.reload();

             },
             error: function(){
                 $('#editanalysisModal').modal('hide')
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

	oTable = $('#analysis').DataTable({
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"deferLoading": {{ $tableData->getData()->recordsFiltered }},
		"columns": [
				{data: 'T1name', name: 'T1name'},
				{data: 'analysis', name: 'analysis'},
				{data: 'analysis_date', name: 'analysis_date'},
				{data: 'Author', name: 'Author'},
				{data: 'actions', name: 'actions', orderable: false, searchable: false}
		]
	});
	});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
