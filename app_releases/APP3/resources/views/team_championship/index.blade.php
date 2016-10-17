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
           										<i class="icon-remove-sign"></i> Team_championship has been successfully added!.
           										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       									</div>
   									</li>
								</ul>
								<ul class="alerts-list" style="display:none;" id="showupdate">
  									<li>
     										<div class="alert alert-success alert-dismissable">
           									<i class="icon-remove-sign"></i> Team_championship has been successfully updated!.
           									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       									</div>
   									</li>
								</ul>
								<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
										<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> Add Team_championship
								</a>
								<div class="widget-content-white glossed">
										<div class="padded">
												<table id="matchs" class="table table-striped table-bordered table-hover datatable">
															<thead>
																		<tr>
																					<th class="col-md-1">team </th>
																					<th class="col-md-1">championship </th>
																					<th class="col-md-1">coach</th>
																					<th class="col-md-1">no_goals</th>
																					<th class="col-md-1">no_points</th>
																					<th class="col-md-1">no_winnes</th>
																					<th class="col-md-1">no_loses</th>
																					<th class="col-md-1">no_draughts</th>
																					<th class="col-md-1">Actions</th>
																			</tr>
																	</thead>
																	<tbody>
																	@foreach ($tableData->getData()->data as $row)
																			<tr>
																					<td>{{ $row->team_name }}</td>
																					<td>{{ $row->championship_name }}</td>
																					<td>{!! $row->coach_name !!}</td>
																					<td>{!! $row->no_goals !!}</td>
																					<td>{{ $row->no_points }}</td>
																					<td>{{ $row->no_winnes }}</td>
																					<td>{{ $row->no_loses }}</td>
																					<td>{{ $row->no_draughts }}</td>
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
            											<form role="form" method="POST" class="addForm" action="{{ url('/team_championship/store') }}" data-toggle="validator" enctype="multipart/form-data" >
                												<div class="modal-body">
                    												@include('team_championship.form')
                												</div>
                												<div class="modal-footer">
                    												<button type="submit" id="submitForm" class="btn btn-primary">Submit</button>
                    												<button type="submit" class="btn btn-primary" id="addNew">Submit and Add New</button>
                												</div>
            												</form>
																</div>
														</div>
												</div>
												<div class="modal fade" id="editgroupModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    												<div class="modal-dialog">
        												<div class="modal-content">
            												<div class="modal-header">
                													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                													<h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> Update</h4>
            												</div>
            												<form role="form"  method="POST" class="editForm" data-id="" action="{{ url('/team_championship/update') }}" data-toggle="validator" enctype="multipart/form-data">
                													<div class="modal-body">
																								@include('team_championship.form')
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
	  <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script>
    $('#datePicker')
        .datepicker({
        format: 'yyyy/mm/dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('.addForm').formValidation('revalidateField', 'date');
        });

      $('.addForm').formValidation({
          framework: 'bootstrap',
          fields: {
              from_date: {
                  validators: {
                  notEmpty: {
                  message: 'The date is required'
                      },
                  from_date: {
                  format: 'yyyy/mm/dd',
                  message: 'The date is not a valid'
                      }
                  }
              }
        }

      });
  </script>
	<script>
	$('#datePicker2')
			.datepicker({
			format: 'yyyy/mm/dd'
			})
			.on('changeDate', function(e) {
					// Revalidate the date field
					$('.addForm').formValidation('revalidateField', 'date');
			});

		$('.addForm').formValidation({
				framework: 'bootstrap',
				fields: {
						to_date: {
								validators: {
								notEmpty: {
								message: 'The date is required'
										},
								to_date: {
								format: 'yyyy/mm/dd',
								message: 'The date is not a valid'
										}
								}
						}
			}

		});
</script>


	<script type="text/javascript">

	  !function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
	$(document).ready(function() {



		function populateForm(response, frm) {
        var i;
        for (i in response) {
            if (i in frm.elements)
                frm.elements[i].value = response[i];
								if (response[i] instanceof Array)
									 {
											 var referees_ids = [];
											 for (var j = response[i].length - 1; j >= 0; j--) {
													 referees_ids.push( parseInt(response[i][j]['id']) );
											 };
											 $('.editForm .chosen-select-multiple').val(referees_ids).trigger("chosen:updated");
									 }
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
                url: '{!!URL::route('addteam_championship')!!}',
                type: "POST",
                data: self.serialize(),
                success: function(res){
                    $('.addForm')[0].reset();
                    $('.alerts-list').append(
                        '<li>\
                            <div class="alert alert-success alert-dismissable">\
                                <i class="icon-check-sign"></i> Match has been successfully added!\
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
	             url: "{{ url('team_championship') }}" + "/" + self.data('id') + "/edit" ,
	             type: "GET",
	             success: function(res){
	                 self.button('reset');
	                 $data = JSON.parse(res.data);
	                 populateForm($data, document.getElementsByClassName("editForm")[0] );
	                 $('#editgroupModal form').attr("data-id", self.data('id') );
	                 $('#editgroupModal').modal('show');
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
             $("#editgroupModal form").validator().on('submit', function(e){
                 if (!e.isDefaultPrevented())
                 {
                     var self = $(this);
                     $.ajax({
                         url: "{{ url('team_championship') }}" + "/" +  self.attr("data-id"),
                         type: "POST",
                         data: "_method=PUT&" + self.serialize(),
                         success: function(res){
                             $('#editgroupModal').modal('hide');
                             $('.alerts-list').append(
                                 '<li>\
                                     <div class="alert alert-success alert-dismissable">\
                                         <i class="icon-check-sign"></i> match has been successfully updated!\
                                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                                     </div>\
                                 </li>');
                                 oTable.ajax.reload();

                         },
                         error: function(){
                             $('#editgroupModal').modal('hide')
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

							oTable = $('#matchs').DataTable({
								"processing": true,
								"serverSide": true,
								"responsive": true,
								"deferLoading": {{ $tableData->getData()->recordsFiltered }},
								"columns": [
										{data: 'team_name', name: 'team_name'},
										{data: 'championship_name', name: 'championship_name'},
                    {data: 'coach_name',  name: 'coach_name'},
										{data: 'no_goals',  name: 'no_goals'},
										{data: 'no_points',  name: 'no_points'},
										{data: 'no_winnes',  name: 'no_winnes'},
										{data: 'no_loses',  name: 'no_loses'},
										{data: 'no_draughts',  name: 'no_draughts'},


										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});
							$('#addModal').on('shown.bs.modal', function () {
										$('.addForm')[0].reset();
										$('.chosen-select-it', this).chosen({disable_search_threshold: 10});
										$('.chosen-select-multiple', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
								});
								$('#editgroupModal').on('shown.bs.modal', function () {
										$('.chosen-select-it', this).chosen({disable_search_threshold: 10});
										$('.chosen-select-multiple', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
								});
								$('.group-search').chosen({disable_search_threshold: 10});
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>

	@endsection
