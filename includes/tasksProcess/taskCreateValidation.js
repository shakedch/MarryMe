const formCreate = document.getElementById("createForm");
const taskName = document.getElementById("name");
const taskCost = document.getElementById("createCost");
const taskStatus = document.getElementById("status");
const taskStartDate = document.getElementById("start_date");
const taskDueDate = document.getElementById("due_date");

const validateCost = (cost) => {
  const regex = /^[+]?\d+([.]\d+)?$/;
  const res = regex.test(cost);
  console.log(cost);
  console.log(res);

  if (!res) {
    return false;
  }
  return true;
};

formCreate.addEventListener("submit", (e) => {
  // e.preventDefault();
  checkInputsCreate(e);
});

function checkInputsCreate(e) {
  // trim to remove the whitespaces
  let isValid = true;
  const nameValue = taskName.value.trim();
  const statusValue = taskStatus.selectedIndex;
  const startDateValue = taskStartDate.value;
  const dueDateValue = taskDueDate.value;

  const cost = e.target[4].value;
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

  if (nameValue === "") {
    setErrorFor(taskName, "Task name cannot be blank");
    isValid = false;
  } else {
    setSuccessFor(taskName);
  }

  if (Date.parse(startDateValue) < Date.parse(today)) {
    setErrorFor(taskStartDate, "This date passed");
    isValid = false;
  } else {
    setSuccessFor(taskStartDate);
  }

  if (Date.parse(dueDateValue) < Date.parse(startDateValue)) {
    setErrorFor(taskDueDate, "Due date cannot start before start date");
    isValid = false;
  } else {
    setSuccessFor(taskDueDate);
  }

  if (!costRes) {
    setErrorFor(taskCost, "Must enter only positive digits!");
    isValid = false;
  } else {
    setSuccessFor(taskCost);
  }
  // statusValue <= 0
  if (statusValue <= 0) {
    setErrorFor(taskStatus, "Please choose status");
    isValid = false;
  } else {
    setSuccessFor(taskStatus);
  }

  if (!isValid) {
    e.preventDefault();
  }
  // e.preventDefault();
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
