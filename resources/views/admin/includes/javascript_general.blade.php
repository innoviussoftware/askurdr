<!-- Bootstrap core JavaScript-->

<script src="{!! asset('public/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>



<!-- Core plugin JavaScript-->

<script src="{!! asset('public/admin_assets/vendor/jquery-easing/jquery.easing.min.js') !!}"></script>



<!-- Custom scripts for all pages-->

<script src="{!! asset('public/admin_assets/js/sb-admin-2.min.js') !!}"></script>







<!-- DataTable -->

<script src="{{ asset('public/admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('public/admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>





<!-- Confirm Box -->

<script src="{{ asset('public/admin_assets/js/bootbox.min.js')}}"></script>



<script src="{{ asset('public/admin_assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>



<script>

$(document).ready(function () {

    $('.select2').select2();



    timer = setTimeout(function () {

        $('.alert_msg').hide();

    }, 6000);



    timer = setTimeout(function () {

        $('.alert-danger').hide();

    }, 6000);

    

});



function confirm_alert(url, name) {



    bootbox.confirm({

        title: '',

        message: '<h5><i class="fa fa-remove text-danger"></i>&nbsp;&nbsp;' + name + '</h5>',

        buttons: {

            cancel: {

                label: '<i class="fa fa-times"></i> Cancel'

            },

            confirm: {

                label: '<i class="fa fa-check"></i> Confirm'

            }

        },

        callback: function (result) {

            if (result == true) {

                window.location.replace(url);

            }

        }

    });

}



$('body').on('change', '.master_checkbox', function () {

  var master_checkbox = $(this);

  var closest_form = master_checkbox.closest('form');

    if (master_checkbox.is(':checked')) {

        closest_form.find("input[type=checkbox]").prop('checked', true);

    } else {

        closest_form.find("input[type=checkbox]").prop('checked', false);

    }

});





$('body').on('change', '.bulk_action_input', function () {

    var action_type = $(this).val();

    var form_id = $(this).attr('data-id');

    var selected_form = $('#'+form_id);

    if(selected_form.find("input:checkbox:checked").length == 0){

      if(action_type == 1)

      {

        var select_message = 'Please select at least one record to active.';

      }

      if(action_type == 2)

      {

        var select_message = 'Please select at least one record to inactive.';

      }

      if(action_type == 3)

      {

        var select_message = 'Please select at least one record to delete.';

      }

      bootbox.alert('<h4><b>'+select_message+'</b></h4>');

      $('.bulk_action_input').val('');

      return false;

    }

    $('#action_type').val(action_type);

    if(action_type == 1)

    {

      var ask_message = '<b>Are you sure you want to active ?</b>';

    }

    if(action_type == 2)

    {

      var ask_message = '<b>Are you sure you want to inactive ?</b>';

    }

    if(action_type == 3)

    {

      var ask_message = '<b>Are you sure you want to delete ?</b>';

    }



      bootbox.confirm({

          title: '',

          message: ask_message,

          buttons: {

              cancel: {

                  label: '<i class="fa fa-times"></i> Cancel'

              },

              confirm: {

                  label: '<i class="fa fa-check"></i> Confirm'

              }

          },

          callback: function (result) {

              if (result == true) {

                  // $('.bulk_delete_form').submit();

                  selected_form.submit();

              }

          }

      });

  });



$(function() {

          

            $("body").on("change",".medicines_change", function(){

              

                      var id=$(this).attr('id');

                      

                      $('.disprecord').addClass(id);



                      var medicnes_id = $(this).val();

                      

                      var count=$(this).data('count');



                      var details = '<?php echo URL::to('admin/medicines_record'); ?>';



                      $.ajax({

                               type:'get',

                               url:details,

                               data: {

                                medicnes_id: medicnes_id,

                                count:count,

                                id:id

                              },

                               success:function(data){

                                

                                          var json = $.parseJSON(data);

                                          console.log(json);

                                          $('.'+json.id).find("#dose"+count).val(json.dose);

                                          $('.'+json.id).find("#route"+count).val(json.route);

                                          $('.'+json.id).find("#frequency1"+count).val(json.dose);

                                          $('.'+json.id).find("#frequency2"+count).val(json.dose);

                                          $('.'+json.id).find("#frequency3"+count).val(json.dose);

                                          $('.'+json.id).find("#duration"+count).val(json.dose); 

                                          $('.'+json.id).find("#units"+count).val(json.unit);  

                                          

                                

                                

                              }

                      });

            });

  });



</script>

