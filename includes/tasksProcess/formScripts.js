// function getStartDateTask(value) {
//   var x = (document.getElementById("view_due_date").min = value);
//   console.log("date", x);
// }
// onchange="getStartDateTask(this.value)"

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

// View || Update Modal
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

    //form.ajax find name= name name=email attribute
    that.find("[name]").each(function (value) {
      var that = $(this); //this name
      var name = that.attr("name"); //name attribute
      var value = that.val(); // value of input

      data[name] = value; //name:email= email:uri@test.com
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
