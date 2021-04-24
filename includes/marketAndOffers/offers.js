var dialog = document.querySelector('dialog');
/* dialogPolyfill.registerDialog(dialog);*/

/*
// offers_form validation
function validate(){
   var price=document.forms["offers_form"]["price"].value;
   alert (price);
   if (price<0){
      alert("must be big than 1");
   }
   

}*/



const form = document.getElementById('offers_form');
const offerName = document.getElementById('name'); 
const price = document.getElementById('price');
const description = document.getElementById('description');
const validDate = document.getElementById('valid_date');



form.addEventListener('submit', (e) => {
	checkInputs(e);
});

function checkInputs(e) {
	// trim to remove the whitespaces
	let isValid = true;
	const nameValue = offerName.value.trim();
	const priceValue = price.value.trim();
	const descriptionValue = description.value.trim();
	const validDateValue = validDate.value;

	var notNumber = /[a-zA-Z]/g;

	//find today date
	var today = new Date();
	var dd = String(today.getDate()).padStart(2, '0');
	var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	var yyyy = today.getFullYear();

	today = mm + '/' + dd + '/' + yyyy;
	

	//name validation
	if(nameValue === '') {
		setErrorFor(offerName, 'Offer name cannot be blank');
		isValid = false;
	} else {
		setSuccessFor(offerName);
	}

	//price validation
	if(priceValue === '') {
		setErrorFor(price, 'price cannot be blank');
		isValid = false;

	//לא כולל סימני פיסוק
	} else if (notNumber.test(priceValue)) {
		setErrorFor(price, 'price must contains numbers only');
		isValid = false;
	} else if (parseInt(priceValue) < 1) {
		setErrorFor(price, 'price must be bigger than 1');
		isValid = false;
	}else {
		setSuccessFor(price);
	}

	//description validation
	if(descriptionValue === '') {
		setErrorFor(description, 'description cannot be blank');
		isValid = false;
	} else {
		setSuccessFor(description);
	}

	//date validation
	if(validDateValue === '') {
		setErrorFor(validDate, 'valid date cannot be blank');
		isValid = false;
	} else if ( Date.parse(validDateValue) < Date.parse(today) ){
		setErrorFor(validDate, 'valid date passed');
		isValid = false;

	} else {
		setSuccessFor(validDate);
	}

	//checkif all the input are correct
	if(!isValid){
		e.preventDefault();
	}
   
}

function setErrorFor(input, message) {
	const formGroup = input.parentElement;
	const small = formGroup.querySelector('small');

   //add error class
	formGroup.className = 'form-group error';

   //add error message inside small
	small.innerText = message;
}

function setSuccessFor(input) {
	const formGroup = input.parentElement;
	formGroup.className = 'form-group success';
}
	