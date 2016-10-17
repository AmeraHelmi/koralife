@extends('admin')
@section('content')
<div class="content-wrapper">
		<div class="container-fluid">
				<div class="row">
						<div class="col-md-12">
						<br>
								<ul class="alerts-list delete"></ul>
								<ul class="alerts-list" style="display:none;" id="show">
  									<li>
     										<div class="alert alert-success alert-dismissable">
           									<i class="icon-remove-sign"></i> تم أدخال فئة!.
           									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       									</div>
   									</li>
									</ul>
									<ul class="alerts-list" style="display:none;" id="showupdate">
  										<li>
     											<div class="alert alert-success alert-dismissable">
           										<i class="icon-remove-sign"></i>  تم تحديث فئة بنجاح
           										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       										</div>
   										</li>
									</ul>
									<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
										<i class="fa fa-plus-circle" style="font-size: 18px;"></i> أضافة فئة
									</a>
									<div class="widget-content-white glossed">
											<div class="padded">
													<table id="countries" class="table table-striped table-bordered table-hover datatable">
															<thead>
																	<tr>
																			<th class="col-md-4">أسم الفئة</th>
																			<th class="col-md-2">خيارات</th>
																	</tr>
															</thead>
															<tbody>
																@foreach ($tableData->getData()->data as $row)
																	<tr>
																			<td>{{ $row->name }}</td>
																			<td>{!! $row->actions !!}</td>
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
                											<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> أضافة فئة</h4>
            										</div>
            										<form role="form"  method="POST" class="addForm" action="{{ url('/category/store') }}" data-toggle="validator"  enctype="multipart/form-data" >
                											<div class="modal-body">
                    											@include('category.form')
                											</div>
                											<div class="modal-footer">
                    											<button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
                    											<button type="submit" class="btn btn-primary" id="addNew">موافق وأضافة جديد</button>
                											</div>
            										</form>
        										</div>
    										</div>
											</div>
											<div class="modal fade" id="editcountryModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    											<div class="modal-dialog">
        												<div class="modal-content">
            												<div class="modal-header">
                													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              														<h4 class="modal-title" id="editcountryModal"><i class="fa fa-pencil"></i> تحديث</h4>
            												</div>
            												<form role="form"  method="POST" class="editForm" data-id="" action="{{ url('/category/update') }}" data-toggle="validator" enctype="multipart/form-data">
																				<div class="modal-body">
                    											@include('category.form')
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
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
	$(document).ready(function() {

    //addcountry
    $('.addForm').ajaxForm(function() {
    $('.addForm')[0].reset();
    $('#show').show(100);
    oTable.ajax.reload();
    oTable.draw();
        });

    //Updatecountry
    $('.editForm').ajaxForm(function() {
    $('#showupdate').show(100);
    $('#editcountryModal').modal('hide');
    oTable.ajax.reload();
    oTable.draw();
        });

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

       //Edit Form
		     $(document.body).validator().on('click', '.edit', function() {
           $('.editForm')[0].reset();
		    		var self = $(this);
		         self.button('loading');
		         $.ajax({
		   		 			url: "{{ url('category') }}" + "/" + self.data('id') + "/edit" ,
		            type: "GET",
		             success: function(res){
		                 self.button('reset');
		                 $data = JSON.parse(res.data);
		                 populateForm($data, document.getElementsByClassName("editForm")[0] );
		                 $('#editcountryModal form').attr("data-id", self.data('id') );
		                 $('#editcountryModal').modal('show');
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

	oTable = $('#countries').DataTable({
		"processing": true,
		"serverSide": true,
		"responsive": true,
		"deferLoading": {{ $tableData->getData()->recordsFiltered }},
		"columns": [
				{data: 'name', name: 'name'},
				{data: 'actions', name: 'actions', orderable: false, searchable: false}
		]

	});

});

</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
