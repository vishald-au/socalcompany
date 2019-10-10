<script src="https://www.google.com/recaptcha/api.js?render=6Le8Ga4UAAAAAKuaIahDGCViusZE9aubVEpcmGk-"></script>
<div class="row">
    <form id="form1" method="post" action="contact-submit.php">
        <div class="col-sm-12 col-md-4"><input class="main-inp" type="text" name="cname" id="cname" placeholder="Full Name" required></div>    
        <div class="col-sm-12 col-md-4"><input class="main-inp" type="email" name="cemail" id="cemail" placeholder="Email" required></div>    
        <div class="col-sm-12 col-md-4"><input class="main-inp" type="text" name="cphone" id="cphone" placeholder="Phone" required></div>    
        <div class="col-sm-12 col-md-12"><textarea class="main-inp" type="text" name="cmessage" id="cmessage" placeholder="Message" required></textarea></div>
        
        <div class="col-sm-12 col-md-4 col-md-offset-4"><input class="sub-inp"id="form-e" name="form-e" value="Submit" type="submit"></div>
    </form>
</div>

<script>
        $('#form1').submit(function(event) {
        // we stoped it
        event.preventDefault();

        var cname = $('#cname').val();
        var cemail = $("#cemail").val();
        var cphone = $('#cphone').val();
        var cmessage = $('#cmessage').val();


        // needs for recaptacha ready
        grecaptcha.ready(function() {
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('6Le8Ga4UAAAAAKuaIahDGCViusZE9aubVEpcmGk-', {action: 'create_comment'}).then(function(token) {
                // add token to form
                $('#form1').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
        $.post("contact-submit.php",{cname: cname, cemail: cemail, cphone: cphone, cmessage: cmessage, token: token}, function(result) {
          console.log(result);
          if(result.success) {
                    window.location= result.url;
            //alert('Thanks for posting comment.')
          } else {
            alert('You are spammer ! Get the @$%K out.')
          }
        });
            });;
        });
  
});
</script>
