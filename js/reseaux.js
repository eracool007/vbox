//get elements and add event listeners to email recipe
  
document.addEventListener("DOMContentLoaded", function(event) {
    
    mail=document.getElementById('mail');
    submit_btn=document.getElementById('send');
    email_form = document.getElementById('email-form');
    
    mail.addEventListener('click', function(){
        modal.style.display = "block";
    });
    submit_btn.addEventListener('click', function(){
        email_form.submit();
    });
});


  