/**
 * @author Picasso Houessou houessoupicasso@yahoo.fr
 */
$(function(){
var confirmButton = $('#confirmButton') ;
var activateCode = $('#activateCode') ;
var resendCodeLink = $('#resendCodeLink') ;
var lg = null;
var lgInterm = window.location.href ;
lgInterm = lgInterm.split('&')[1];
lg = lgInterm.split('=')[1];
var displayError = $('#displayError') ;

function alertError(input)
{
	//var errorContent = $('#displayError');
	displayError.removeClass("d-none") ;
	displayError.text(input) ;
}
 function alertAjax(responseReceived)
{
	if (responseReceived.length)
	{
		var response = JSON.parse(responseReceived) ;
		if (response.state==false)
		{
			displayError.removeClass("text-success") ;
			displayError.addClass("text-danger") ;
			alertError(response.description) ;
			if (typeof response.redirect !="undefined" && response.redirect.length >5 )
			{
				window.location.replace(response.redirect ) ;
			}

		} else if (response.state==true)
		{
			displayError.removeClass("text-danger") ;
			displayError.addClass("text-success") ;
			alertError(response.description) ;
			//On peut alors rediriger
            if (typeof response.redirect !="undefined" &&  response.redirect.length >5 )
            {
            	alert("ddd");
            	window.location.replace(response.redirect ) ;
            }
		}
	}
}

confirmButton.on('click', function(e){
	e.preventDefault() ;
	var code = activateCode.val();
	if (code.length <=0 )
	{
		displayError.removeClass("text-success") ;
		displayError.addClass("text-danger") ;
		alertError("Entrer un code non vide"); activateCode.val('') ; displayError.removeClass("d-none") ; return;
	}
	if (code >255)
	{
		alertError ('Le code est invalide') ;
		activateCode.val('') ;
		return ;
	}
	$.post(
		//"controller/backend/confirmEmailBackend.php",
		"controller/confirmEmail.php",
		{
			lg: lg ,
			code: activateCode.val()
		},
		function (response){ 
			if (response.length)
			{
				alertAjax (response);
					
			}
		}
	);
})


resendCodeLink.on('click', function (e) {
	e.preventDefault();
	$.post(
		"controller/confirmEmail.php",
		{
			lg: lg ,
			resendCode: 'resendCode'
		},
		function (response){ alertAjax (response);
		}
	);


}) ;
	
	
});