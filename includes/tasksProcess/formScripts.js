function getStartDateTask(value) {
  var x = (document.getElementById("due_date").min = value);
}

const validateCost = (event) => {
  const cost = event.target[4].value;
  const costElement = document.getElementById("cost");
  const regex = /^[+]?\d+([.]\d+)?$/;
  const res = regex.test(cost);

  if (!res) {
    event.preventDefault();
    alert("Must enter only positive digits!");
    costElement.focus();
    return false;
  }
  return true;
};

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
            '<div class="alert alert-warning" role="alert">update task success</div>'
          );
          setTimeout(function () {
            location.reload();
          }, 1000);
        } else {
          $(".modal-body").after(
            '<div class="alert alert-danger divmsg" role="alert">Something went wrong!</div>'
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
