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
<ul class="alerts-list" style="display:none;" id="show">
  <li>
     <div class="alert alert-success alert-dismissable">
           <i class="icon-remove-sign"></i>تم أضافة بطوله بنجـــــاح!.
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       </div>
   </li>
</ul>
<ul class="alerts-list" style="display:none;" id="showupdate">
  <li>
     <div class="alert alert-success alert-dismissable">
           <i class="icon-remove-sign"></i> تم تحديث البيانات بنجـــــــاح!.
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

       </div>
   </li>
</ul>
<a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
		<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> أضافة بطوله
</a>
<div class="widget-content-white glossed">
		<div class="padded">
				<table id="champions" class="table table-striped table-bordered table-hover datatable">
						<thead>
								<tr>
										<th class="col-md-1">أسم البطوله</th>
										<th class="col-md-1">أسم الدوله</th>
										<th class="col-md-1">عدد المباريات</th>
										<th class="col-md-1">النوع</th>
                    <th class="col-md-1">الماركه</th>
										<th class="col-md-1">خيارات</th>
								</tr>
						</thead>
						<tbody>
								@foreach ($tableData->getData()->data as $row)
								<tr>
										<td>{{ $row->name }}</td>
										<td>{{ $row->countryname }}</td>
										<td>{{ $row->no_matches }}</td>
										<td>{{ $row->type }}</td>
                    <td>{{ $row->B_brand }}</td>
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
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> أضافة بطوله</h4>
            </div>
            <form role="form" method="POST" class="addForm" action="{{ url('/championship/store') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('championship.form')
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
                    <button type="submit" class="btn btn-primary" id="addNew">موافق وأضافة جديد</button>

                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editchampionModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editEmployeeModalLabel"><i class="fa fa-pencil"></i> تحديث</h4>
            </div>
            <form role="form" id="update_form" method="POST" class="editForm" data-id="" action="{{ url('/championship/update') }}" data-toggle="validator">
                <div class="modal-body">
                    @include('championship.form')
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
		$('#datetime1').combodate();
		$('#datetime2').combodate();
});
</script>

	<script type="text/javascript">
	!function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
$(document).ready(function() {
	//add
  $('.addForm').ajaxForm(function() {
  $('.addForm')[0].reset();
  $('#show').show(100);
  oTable.ajax.reload();
  oTable.draw();
      });

	//Update
	$('.editForm').ajaxForm(function() {
	$('#showupdate').show(100);
	$('#editchampionModal').modal('hide');
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

	     /* Edit Form */
	     $(document.body).validator().on('click', '.edit', function() {
				 //		$('#showCity').show();
	    var self = $(this);
	         self.button('loading');
	         $.ajax({
	             url: "{{ url('championship') }}" + "/" + self.data('id') + "/edit" ,
	             type: "GET",
	             success: function(res){
	                 self.button('reset');
	                 $data = JSON.parse(res.data);
									 populateForm($data, document.getElementsByClassName("editForm")[0] );
	                 $('#editchampionModal form').attr("data-id", self.data('id') );
	                 $('#editchampionModal').modal('show');
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




							oTable = $('#champions').DataTable({
                "processing": true,
								"serverSide": true,
								"responsive": true,
								"deferLoading": {{ $tableData->getData()->recordsFiltered }},
								"columns": [
										{data: 'name', name: 'name'},
										{data: 'countryname', name: 'countryname'},
										{data: 'no_matches', name: 'no_matches'},
										{data: 'type', name: 'type'},
                    {data: 'B_brand', name: 'B_brand'},
										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>

	@endsection
