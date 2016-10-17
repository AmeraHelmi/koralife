@extends('admin')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <br>
                <ul class="alerts-list delete"></ul>
       <a class="btn btn-primary" data-toggle="modal" data-target="#addModal" style="margin-bottom:20px;" >
                    <i class="fa fa-plus-circle"  style="font-size: 18px;"></i> أضافة رد
                </a>
                <div class="widget-content-white glossed">
                    <div class="padded">
                        <table id="cities" class="table table-striped table-bordered table-hover datatable">
                            <thead>
                                  <tr>
                                      <th class="col-md-1">عنوان المدونه</th>
                                      <th class="col-md-3">التعليق</th>
                                      <th class="col-md-1">التاريخ</th>
                                      <th class="col-md-1">خيارات</th>
                                  </tr>
                            </thead>
                            <tbody>
                            @foreach ($tableData->getData()->data as $row)
                                  <tr>
                                      <td>{{ $row->Post_title }}</td>
                                      <td>{{ $row->comment }}</td>
                                      <td>{{ $row->date }}</td>
                                      <td>{!!$row->actions !!}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="addModalLabel"><i class="fa fa-plus-circle"></i> أضافة رد</h4>
                </div>
                <form role="form" method="POST" class="addForm" action="{{ url('/post-comments/store') }}" data-toggle="validator">
                <div class="modal-body">
                  @include('post_comments.form')
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
});
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
                url: '{!!URL::route('addcomment')!!}',
                type: "POST",
                data: self.serialize(),
                success: function(res){
                    $('.addForm')[0].reset();
                    $('.alerts-list').append(
                        '<li>\
                            <div class="alert alert-success alert-dismissable">\
                                <i class="icon-check-sign"></i> تم أضافة رد بنجاح!\
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
                                <i class="icon-remove-sign"></i> <strong>Opps!</strong> حدث خطا.\
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                            </div>\
                        </li>');
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
                                        {data: 'Post_title', name: 'Post_title'},
                                        {data: 'comment', name: 'comment'},
                                        {data: 'date', name: 'date'},
                                        {data: 'actions', name: 'actions', orderable: false, searchable: false}
                                ]
                            });
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
