function checkInputs(event) {
  // trim to remove the whitespaces
  let isValid = true;
  const nameEditValue = event.target[1].value.trim();
  const startDateEditValue = event.target[2].value;
  const cost = event.target[4].value;
  if (!cost) {
    cost = 0;
  }

  const costRes = validateCost(cost);

  //find today date
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  var yyyy = today.getFullYear();

  today = mm + "/" + dd + "/" + yyyy;

  if (nameEditValue === "") {
    setErrorFor(event.target[1], "Task name cannot be blank");
    isValid = false;
  } else {
    setSuccessFor(event.target[1]);
  }

  if (Date.parse(startDateEditValue) < Date.parse(today)) {
    setErrorFor(event.target[2], "This date passed");
    isValid = false;
  } else {
    setSuccessFor(event.target[2]);
  }

  if (!costRes) {
    setErrorFor(event.target[4], "Must enter only positive digits!");
    isValid = false;
  } else {
    setSuccessFor(event.target[4]);
  }

  if (!isValid) {
    event.stopImmediatePropagation();
  }
}

function setErrorFor(input, message) {
  const formGroup = input.parentElement;
  const small = formGroup.querySelector("small");
  //add error class
  formGroup.className = "form-group error";
  //add error message inside small
  small.innerText = message;
}

function setSuccessFor(input) {
  const formGroup = input.parentElement;
  formGroup.className = "form-group success";
}
