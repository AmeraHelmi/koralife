(function() {
    /* delete item*/
    $(document.body).on('click', '.deleteForm', function(e) {
        e.preventDefault();
        if (window.confirm("Are you sure you want to delete this item?"))
        {
            var self = $(this);
            $(this).button({loadingText: 'deleting...'});
            $(this).button('loading');

            $.ajax({
                url: self.closest('form').attr('action') ,
                type: "POST",
                data: self.serialize(),
                success: function(res){
                    self.button('reset');
                    $('.delete').append(
                      '<li>\
                          <div class="alert alert-danger alert-dismissable">\
                              <i class="icon-remove-sign"></i> <strong>Opps!</strong> something went wrong.\
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                          </div>\
                      </li>');
                },
                error: function(){
                    self.button('reset');
                    if(oTable != undefined)

                    $('.delete').append(
                        '<li>\
                            <div class="alert alert-success alert-dismissable">\
                                <i class="icon-check-sign"></i> Element has been successfully deleted!\
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\
                            </div>\
                        </li>');
                        oTable.ajax.reload();
                        oTable.draw();
                }
            });
        }

  });


}).call(this);
