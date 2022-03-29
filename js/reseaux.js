//get elements and add event listeners to social media buttons
  
document.addEventListener("DOMContentLoaded", function(event) {
    pinterest=document.getElementById('pinterest');    
    facebook=document.getElementById('facebook');
    linkedin=document.getElementById('linkedin');
    twitter=document.getElementById('twitter');
    mail=document.getElementById('mail');
    submit_btn=document.getElementById('send');
    email_form = document.getElementById('email-form');

    pinterest.addEventListener('click', function(){
        var_dump("clicked on pinterest");
    })
    facebook.addEventListener('click', function(){
        var_dump("clicked on facebook");
    })
    linkedin.addEventListener('click', function(){
        var_dump("clicked on LinkedIn");
    })
    twitter.addEventListener('click', function(){
        var_dump("clicked on twitter");
    })
    mail.addEventListener('click', function(){
        modal.style.display = "block";
    })
    submit_btn.addEventListener('click', function(){
        email_form.submit();
    })
});


  