
	$('document').ready(function(){
        jQuery.validator.addMethod("validate_email",function(value, element) {


       if(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value ))
        {
           return true;
        }
        else
        {
          return false;
        }    
  },"Please enter a valid Email.");
		$("#reg-form").validate({
		rules:
        {
            uname: {
                required: true,
                minlength: 3
            },
            pwd: {
                required: true,
                minlength: 6,
                maxlength: 50
            },
            confpwd: {
                required: true,
                equalTo: '#pwd'
            },
            email: {
                required: true,
                email: true,
                validate_email: true
            },
            iagree:{
            	required: true
            }
        },
        messages:
        {
            uname: "Enter a Valid Username",
            pwd:{
                required: "Provide a Password",
                minlength: "Password Needs To Be Minimum of 6 Characters"
            },
            email: "Enter a Valid Email",
            confpwd:{
                required: "Retype Your Password",
                equalTo: "Password Mismatch! Retype"
            },
            iagree:{
            	required: "Check "
            }
        },
        submitHandler: submitForm
			});

	function submitForm()
    {
			var data = $("#reg-form").serialize();

        $.ajax({

            type : 'POST',
            url  : 'register.php',
            data : data,
            beforeSend: function()
            {
                $("#btn").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending');
            },
            success :  function(data)
            {
	           if(data==1)
	           {
	           		$("#err").fadeIn(1000, function(){


                        $("#err").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry username/email already registered !</div>');

                        $("#btn").html('<span class="glyphicon glyphicon-remove-sign"></span> &nbsp; Signup');
                          });
	           }
			else if(data=="Registered")
			{
				$("#btn").html('<span class="glyphicon glyphicon-ok"></span> SignUp Successful');

            $("#err").hide();


			}
			else{

			$("#err").fadeIn(1000, function(){

			$("#err").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

			$("#btn").html('<span class="glyphicon glyphicon-info-sign"></span> &nbsp; Signup');

			});

			}
            }
        });
       
	return false;
	}
	});
