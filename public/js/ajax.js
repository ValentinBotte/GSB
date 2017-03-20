/**
 * Created by botte.v on 20/03/2017.
 */


$(function() {

    $("#lstVisiteur").change(function() {

        var idVisiteur = $("#lstVisiteur option:selected").val();

            $.get("http://127.0.0.1/GSB/public/afficher_valide_frais/getMois?idVisiteur=" + idVisiteur, function(data) {

                $('#lstMois').empty();

                for(var i = 0; i < data.length; i++){
                    $('#lstMois').append(
                        $('<option></option>').val(data[i]).html(data[i])
                    );
                }


            });



    });


});