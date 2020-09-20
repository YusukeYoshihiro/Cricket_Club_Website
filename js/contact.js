$(document).ready(function(){

     
    $('#contact-submit').click(function() {            

        //get users list (receiving info)
        console.log("init");
        $.ajax({      
            //127.0.0.1      
            url: "http://localhost:3000/php/contact.php",
            type: "POST",
            data: {
                name: $('#contact-form_name').val(),				   
                email: $('#contact-form_email').val(),
                title: $('#contact-form_subject').val(),
                msg: $('#contact-form_message').val() },			   
            success: function(result) {
                console.log("result");
                
                $('#result-contact-msg').html(result);
               

            
            },
            error: function(error){
                console.log(error);

                $('#result-error-contact-msg').html(result);
            }

        });

        console.log("end");

    });

    $('#contact-newsletter-button').click(function() {          

    //get users list (receiving info)
    console.log("init");
    $.ajax({      
        //127.0.0.1      
        url: "http://localhost:3000/php/newsletter.php",
        type: "POST",
        data: {
            name: $('#contact-newsletter_name').val(),				   
            email: $('#contact-newsletter_email').val()},			   
        success: function(result) {
            console.log("result");
            
            $('#result-newsletter-msg').html(result);
           

        
        },
        error: function(error){
            console.log(error);

            $('#result-newsletter-error-msg').html(result);
        }

    });

    console.log("end");

    });

    $('#contact-newsletter-button_footer').click(function() {          

        //get users list (receiving info)
        console.log("init");
        $.ajax({      
            //127.0.0.1      
            url: "http://localhost:3000/php/newsletter.php",
            type: "POST",
            data: {
                name: $('#contact-newsletter_name_footer').val(),				   
                email: $('#contact-newsletter_email_footer').val()},			   
            success: function(result) {
                console.log("result");
                
                $('#result-newsletter-msg_footer').html(result);
               
    
            
            },
            error: function(error){
                console.log(error);
    
                $('#result-newsletter-error-msg_footer').html(result);
            }
    
        });
    
        console.log("end");
    
        });

        $('#home-newsletter-button').click(function() {          

            //get users list (receiving info)
            console.log("init");
            $.ajax({      
                //127.0.0.1      
                url: "http://localhost:3000/php/newsletter.php",
                type: "POST",
                data: {
                    name: $('#home-newsletter_name').val(),				   
                    email: $('#home-newsletter_email').val()},			   
                success: function(result) {
                    console.log("result");
                    
                    $('#home-result-newsletter-msg').html(result);
                   
        
                
                },
                error: function(error){
                    console.log(error);
        
                    $('#home-result-newsletter-error-msg').html(result);
                }
        
            });
        
            console.log("end");
        
            });

}); 
