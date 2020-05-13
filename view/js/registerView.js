/*console.log(moment()._d);
$(function(){
	console.log( moment()) ;
});
document.readyState
*/
/**
 * @author Picasso Houessou houessoupicasso@yahoo.fr
 */
$(function(){
// Tableau suivant la syntaxe input -> id de l'input (sélecteur jquery correspondant)
var tableau = {
	lastName : '#lastName',
	firstName : '#firstName',
	email : '#email',	
	dateOfBirth : "#dateOfBirth",
	nationality : '#nationality',
	countryOfResidence: "#countryOfResidence",
	cityOfResidence: "#cityOfResidence",
	gender: "#gender",		
	photoOfProfil: "#photoOfProfil" , 
	aboutCompetence: "#aboutCompetence" ,
	password : "#password", 
	samePassword : "#samePassword" 
}; 

//TAILLE MAXIMALE DES STRING 
const MAX_VALUE = 200;

/**
* Pour gerer le premier formulaire d'inscription
* Enregistre les données dans un local storage
*/
var registerFormFirst = $('#registerFormFirst') ;
var registerFormSecond = $('#registerFormSecond') ;
var previousButton = $('#previousButton') ;
var lastName = null;
var firstName = null ;
var email = null ;
var dateOfBirth = null ;
var nationality = null; 
var countryOfResidence = null
var cityOfResidence = null  ; 
var gender = null ;

var photoOfProfil = null  ; 
var aboutCompetence = null; 
var password = null ;
var samePassword = null ;
var allowedPhotoTypes = ['png', 'jpg', 'jpeg', 'gif'] ;
var errorInputForm = $('#errorInputForm') ;
errorInputForm.hide();
/*
errorInputForm.css({
	"position": "fixed !important",
	"right" : "5px ",
	"top" : "0px",
	"z-index" : "5",
	"background-color" : "crimson",
	"color" : "black"
});
*/

$("#alertErrorCloseButton").click(function(){
	$(this).parent().hide();

});
/*
function alertError(input) 
{
	var errorContent = $('#errorInputForm .toast-body');
	errorContent.text(input) ;

	$('#errorInputForm').show();
	
}
*/
function alertError(input) 
{
	var errorContent = $('#errorInputForm p');
	errorContent.text(input) ;
	errorInputForm.removeClass('d-none') ;
	errorInputForm.show();
	//errorInputForm.hide(5000,'linear') ;
	//errorInputForm.fadeOut(5000, "linear");
}

function alertAjax(responseReceived)
{
	
	if (responseReceived.length)
	{
		var response = JSON.parse(responseReceived) ;
		if (response.state==false)
		{
			alertError(response.description) ;
			if (typeof response.redirect!="undefined" && response.redirect.length >5 )
			{
				//localStorage.clear();
				window.location.replace(response.redirect ) ;
			}
		} else if (response.state==true)
		{	
			alertError (response.description) ;
			if (typeof response.redirect !="undefined" && response.redirect.length >5 )
			{
				//localStorage.clear();
				window.location.replace(response.redirect ) ;
			}
		}
	}
}
/*
* Remplir automatiquement les formulaires 
*/
(function (){
	//registerFormSecond.removeClass("d-none") ;
	//registerFormSecond.hide() ;
	
	for (var key in tableau)
	{
		
		if ( localStorage.getItem(key)!== null && localStorage.getItem(key)!== undefined  )
		{
			$(tableau[key]).val(localStorage.getItem(key)) ;			
		}
	}
	if (localStorage.length >=8)
	{
		lastName =  $('#lastName').val() ;
		firstName  = $('#firstName').val();
		email = $('#email').val() ; 
		nationality = $('#nationality').val() ;
		dateOfBirth = $('#dateOfBirth').val()  ;	
		countryOfResidence = $('#countryOfResidence').val() ;
		cityOfResidence = $('#cityOfResidence').val() ;
		gender = $('#gender').val() ;

		registerFormFirst.addClass("d-none") ;
		registerFormSecond.removeClass("d-none") ;		
		return ;
	}
}) () ;

/* A SUPPRIMER
if (i(formFirstValues) && formFirstValues > 10) 
{
	for (var id in tableau)
	{
		$(tableau[id]).val()
	}
}
*/

//Plour le premier formulaire
registerFormFirst.submit(function (e){
	e.preventDefault() ;
	lastName =  $('#lastName').val() ;
	firstName  = $('#firstName').val();
	email = $('#email').val() ; 
	nationality = $('#nationality').val() ;
	dateOfBirth = $('#dateOfBirth').val()  ;	
	countryOfResidence = $('#countryOfResidence').val() ;
	cityOfResidence = $('#cityOfResidence').val() ;
	gender = $('#gender').val() ;

	/* verification */
	if (lastName.length> MAX_VALUE )
	{
		alert ('Erreur au niveau du Nom') ;
		return ;
	}
	if (firstName.length > MAX_VALUE )
	{
		alertError('Prenom') ;
		return ;
	}
	if(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email) != true)
	{
		alertError('Email') ;
		return ;
	}
	if ( nationality=="" || nationality.length > MAX_VALUE)
	{
		alertError('nationality') ;
		return ;
	}
	if (dateOfBirth)
	{		
		//var inputDate = moment (dateOfBirth);
		//var currentYear = moment.year() ;
		//if inputDate.
	}
	if (countryOfResidence.length> MAX_VALUE)
	{
		alertError('Pays de Residence') ;
		return ;
	}
	if (cityOfResidence.length>MAX_VALUE)
	{
		alertError('Ville de residence ') ;
		return ;
	}
	if( gender!=0 && gender!=1)
	{
		alertError("Sexe") ;
		return ;
	}
	localStorage.setItem('lastName', lastName ) ;
	localStorage.setItem('firstName', firstName) ;	
	localStorage.setItem ('email', email) ;
	localStorage.setItem('dateOfBirth' , dateOfBirth) ;
	localStorage.setItem('nationality', nationality) ;
	localStorage.setItem('countryOfResidence', countryOfResidence) ;
	localStorage.setItem('cityOfResidence', cityOfResidence) ;
	localStorage.setItem('gender', gender) ;

	registerFormFirst.addClass('d-none');	
	registerFormSecond.removeClass('d-none');
}) ;

// Pour le deuxime formulaire
registerFormSecond.submit(function (e){
	e.preventDefault() ;
	photoOfProfil = document.getElementById('photoOfProfil') ;
	//photoOfProfil = $('#photoOfProfil')[0] ; 
	var photoOfProfilFiles = photoOfProfil.files ;
	aboutCompetence = $('#aboutCompetence').val()  ;
	password = $('#password').val ();
	samePassword = $('#samePassword').val() ;
	localStorage.setItem('password', password ) ;
	localStorage.setItem('samePassword', samePassword) ;	
	localStorage.setItem ('aboutCompetence', aboutCompetence) ;
	
	if (photoOfProfilFiles.length == 1 && photoOfProfil)
	{
		var photoOfProfilType , photoOfProfilSize;
		photoOfProfilType = photoOfProfilFiles[0].name.split('.');
		photoOfProfilType = photoOfProfilType[photoOfProfilType.length -1] ;
		photoOfProfilType = photoOfProfilType.toLowerCase();
		
		if (allowedPhotoTypes.indexOf(photoOfProfilType) != -1)
		{
			photoOfProfilSize = photoOfProfilFiles[0].size ;
			if (photoOfProfilSize > 2000000)
			{
				alertError('photo trop grande. Sa taille est '+( photoOfProfilSize/1000000) +'Mo\n Ne doit pas dépasser 2Mo') ;
				return ;
			}		
		}
		else 
		{
			alertError('Extension de la photo') ;
			return ;			
		}	
	}
	if (aboutCompetence.length<300 || aboutCompetence.length>1000)
	{
		alertError(aboutCompetence) ;
		return ;
	}
	if ( (password.length !== samePassword.length) || (password != samePassword)  && /^(.*\d+.*[A-Z]+.*[a-z]+.*){8,20}$/.test(password) != true)
	{
		alertError('Mot de passes') ;
		return ;
	}
	
	var dataToSend = new FormData() ;
	dataToSend.append('lastName', lastName) ;
	dataToSend.append('firstName', firstName) ;
	dataToSend.append('email', email) ;
	dataToSend.append('dateOfBirth', dateOfBirth) ;
	dataToSend.append ('nationality', nationality) ;
 ;	dataToSend.append ('countryOfResidence', countryOfResidence) ;
	dataToSend.append('cityOfResidence' , cityOfResidence) ;
	dataToSend.append('gender', gender);
	dataToSend.append('photoOfProfil' , photoOfProfil.files[0]) ;
	dataToSend.append('aboutCompetence', aboutCompetence ) ;
	dataToSend.append('password', password) ;
	dataToSend.append('samePassword', samePassword) ;

	$.ajax({
		url : "controller/backend/registerBackend.php" ,
		type: 'POST',
		contentType: false ,
		processData: false,
		data: dataToSend,
		success : function(response) { alertAjax(response);}
	}); 
	
});

// Pour le bouton retour
previousButton.click(function(e){
	e.preventDefault();
	registerFormSecond.addClass('d-none');
	registerFormFirst.removeClass('d-none') ;
}) ;

});