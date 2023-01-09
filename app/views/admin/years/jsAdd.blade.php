{{ HTML::script('public/assets/script/jquery-3.6.0.js') }}
{{ HTML::script('public/assets/script/validator.js') }}
<script type="text/javascript">
      
        $('#myForm').submit(function(event) {

          event.preventDefault();

          $('#resultajax').append('<img src="{{ url() }}/public/assets/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');

          $('#myForm input.btn').hide();

          
           $.ajax({
            type: 'POST',
            url: '{{ route("storeYear") }}',
            data: $(this).serialize(),

            success: function(data) {
                                
                if(data == 'true') {   
                  $('#resultajax').html("<div class='alert alert_success'><strong class=''><bdi>Succès!</bdi> {{ Lang::get($path.'.add_successfully') }}</strong></div>");
                  $('#myForm input.btn').show();
                  setInterval(refresh, 800);
                 }

                if(data == 'false') {
                  $('#resultajax').html("<div class='alert alert_danger'><strong class=''><bdi>Erreur!</bdi> {{ Lang::get($path.'.error_please_try_again') }}</strong></div>");
                  $('#myForm input.btn').show();
                  setInterval(refresh, 900);
                }
                                     
              }

            });
                          
          });

          function refresh() {
            // to current URL
            window.location='{{ URL::current() }}';
          }

</script>