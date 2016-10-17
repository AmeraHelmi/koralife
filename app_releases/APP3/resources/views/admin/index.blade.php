@extends('admin')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <br>
                <ul class="alerts-list delete"></ul>
                    <a class="btn btn-primary" data-toggle="modal" data-target="#editadminModal" style="margin-bottom:20px;" >
	                       <i class="fa fa-pencil" style="font-size: 18px;"></i> تعديل معلوماتك الشخصيه
                    </a>
                    <div class="widget-content-white glossed">
                        <div class="modal fade" id="editadminModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="editcountryModal"><i class="fa fa-pencil"></i> تحديث</h4>
                                    </div>
                                    <form role="form"  method="POST" class="editadminForm" data-id="" action="{{ url('/users/update_admin') }}" data-toggle="validator">
                                          <div class="modal-body">
                                              @include('admin.adminform')
                                          </div>
                                          <div class="modal-footer">
                                              <button type="submit" id="submit" class="btn btn-primary">تحديث</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                          <div class="padded">
                              <table id="users" class="table table-striped table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                              <th class="col-md-3">الأسم</th>
                                              <th class="col-md-3">الأيميل</th>
                                              <th class="col-md-3">الدور</th>
                                              <th class="col-md-2">خيارات</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      @foreach ($tableData->getData()->data as $row)
                                        <tr id="employee_{{ $row->id }}">
                                            <td>{!! $row->name !!}</a></td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->role }}</td>
                                            <td>{!! $row->actions !!}</td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                              <div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title" id="editcountryModal"><i class="fa fa-pencil"></i> تحديث</h4>
                                          </div>
                                          <form role="form"  method="POST" class="editForm" data-id="" action="{{ url('/admin/update') }}" data-toggle="validator">
                                                <div class="modal-body">
                                                  @include('admin.form')
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

    /* Edit Form */
    $(document.body).validator().on('click', '.edit', function() {
   var self = $(this);
        self.button('loading');
        $.ajax({
            url: "{{ url('users') }}" + "/" + self.data('id') + "/edit" ,
            type: "GET",
            success: function(res){
                self.button('reset');
                $data = JSON.parse(res.data);
                populateForm($data, document.getElementsByClassName("editForm")[0] );
                $('#edituserModal form').attr("data-id", self.data('id') );
                $('#edituserModal').modal('show');
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
          $("#edituserModal form").validator().on('submit', function(e){
              if (!e.isDefaultPrevented())
              {
                  var self = $(this);
                  $.ajax({
                      url: "{{ url('users') }}" + "/" +  self.attr("data-id"),
                      type: "POST",
                      data: "_method=PUT&" + self.serialize(),
                      success: function(res){
                          $('#edituserModal').modal('hide');
                          $('.alerts-list').append(
                              '<li>\
                                  <div class="alert alert-success alert-dismissable">\
                                      <i class="icon-check-sign"></i> تم تحديث بيانات المستخدم بنجــــــــــاح!\
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                                  </div>\
                              </li>');
                              oTable.ajax.reload();

                      },
                      error: function(){
                          $('#edituserModal').modal('hide')
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


    oTable = $('#users').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
        "deferLoading": {{ $tableData->getData()->recordsFiltered }},
        "columns": [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
    });

});
</script>

<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
