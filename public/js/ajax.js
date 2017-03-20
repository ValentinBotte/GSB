/**
 * Created by botte.v on 20/03/2017.
 */


$(function() {

    $("#lstVisiteur").change(function() {

        var idVisiteur = $("#lstVisiteur option:selected").val();

            var url = {{url('afficher_valide_frais')}} + "/getMois?idVisiteur=" + idVisiteur;

            $.get("{{url('getMois?idVisiteur=" + idVisiteur, function(data) {

                $('#lstMois').empty();

                for(var i = 0; i < data.length; i++){
                    $('#lstMois').append(
                        $('<option></option>').val(data[i]).html(data[i])
                    );
                }


            });



    });


});