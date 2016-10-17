@extends('admin')
@section('styles')
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
		<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> لحظه بلحظه
</a>

<a class="btn btn-danger" style="margin-bottom:20px;" data-toggle="modal" data-target="#finish_match_model" href="{{ url('/finish') }}">
		<i class="fa fa-hourglass-end"  style="font-size: 18px;"></i> أنهاء التعديلات</a>

<div class="widget-content-white glossed">
		<div class="padded">
				<table id="analysis" class="table table-striped table-bordered table-hover datatable">
						<thead>
								<tr>
										<th class="col-md-2">مباراه</th>
										<th class="col-md-2">لحظه بلحظه</th>
										<th class="col-md-4">الوقت</th>
										<th class="col-md-2">خيارات</th>
								</tr>
						</thead>
						<tbody>
								@foreach ($tableData->getData()->data as $row)
								<tr>
										<td>{{ $row->T1name }}</td>
										<td>{{ $row->body }}</td>
										<td>{{ $row->minute }}</td>
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
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> أضافة تحليل</h4>
            </div>
            <form role="form" method="POST" class="addForm" action="{{ url('/minute/store') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('minutes.form')
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
            <form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('/minute/update') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('minutes.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- finish match  -->
<div class="modal fade" id="finish_match_model" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id=""><i class="fa fa-pencil"></i> أنهاء التعديلات</h4>
            </div>
  <form role="form" id="" method="POST" class="" data-id="" action="{{ url('/minute/finish') }}" data-toggle="validator">
                <div class="modal-body">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
						<label for="exampleInputFile">أختيار المباراه </label>
						<select  class="form-control"  id="match"  name="match_id">
						 <option selected>أختيار المباراه</option>
						 @foreach($matches as $key=>$value)
						  <option value="{!! $value['matchid'] !!}">{!! $value['team1_name'] !!} - {!! $value['team2_name'] !!}</option>
						  @endforeach
						</select>
						</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submit" class="btn btn-primary">انهاء</button>
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
								url: '{!!URL::route('addminute')!!}',
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

		//Finish match
				$("#finish_match_model form").on('submit', function(e){
				if (!e.isDefaultPrevented())
				{
						var self = $(this);
						$.ajax({
								url: '{!!URL::route('finish_match')!!}',
								type: "POST",
								data: self.serialize(),
								success: function(res){
					$('.addForm')[0].reset();
                    $('.alerts-list').append(
                        '<li>\
                    <div class="alert alert-success alert-dismissable">\
                                <i class="icon-check-sign"></i> تم أنهاء التعديلات بنجـــــــــاح!\
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                            </div>\
                        </li>');
                    $('#finish_match_model').modal('hide');
                    oTable.ajax.reload();
                    oTable.draw();
                },
                error: function(){
                    $('#finish_match_model').modal('hide')
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
	             url: "{{ url('minute') }}" + "/" + self.data('id') + "/edit" ,
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
		 		                 url: "{{ url('minute') }}" + "/" +  self.attr("data-id"),
		 		                 type: "POST",
		 		                 data: "_method=PUT&" + self.serialize(),
		 		                 success: function(res){
		 		                     $('#editanalysisModal').modal('hide');
		 		                     $('.alerts-list').append(
		 		                         '<li>\
		 		                             <div class="alert alert-success alert-dismissable">\
		 		                                 <i class="icon-check-sign"></i> Analysis has been successfully updated!\
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
										{data: 'body', name: 'body'},
										{data: 'minute', name: 'minute'},
										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});
							});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>

	@endsection
