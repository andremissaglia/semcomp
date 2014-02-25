var request;

window.onload=function() {

$("#form_contato").on("submit", function (e) {
    e.preventDefault();
    if(request){
        request.abort();
    }

    var form = $(this);
    //var inputs = form.find("input, textarea");
    var serializedData = form.serialize();
    form.hide();
    $('#enviando_contato').text("Enviando mensagem...");
    //inputs.prop("disabled",true);

    $.ajax({
        url: "./php/sendmail.php",
        type: "POST",
        data: serializedData,
        error: function(jqXHR, textStatus, errorThrown){
            $('#respostaFormContato').html('<p>Erro: '+textStatus+", " + errorThrown+"</p>");
        },
        success: function(data, textStatus, jqXHR){
            $('#respostaFormContato').html(data);
        },
        complete: function(jqXHR, textStatus){
            $('#formContatoModal').foundation('reveal', 'open');
            //inputs.prop("disabled",false);
            form.show();
            $('#enviando_contato').text("");
        }
    });

});


}