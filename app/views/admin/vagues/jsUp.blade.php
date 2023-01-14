{{ HTML::script('public/assets/script/jquery-3.6.0.js') }}
{{ HTML::script('public/assets/script/validator.js') }}
<script type="text/javascript">
      function refresh() {
        // to current URL
        window.location='{{ URL::current() }}';
      }
        $('#myForm2').submit(function(event) {
          event.preventDefault();
          $('#resultajax2').append('<img src="{{ url() }}/public/assets/images/loader.gif" alt="{{Lang::get($path.'.please_wait')}}" />');
          $('#myForm2 input.btn').hide();
           $.ajax({
            type: 'POST',
            url: '{{ route("vague_update",$getvague->id) }}',
            data: $(this).serialize(),

            success: function(data) {
                              
                if(data == 'true') {   
                  $('#resultajax2').html("<div class='alert alert_success'><strong class=''><bdi>Succès!</bdi> {{ Lang::get($path.'.was_update') }}</strong></div>");
                  $('#myForm2 input.btn').show();
                  setInterval(refresh, 800);
                 }

                if(data == 'false') {
                  $('#resultajax2').html("<div class='alert alert_danger'><strong class=''><bdi>Erreur!</bdi> {{ Lang::get($path.'.error_please_try_again') }}</strong></div>");
                  $('#myForm2 input.btn').show();
                }
                                     
              }

            });
                          
          });

        function refresh() {
            // to current URL
            window.location='{{ URL::current() }}';
          }
</script>
