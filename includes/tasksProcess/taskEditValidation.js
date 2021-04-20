function checkInputs(event) {
  // trim to remove the whitespaces
  let isValid = true;
  const nameEditValue = event.target[1].value.trim();
  const cost = event.target[4].value;
  if (!cost) {
    cost = 0;
  }

  const costRes = validateCost(cost);

  if (nameEditValue === "") {
    setErrorFor(event.target[1], "Task name cannot be blank");
    isValid = false;
  } else {
    setSuccessFor(event.target[1]);
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
