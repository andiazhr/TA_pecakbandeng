$(document).ready(function() {

    $('select[name="id_provinsi"]').on('change', function(){
        var provinceId = $(this).val();
        if(provinceId) {
            console.log(provinceId);
            $.ajax({
                url: 'kota/'+provinceId,
                type:'GET',
                dataType:'json',
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {
                    console.log(data);

                    $('select[name="id_kota"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="id_kota"]').append('<option value="'+ key +'">' + value + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="id_kota"]').empty();
        }

    });

});