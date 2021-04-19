function getStartDateTask(value) {
  var x = (document.getElementById("due_date").min = value);
}

//form disabled inputs by click edit
$(document).ready(function () {
  $(document).on("click", ".information", function (event) {
    var isDisableInput = $("input").prop("disabled");
    var isDisableSelect = $("select").prop("disabled");
    var isDisableTextarea = $("textarea").prop("disabled");
    $(".nameDiv").hide();

    if (
      isDisableInput == false &&
      isDisableSelect == false &&
      isDisableTextarea == false
    ) {
      $("input").prop("disabled", true);
      $("select").prop("disabled", true);
      $("textarea").prop("disabled", true);

      $(".updatetask").hide();
      $(".edit").toggle();
    }
  });
});

$(document).ready(function () {
  $(".updatetask").hide();

  $(document).on("click", ".edit", function (event) {
    $("input").removeAttr("disabled");
    $("select").removeAttr("disabled");
    $("textarea").removeAttr("disabled");
    $(".nameDiv").show();

    $(".edit").hide();

    //show update button
    $(".updatetask").toggle();

    event.preventDefault();
  });

  $("form.ajax").submit(function (event) {
    var that = $(this); //form.ajax
    var url = that.attr("action"); //"updateTask.php"
    var type = that.attr("method"); //post
    data = {}; // array value

    //form.ajax find name= name name=email
    that.find("[name]").each(function (value) {
      var that = $(this); //this name
      var name = that.attr("name"); //name=email
      var value = that.val(); // value of input

      data[name] = value; //name:uri email:uri@test.com
    }); //end of that find

    //ajax: send the data to updateTask.php
    $.ajax({
      url: url, //var url in the top of the script
      type: type, //var type in the top of the script
      data: data,
      success: function (response) {
        //here we can put what we want after the submit success
        //console.log(data);
        if (response == 1) {
          $(".updatetask").text("Updating....");
          $(".modal-body").after(
            '<div class="alertUpdate alert-success" role="alert">Update task success!</div>'
          );
          setTimeout(function () {
            location.reload();
          }, 1200);
        } else {
          $(".modal-body").after(
            '<div class="alertUpdate alert-danger divmsg" role="alert">Something went wrong..</div>'
          );
          setTimeout(function () {
            $(".divmsg").hide();
          }, 3000);
        }
      }, //end of success
    }); //end of ajax

    event.preventDefault();
    //}//end of else
  });
}); // end of ready

// !!!!!validations dont work

// Validations
// const validateCost = (event) => {
//   const cost = event.target[4].value;
//   const costElement = document.getElementById("cost");
//   const regex = /^[+]?\d+([.]\d+)?$/;
//   const res = regex.test(cost);

//   if (!res) {
//     event.preventDefault();
//     alert("Must enter only positive digits!");
//     costElement.focus();
//     return false;
//   }
//   return true;
// };
// ---------------------------------------------------------------------------
// const formCreate = document.getElementById("createForm");
// const taskName = document.getElementById("name");
// // const price = document.getElementById("price");
// // const description = document.getElementById("description");
// // const validDate = document.getElementById("valid_date");

// formCreate.addEventListener("submit", (e) => {
//   checkInputs(e);
// });

// function checkInputs(e) {
//   // trim to remove the whitespaces
//   let isValid = true;
//   const nameValue = taskName.value.trim();
//   // const priceValue = price.value.trim();
//   // const descriptionValue = description.value.trim();
//   // const validDateValue = validDate.value;

//   if (nameValue === "") {
//     setErrorFor(taskName, "Task name cannot be blank");
//     isValid = false;
//   } else {
//     setSuccessFor(taskName);
//   }
//   if (!isValid) {
//     e.preventDefault();
//   }
// }

// function setErrorFor(input, message) {
//   const formGroup = input.parentElement;
//   const small = formGroup.querySelector("small");

//   //add error class
//   formGroup.className = "form-group error";

//   //add error message inside small
//   small.innerText = message;
// }

// function setSuccessFor(input) {
//   const formGroup = input.parentElement;
//   formGroup.className = "form-group success";
// }

// ---------------------------------------------------------------------------
// function submitValidation(e) {
//   //input
//   console.log("im hereeee");
//   const taskName = document.getElementById("name");
//   const dueDate = document.getElementById("due_date");
//   const cost = document.getElementById("cost");
//   const status = document.getElementById("status");
//   //small
//   const errorName = document.getElementById("errorName");
//   const errorDueDate = document.getElementById("errorDueDate");
//   const errorCost = document.getElementById("errorCost");
//   const errorStatus = document.getElementById("errorStatus");

//   let isValid = true;

//   //remove spaces
//   const nameValue = taskName.value.trim();
//   const costValue = cost.value.trim();
//   const statusValue = status.value.trim();
//   const dueDateValue = dueDate.value;

//   if ((nameValue === "") & isValid) {
//     setErrorFor(taskName, "Task name cannot be blank", errorName);
//     taskName.focus();
//     isValid = false;
//   } else {
//     setSuccessFor(taskName);
//   }

//   if (isvalid) {
//     document
//       .getElementById("createForm")
//       .addEventListener("click", function (event) {
//         event.preventDefault();
//         return true;
//       });
//   } else {
//     return false;
//   }
// }

// function setErrorFor(input, message, id) {
//   const formGroup = input.parentElement;
//   // const small = formGroup.querySelector("small");
//   const small = formGroup.getElementById(id);

//   //add error class
//   formGroup.className = "form-group error";

//   //add error message inside small
//   small.innerText = message;
// }

// function setSuccessFor(input) {
//   const formGroup = input.parentElement;
//   formGroup.className = "form-group success";
// }

// const formCreate = document.getElementById("createForm");
// console.log("~ formCreate", formCreate);
// const formEdit = document.getElementById("editForm");

// formCreate.addEventListener("submit", (e) => {
//   console.log("im here motek");
//   checkCreateInputs(e);
// });
// formEdit.addEventListener("submit", (e) => {
//   checkEditInputs(e);
// });

// function checkCreateInputs(e) {
//   // trim to remove the whitespaces
//   let isValid = true;
//   const nameValue = taskName.value.trim();
//   const costValue = cost.value.trim();
//   const statusValue = status.value.trim();
//   const dueDateValue = dueDate.value;

//   if (nameValue === "") {
//     setErrorFor(taskName, "Task name cannot be blank", errorName);
//     isValid = false;
//   } else {
//     setSuccessFor(taskName);
//   }
//   if (!isValid) {
//     e.preventDefault();
//   }
// }

// function checkEditInputs(e) {
//   // trim to remove the whitespaces
//   let isValid = true;
//   const nameValue = offerName.value.trim();
//   const costValue = cost.value.trim();
//   const descriptionValue = description.value.trim();
//   const validDateValue = validDate.value;

//   if (nameValue === "") {
//     setErrorFor(offerName, "Offer name cannot be blank");
//     isValid = false;
//   } else {
//     setSuccessFor(offerName);
//   }
//   if (!isValid) {
//     e.preventDefault();
//   }
// }
