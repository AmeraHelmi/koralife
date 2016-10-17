@extends('admin')
@section('styles')

<style>

.image {

    width: 100%;

    height: 100%;

}



.image img {

    -webkit-transition: all 1s ease; /* Safari and Chrome */

    -moz-transition: all 1s ease; /* Firefox */

    -ms-transition: all 1s ease; /* IE 9 */

    -o-transition: all 1s ease; /* Opera */

    transition: all 1s ease;

}



.image img:hover  {

    -webkit-transform:scale(7.5); /* Safari and Chrome */

    -moz-transform:scale(7.5); /* Firefox */

    -ms-transform:scale(7.5); /* IE 9 */

    -o-transform:scale(7.5); /* Opera */

     transform:scale(7.5);

}



/* leave this part out */

/* leave this part out */



.clearfix{*zoom:1;}.clearfix:before,.clearfix:after{display:table;content:"";line-height:0;}

.clearfix:after{clear:both;}

.hide-text{font:0/0 a;color:transparent;text-shadow:none;background-color:transparent;border:0;}

.input-block-level{display:block;width:100%;min-height:30px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;}

.btn-file{overflow:hidden;position:relative;vertical-align:middle;}.btn-file>input{position:absolute;top:0;right:0;margin:0;opacity:0;filter:alpha(opacity=0);transform:translate(-300px, 0) scale(4);font-size:23px;direction:ltr;cursor:pointer;}

.fileupload{margin-bottom:9px;}.fileupload .uneditable-input{display:inline-block;margin-bottom:0px;vertical-align:middle;cursor:text;}

.fileupload .thumbnail{overflow:hidden;display:inline-block;margin-bottom:5px;vertical-align:middle;text-align:center;}.fileupload .thumbnail>img{display:inline-block;vertical-align:middle;max-height:100%;}

.fileupload .btn{vertical-align:middle;}

.fileupload-exists .fileupload-new,.fileupload-new .fileupload-exists{display:none;}

.fileupload-inline .fileupload-controls{display:inline;}

.fileupload-new .input-append .btn-file{-webkit-border-radius:0 3px 3px 0;-moz-border-radius:0 3px 3px 0;border-radius:0 3px 3px 0;}

.thumbnail-borderless .thumbnail{border:none;padding:0;-webkit-border-radius:0;-moz-border-radius:0;border-radius:0;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none;}

.fileupload-new.thumbnail-borderless .thumbnail{border:1px solid #ddd;}

.control-group.warning .fileupload .uneditable-input{color:#a47e3c;border-color:#a47e3c;}

.control-group.warning .fileupload .fileupload-preview{color:#a47e3c;}

.control-group.warning .fileupload .thumbnail{border-color:#a47e3c;}

.control-group.error .fileupload .uneditable-input{color:#b94a48;border-color:#b94a48;}

.control-group.error .fileupload .fileupload-preview{color:#b94a48;}

.control-group.error .fileupload .thumbnail{border-color:#b94a48;}

.control-group.success .fileupload .uneditable-input{color:#468847;border-color:#468847;}

.control-group.success .fileupload .fileupload-preview{color:#468847;}

.control-group.success .fileupload .thumbnail{border-color:#468847;}

</style>
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <br>
            <ul class="alerts-list delete"></ul>
                <div class="widget-content-white glossed">
                    <div class="padded">
                        <table id="cities" class="table table-striped table-bordered table-hover datatable">
                          <thead>
                                <tr>
                                    <th class="col-md-3">أسم المستخدم</th>
                                    <th class="col-md-2">الأيميل</th>
                                    <th class="col-md-2">الصوره</th>
                                    <th class="col-md-2">خيارات</th>
                                </tr>
                          </thead>
                          <tbody>
                          @foreach ($tableData->getData()->data as $row)
                                <tr>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{!! $row->image !!}</td>
                                    <td>{!!$row->actions !!}</td>
                              </tr>
                              @endforeach
                              </tbody>
                          </table>
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
                            oTable = $('#cities').DataTable({
                                "processing": true,
                                "serverSide": true,
                                "responsive": true,
                                "deferLoading": {{ $tableData->getData()->recordsFiltered }},
                                "columns": [
                                  {data: 'username', name: 'username'},
                                  {data: 'email', name: 'email'},
                                  {data: 'image', name: 'image'},
                                  {data: 'actions', name: 'actions', orderable: false, searchable: false}
                                ]
                            });
});
</script>
<script src="{{ asset('/admin-ui/js/for_pages/table.js') }}"></script>
@endsection
