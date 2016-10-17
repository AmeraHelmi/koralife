@extends('admin')

@section('styles')
<style>
.tabs
{
    width:100%;
    display:inline-block;
}

/*----- Tab Links -----*/
/* Clearfix */
.tab-links:after
{
      display:block;
      clear:both;
      content:'';
}

.tab-links li
{
      margin:0px 5px;
      float:right;
      list-style:none;
}

.tab-links a
{
      padding:9px 15px;
      display:inline-block;
      border-radius:3px 3px 0px 0px;
      background:#7FB5DA;
      font-size:16px;
      font-weight:600;
      color:#4c4c4c;
      transition:all linear 0.15s;
}

.tab-links a:hover
{
      background:#a7cce5;
      text-decoration:none;
}

li.active a, li.active a:hover
{
      background:#fff;
      color:#4c4c4c;
}

/*----- Content of Tabs -----*/
.tab-content
{
      padding:15px;
      border-radius:3px;
      box-shadow:-1px 1px 1px rgba(0,0,0,0.15);
      background:#fff;
}

.tab
{
      display:none;
}

.tab.active
{
      display:block;
}
</style>
@endsection

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
           						<i class="icon-remove-sign"></i> تم أضافة مباراه بنجـــــــــــاح!.
           						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       						</div>
							</li>
						</ul>
						<ul class="alerts-list" style="display:none;" id="showupdate">
							<li>
     							<div class="alert alert-success alert-dismissable">
           						<i class="icon-remove-sign"></i> تم تحديث المباراه بنجـــــــــــاح!.
           						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
       						</div>
							</li>
						</ul>
						<a class="btn btn-primary add" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
							<i class="fa fa-plus-circle"  style="font-size: 18px;"></i> أضافة مباراه
						</a>
						<div class="widget-content-white glossed">
								<div class="padded">
										<table id="matchs" class="table table-striped table-bordered table-hover datatable">
													<thead>
															<tr>
																	<th class="col-md-1">النادى الأول </th>
																	<th class="col-md-1">النادى الثانى </th>
                                  <th class="col-md-1">التارخ</th>
																	<th class="col-md-1">نوع البطولة</th>
																	<th class="col-md-1">خيارات</th>
																</tr>
													</thead>
													<tbody>
													@foreach ($tableData->getData()->data as $row)
															<tr>
																	<td>{{ $row->team1_name }}</td>
																	<td>{{ $row->team2_name }}</td>
																	<td>{!! $row->match_date !!}</td>
																	<td>{{ $row->type }}</td>
																	<td>{!!$row->actions !!}</td>
															</tr>
													@endforeach
												  </tbody>
										</table>
							</div>
              <!-- data-backdrop="static" data-keyboard="false" -->
				</div>
				<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    				<div class="modal-dialog">
        				<div class="modal-content">
            				<div class="modal-header">
                				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                				<h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i>أضافة مبارأة</h4>
												<div class="tabs">
														<ul class="tab-links tab_ul">
                             		<li class="active"><a href="#tab1" id="unformal" value="unformal"> ودية</a></li>
                             		<li><a href="#tab2" id="cup" value="cup">كأس</a></li>
                             		<li><a href="#tab3" id="dawry" value="dawry">دورى</a></li>
                         		</ul>
                            <form role="form" method="POST" class="addForm" action="{{ url('/match/store') }}" data-toggle="validator">
                                <div class="modal-body">
                                        @include('match.form')
                                </div>
                              <div class="modal-footer">
                                  <button type="submit" id="submitForm" class="btn btn-primary">موافق</button>
                                  <button type="submit" class="btn btn-primary" id="addNew">موافق وأضافة جديد</button>
                              </div>
												</form>
								</div>
						</div>
        </div>
    </div>
</div>
<div class="modal fade" id="editgroupModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i>أضافة مبارأة</h4>

                    <form role="form" method="POST" class="editForm" action="{{ url('/match/update') }}" data-toggle="validator">
                        <div class="modal-body">
                                @include('match.formupdate')
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
</div>
@endsection

@section('scripts')
<script src="http://malsup.github.com/jquery.form.js"></script>
<script>
		$(function(){
	  $('#datetime12').combodate();
	});
  $(function(){
  $('#datetime122').combodate();
});
function check()
{
  var x = document.getElementById("team1").value;
  var y = document.getElementById("team2").value;
  if(x == y)
  {
    alert("اختر فريقين مختلفين");
    document.getElementById("submitForm").disabled = true;
  }
  else {
document.getElementById("submitForm").disabled = false;
    }
  }

function func()
{
  var x = document.getElementById("type").value;
  if(x == "كأس")
  {
    // $("#group").show();
    // document.getElementById("week").style.visibility = "hidden";
    document.getElementById('weekdiv').style.display = "none";
    document.getElementById('groupdiv').style.display = "block";
    document.getElementById('rolediv').style.display = "block";

  }
  else if (x == "دورى") {
    document.getElementById('weekdiv').style.display = "block";
    document.getElementById('groupdiv').style.display = "none";
    document.getElementById('rolediv').style.display = "none";


  }
  else {
    document.getElementById('weekdiv').style.display = "none";
    document.getElementById('groupdiv').style.display = "none";
    document.getElementById('rolediv').style.display = "none";
    document.getElementById('champion').style.display = "none";


  }
}
  function select_team(){
  $team_type=$('#team_type').val();
  $.ajax({
      url: '{{ url('match/get_teams') }}',
      type: "POST",
    data:{
        team_type:$team_type
      },
      success:function(res)
      {
        $('#showteam1').show();
        $('#team1').html(res);
      },
      error:function(){

      }
    });
  }
  function select_team2(){
  $team_id=$('#team1').val();
  $team_type=$('#team_type').val();
  $.ajax({
      url: '{{ url('match/select2') }}',
      type: "POST",
    data:{
        team_id:$team_id,
        team_type:$team_type
      },
      success:function(res)
      {
        $('#showteam2').show();
        $('#team2').html(res);
      },
      error:function(){
      }
    });
  }
  </script>
  <script type="text/javascript">
      !function(e){var t=function(t,n){this.$element=e(t),this.type=this.$element.data("uploadtype")||(this.$element.find(".thumbnail").length>0?"image":"file"),this.$input=this.$element.find(":file");if(this.$input.length===0)return;this.name=this.$input.attr("name")||n.name,this.$hidden=this.$element.find('input[type=hidden][name="'+this.name+'"]'),this.$hidden.length===0&&(this.$hidden=e('<input type="hidden" />'),this.$element.prepend(this.$hidden)),this.$preview=this.$element.find(".fileupload-preview");var r=this.$preview.css("height");this.$preview.css("display")!="inline"&&r!="0px"&&r!="none"&&this.$preview.css("line-height",r),this.original={exists:this.$element.hasClass("fileupload-exists"),preview:this.$preview.html(),hiddenVal:this.$hidden.val()},this.$remove=this.$element.find('[data-dismiss="fileupload"]'),this.$element.find('[data-trigger="fileupload"]').on("click.fileupload",e.proxy(this.trigger,this)),this.listen()};t.prototype={listen:function(){this.$input.on("change.fileupload",e.proxy(this.change,this)),e(this.$input[0].form).on("reset.fileupload",e.proxy(this.reset,this)),this.$remove&&this.$remove.on("click.fileupload",e.proxy(this.clear,this))},change:function(e,t){if(t==="clear")return;var n=e.target.files!==undefined?e.target.files[0]:e.target.value?{name:e.target.value.replace(/^.+\\/,"")}:null;if(!n){this.clear();return}this.$hidden.val(""),this.$hidden.attr("name",""),this.$input.attr("name",this.name);if(this.type==="image"&&this.$preview.length>0&&(typeof n.type!="undefined"?n.type.match("image.*"):n.name.match(/\.(gif|png|jpe?g)$/i))&&typeof FileReader!="undefined"){var r=new FileReader,i=this.$preview,s=this.$element;r.onload=function(e){i.html('<img src="'+e.target.result+'" '+(i.css("max-height")!="none"?'style="max-height: '+i.css("max-height")+';"':"")+" />"),s.addClass("fileupload-exists").removeClass("fileupload-new")},r.readAsDataURL(n)}else this.$preview.text(n.name),this.$element.addClass("fileupload-exists").removeClass("fileupload-new")},clear:function(e){this.$hidden.val(""),this.$hidden.attr("name",this.name),this.$input.attr("name","");if(navigator.userAgent.match(/msie/i)){var t=this.$input.clone(!0);this.$input.after(t),this.$input.remove(),this.$input=t}else this.$input.val("");this.$preview.html(""),this.$element.addClass("fileupload-new").removeClass("fileupload-exists"),e&&(this.$input.trigger("change",["clear"]),e.preventDefault())},reset:function(e){this.clear(),this.$hidden.val(this.original.hiddenVal),this.$preview.html(this.original.preview),this.original.exists?this.$element.addClass("fileupload-exists").removeClass("fileupload-new"):this.$element.addClass("fileupload-new").removeClass("fileupload-exists")},trigger:function(e){this.$input.trigger("click"),e.preventDefault()}},e.fn.fileupload=function(n){return this.each(function(){var r=e(this),i=r.data("fileupload");i||r.data("fileupload",i=new t(this,n)),typeof n=="string"&&i[n]()})},e.fn.fileupload.Constructor=t,e(document).on("click.fileupload.data-api",'[data-provides="fileupload"]',function(t){var n=e(this);if(n.data("fileupload"))return;n.fileupload(n.data());var r=e(t.target).closest('[data-dismiss="fileupload"],[data-trigger="fileupload"]');r.length>0&&(r.trigger("click.fileupload"),t.preventDefault())})}(window.jQuery)
		$(document).ready(function()
		{

			jQuery('.tabs .tab-links a').on('click', function(e)
			{
	         var currentAttrValue = jQuery(this).attr('href');
	         // Show/Hide Tabs
	         jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
	         // Change/remove current tab to active
	         jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
	         e.preventDefault();
	     });


		function populateForm(response, frm)
		{
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

    $("#cup").on('click', function(e){
      $("#group").show();
      $("#week").hide();
      $("#role").show();
      $("#champion").show();
      $("#type_match").val("cup");
    });

    $("#unformal").on('click', function(e){
      $("#group").hide();
      $("#week").hide();
      $("#role").hide();
      $("#champion").hide();
      $("#type_match").val("unformal");

    });
    $("#dawry").on('click', function(e){
          $("#week").show();
          $("#group").hide();
          $("#role").hide();
          $("#champion").show();
          $("#type_match").val("dawry");
    });

$("#addModal form").on('submit', function(e)
{
		if (!e.isDefaultPrevented())
    {
        var self = $(this);
        $.ajax({
            url: '{!!URL::route('addmatch')!!}',
            type: "POST",
            data: self.serialize(),
            success: function(res){
                  $('.addForm')[0].reset();
                  $('.alerts-list').append(
                      '<li>\
                          <div class="alert alert-success alert-dismissable">\
                              <i class="icon-check-sign"></i>تم أضافة مباراه بنجاح!\
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
                              <i class="icon-remove-sign"></i> حدث خطا ما.\
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
           url: "{{ url('match') }}" + "/" + self.data('id') + "/edit" ,
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
                           <i class="icon-remove-sign"></i>حدث خطا ما.\
                           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                       </div>\
                   </li>');
           }
       });
   });
   /* update Form Submission */
$("#editgroupModal form").validator().on('submit', function(e)
{
    if (!e.isDefaultPrevented())
      {
          var self = $(this);
          $.ajax({
              url: "{{ url('match') }}" + "/" +  self.attr("data-id"),
              type: "POST",
              data: "_method=PUT&" + self.serialize(),
              success: function(res){
                   $('#editgroupModal').modal('hide');
                   $('.alerts-list').append(
                     '<li>\
                         <div class="alert alert-success alert-dismissable">\
                             <i class="icon-check-sign"></i>تم تعديل المباراة بنجاح!\
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
                          <i class="icon-remove-sign"></i>  حدث خطأ.\
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
										{data: 'team1_name', name: 'team1'},
										{data: 'team2_name', name: 'team2_name'},
                    {data: 'match_date',  name: 'match_date'},
                    {data: 'type',  name: 'type'},
										{data: 'actions', name: 'actions', orderable: false, searchable: false}
								]
							});
							$('#addModal').on('shown.bs.modal', function () {
										$('.addForm')[0].reset();
										$('.chosen-select-it', this).chosen({disable_search_threshold: 10});
										$('.chosen-select-multiple', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
								});

								$('#addModal form2').on('shown.bs.modal', function () {
											$('.addForm')[0].reset();
											$('.chosen-select-it', this).chosen({disable_search_threshold: 10});
											$('.gg', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
									});
								$('#editgroupModal').on('shown.bs.modal', function () {
										$('.chosen-select-it', this).chosen({disable_search_threshold: 10});
										$('.chosen-select-multiple', this).chosen({disable_search_threshold: 10}).trigger("chosen:updated");
								});
								// $('#groupModal').on('shown.bs.modal', function () {
								//     $('.chosen-select-it', this).chosen({disable_search_threshold: 10});
								//     $('.chosen-select-multiple', this).chosen({disable_search_threshold: 10});
								// });
								$('.group-search').chosen({disable_search_threshold: 10});
								$('.gg').chosen({disable_search_threshold: 10});
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>

@endsection
