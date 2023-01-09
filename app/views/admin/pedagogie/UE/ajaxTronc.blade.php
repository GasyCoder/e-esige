
<script type="text/javascript">
      
        $('#myForm').submit(function(event) {

          event.preventDefault();

          $('#resultajax').append('<img src="{{ url() }}/public/assets/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');

          $('#myForm input.btn').hide();

          
           $.ajax({
            type: 'POST',
            url: '{{ route("saveUETronc", $class->id) }}',
            data: $(this).serialize(),

            success: function(data) {
                                
                if(data == 'true') {   
                  $('#resultajax').html("<div class='alert alert_success'><strong class=''><bdi>Succès!</bdi> {{ Lang::get($path.'.add_successfully') }}</strong><button type='button' class='dismiss la la-times' data-dismiss='alert'></button></div>");
                  $('#myForm input.btn').show();
                  //setInterval(refresh, 400);
                 }

                if(data == 'false') {
                  $('#resultajax').html("<div class='alert alert_danger'><strong class=''><bdi>Erreur!</bdi> {{ Lang::get($path.'.error_please_try_again') }}</strong></div>");
                  $('#myForm input.btn').show();
                  setInterval(refresh, 300);
                }
                                     
              }

            });
                          
          });

          function refresh() {
            // to current URL
            window.location='{{ URL::current() }}';
          }

</script>