<script src="https://www.google.com/recaptcha/api.js?render=6Le8Ga4UAAAAAKuaIahDGCViusZE9aubVEpcmGk-"></script>
<script type="text/javascript">

        jQuery(document).ready(function () {
            var currentTime = new Date();
            var month = currentTime.getMonth();
            var day = currentTime.getDate();
            var year = currentTime.getFullYear();
            jQuery('#demo2').datepicker({
                minDate: new Date(year, month, day),
                dateFormat: 'mm-dd-yy',
                constrainInput: true,
                changeMonth: true,
                changeYear: true
            });
        });
    </script>

<form action="quote-email.php" method="post" class="moving-form" id="move_type_form" style="  z-index: 1;">

<div class="row">
    
    <div class="col-sm-6">
<input class="main-inp" type="text" name="first_name" id="first_name" placeholder="First Name" required>
    </div>
    <div class="col-sm-6">
<input class="main-inp" type="text" name="last_name" id="last_name" placeholder="Last Name" required>
    </div>
    
    <div class="col-sm-6">
<input class="main-inp" type="number" name="from" id="from" placeholder="Moving From" required>
    </div>
    <div class="col-sm-6">
<input class="main-inp" type="number" name="to" id="to" placeholder="Moving To" required>
    </div>
    
    <div class="col-sm-6">
<input type="text" class="main-inp" name="date_of_move" id="demo2" placeholder="Moving Date" required>
    </div>
    <div class="col-sm-6">
<input class="main-inp" type="text" name="phone" id="phone" placeholder="Phone">
    </div>
    
    
    <div class="col-sm-12">
<input class="main-inp" type="text" name="email" placeholder="Email" id="email">
    </div>
    
    <div class="col-sm-8">
  <div class="ui selection dropdown mdrop main-inp">
    <i class="dropdown icon"></i>
    <div class="default text">Select</div>
    <div class="menu">
        <div class="item" data-value="1">Studio</div>
        <div class="item" data-value="2">1 Bedroom</div>
        <div class="item" data-value="5">2 Bedroom</div>
        <div class="item" data-value="8">3 Bedroom</div>
        <div class="item" data-value="10">4 Bedroom</div>
        <div class="item" data-value="11">5+ Bedroom</div>
        <div class="item" data-value="3">Small Office</div>
        <div class="item" data-value="6">Medium Office</div>
        <div class="item" data-value="12">Large Office</div>
        <div class="item" data-value="4">Small storage (5x5, 5x8, 5x10)</div>
        <div class="item" data-value="7">Medium storage (10x10, 10x15)</div>
        <div class="item" data-value="9">Large storage (10x20)</div>
    </div>
	<input type="hidden" name="size_of_move" onChange="$('#move_type_form').valid()" id="movesize"  required>
</div>
	
	
	</div>
    
    <div class="col-sm-4">
    <input class="sub-inp" type="submit" value="Submit">
</div>
</div>
    
</form>
 
<script type="text/javascript">
	$(document) .ready(function(){
	$.validator.addMethod("zipcode", function(value, element) {
  return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
}, "Please provide a valid zipcode.");
$.validator.addMethod("validemail", function(value, element) {
  return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value);
}, "Please enter a valid email.");
$.validator.setDefaults({ ignore: '' });

			$("#move_type_form").validate({
				rules: {
			from: {
			  required: true,
			  maxlength: 5,
			  minlength: 5,
			  zipcode: true
			},
			to: {
			  required: true,
			  maxlength: 5,
			  minlength: 5,
			  zipcode: true,
			},
					phone: {
						required: true,
					},
					email: {
      					required: true,
      					email: true,
						validemail:true,
    				}
				}
			});
		});
		 $(window).load(function()
    {
       var phones = [{ "mask": "(###) ###-###"}, { "mask": "(###) ###-####"}];
        $('#phone').inputmask({ 
            mask: phones, 
            greedy: false, 
            definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
    });
	
	
	    $('#move_type_form').submit(function(event) {
        // we stoped it
        event.preventDefault();
        $(this).children('input[type=submit]').prop('disabled', true);

        if($("#move_type_form").valid()){
  var from = $('#from').val();
  var to = $("#to").val();
    var size_of_move = $('#size_of_move').val();
  var date_of_move = $("#demo2").val();
    var first_name = $('#first_name').val();
  var last_name = $("#last_name").val();
    var phone = $("#phone").val();
    var email = $("#email").val();


        // needs for recaptacha ready
        grecaptcha.ready(function() {
            // do request for recaptcha token
            // response is promise with passed token
            grecaptcha.execute('6Le8Ga4UAAAAAKuaIahDGCViusZE9aubVEpcmGk-', {action: 'create_comment'}).then(function(token) {
                // add token to form
        $('#move_type_form').prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
        $.post("quote-email.php",{from: from, to: to, size_of_move: size_of_move, date_of_move: date_of_move, first_name: first_name, last_name: last_name, phone: phone, email: email, token: token}, function(result) {
          console.log(result);
          if(result.success) {
                    window.location= result.url;
            //alert('Thanks for posting comment.')
          } else {
            $(this).children('input[type=submit]').prop('disabled', false);
            alert('No Spamming Please!')
          }
        });
            });;
        });
  }
});
	</script>