<script type="text/javascript">
$(document).ready(function () { 

            $('#class').on('change',function(e){
            var class_id = e.target.value;

            $(".parcours").css ({"display":"block"});

            $.ajax({
            type: "GET",
            url: "{{ url() }}/ajax-parcour?class_id="+class_id,
                success: function(data) {  

                    var subcat =  $('#parcours').empty();

                    subcat.append('<option value ="" disabled>Listes des parcours</option>');

                    $.each(data,function(create,subcatObj) {

                    var option = $('<option/>', {id:create, value:subcatObj});
                    subcat.append('<option value ="'+subcatObj+'">'+create+'</option>');

                    });
                }
            });
        });
});

$(document).ready(function () { 

            $('#parcours').on('change',function(e){
            var parcour_id = e.target.value;

            $(".ues").css ({"display":"block"});

            $.ajax({
            type: "GET",
            url: "{{ url() }}/ajax-ues?parcour_id="+parcour_id,
                success: function(data) {  

                    var subcat =  $('#ues').empty();

                    subcat.append('<option value ="" disabled selected>Listes des UE</option>');
                    

                    $.each(data,function(create,subcatObj) {

                    var option = $('<option/>', {codeUe:create, value:subcatObj});
                    subcat.append('<option value ="'+subcatObj+'">'+create+'</option>');

                    });
                }
            });
        });
});
</script>        