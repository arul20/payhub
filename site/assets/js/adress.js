jQuery(function($){
    
    var showAlert = function(){
        $('#errorContainer').toggle();
        $('<div class="alert alert-block alert-error fade in">'+
            '<a class="close" data-dismiss="alert">&times;</a>'+
            '<h4 class="alert-heading">Person / F&ouml;retag hittas ej</h4>'+
            'Kontrollera personnumret / Org.numret.'+
            '</div>').appendTo('#errorContainer');  
        $('#errorContainer').fadeIn('slow');

    };
    
    /**
     * Handle Ajax response
     */
    var handleJSONResponse = function(data){
        if(data == null){
            showAlert();
            $('#btnContinueKlarna').text('Fortsätt');
        }else{
            $('#inputFnamn').val(data.fname);
            $('#inputEnamn').val(data.lname);
            $('#inputCompany').val(data.company);
            $('#inputCareof').val(data.careof);
            $('#inputZip').val(data.zip);
            $('#inputCity').val(data.city);
            $('#inputStreet').val(data.street);
            $('#btnContinueKlarna').attr('class', 'btn btn-success');
            $('#btnContinueKlarna').text('Jag har granskat mina uppgifter');
            $('#btnContinueKlarna').unbind('click');
        }
    };
    
    /**
     * Control the function of the button click
     */
    $('#btnContinueKlarna').bind('click', function(e){
        e.preventDefault();
        $('#btnContinueKlarna').attr('data-loading-text', 'Laddar...');
        $('#btnContinueKlarna').text('Laddar...');
        
        var requestData = {
            inputPersnr:  $('#inputPersnr').val(),
            option: 'com_payhub',
            view: 'klarna',
            task: 'getAdress',
            format: 'raw',
            layout: 'json-address'
        };
        $.getJSON('index.php', requestData, function(data) {
            handleJSONResponse(data);
        });
    });
    
    
    
   
    
});