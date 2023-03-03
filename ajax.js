



$(document).ready(function () {
   $(document).on("submit", "#StudAdd", function (e) {

      e.preventDefault();
      var fname = $("#fname").val();
      var lname = $("#lname").val();
      var email = $("#email").val();
      var phone = $("#phone").val();

      
     
      if (fname == "") {
         $("#ferr").addClass("text-danger");
         $("#ferr").text("* First name are required.");

         return true;
      } else if (lname == "") {
         $("#lerr").addClass("text-danger");
         $("#lerr").text("* Last name are required.");
         return true;
      } else if (email == "") {

         $("#emailerr").addClass("text-danger");
         $("#emailerr").text("* Email name are required.");
         return true;
      } else if (phone == "") {
         $("#phoneerr").addClass("text-danger");
         $("#phoneerr").text("* Phone number are required.");
         return true;
      } else {

         $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
               'fname': fname,
               'lname': lname,
               'email': email,
               'phone': phone,
               'addform': 'addform',
            },

            success: function (data) {
               console.log(data);
               $("#StudAdd")[0].reset();
               $("#tblmsg").removeClass("d-none");
               $("#tblmsg").text(fname + " " + lname + "  " + "recoard are successfully Added..");
               $("#table").load(location.href + " #table");


            }
         })
      }
   });


   $(document).on("click", ".delete", function () {

      var id = $(this).attr("data-id");


      $.ajax({
         url: 'index.php',
         type: 'GET',
         data: {
            'id': id,
         },
         success: function (data) {
            $("#tblmsg").removeClass("d-none");
            $("#tblmsg").text("recoard are successfully deleted..");
            $(".table").load(location.href + " .table");
         }
      })
   });


   $(document).on("click", ".edit", function (e) {

      e.preventDefault();
      var id = $(this).attr("data-id");
      var fname = $(this).attr("data-fname");
      var lname = $(this).attr("data-lname");
      var email = $(this).attr("data-email");
      var phone = $(this).attr("data-phone");

      $("#StudAdd").addClass("d-none");
      $("#StudEdit").removeClass("d-none");

      $("#eid").attr('value', id);
      $("#efname").attr('value', fname);
      $("#elname").attr('value', lname);
      $("#eemail").attr('value', email);
      $("#ephone").attr('value', phone);


   });

   $(document).on("submit", "#StudEdit", function (e) {

      e.preventDefault();
      var id = $("#eid").val();
      var fname = $("#efname").val();
      var lname = $("#elname").val();
      var email = $("#eemail").val();
      var phone = $("#ephone").val();

      $.ajax({
         url: 'index.php',
         type: 'POST',
         data: {
            'eid': id,
            'fname': fname,
            'lname': lname,
            'email': email,
            'phone': phone,
            'editform': 'editform',

         },
         success: function (data) {
            console.log(data);
            $("#StudAdd").removeClass("d-none");
            $("#StudEdit").addClass("d-none");

            $("#tblmsg").removeClass("d-none");
            $(".table").load(location.href + " .table");
            $("#tblmsg").text(fname + " " + lname + " " + "Recoard are Successfully Updated..");
            $("#table").load(location.href + " #table");

         }
      })
   });
   
   

   $("#myInput").on("keyup", function () {
      var value = $(this).val().toLowerCase();

      $("#myTable tr").filter(function () {
         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
      var trow = $("#myTable tr:not('.no-records'):visible");
      var length = trow.length;

      if (length == 0) {
         $("#myTable").html('<tr class="no-records" id="noRec"><td colspan="2"><h1 class="display-4">No Recoard Found</h1></td></tr>')

      } else {
         $(".table").load(location.href + " .table");
      }

   });


   $(document).on("submit", "#LoginForm", function (e) {
      e.preventDefault();
      var email = $("#l_email").val();
      var password = $("#l_password").val();


      if (email == "" || password == "") {
         alert("this field are required");
         return false;
      } else {
         $.ajax({
            url: 'index.php',
            type: 'POST',
            data: {
               'email': email,
               'password': password,

               'lform': 'lform',

            },
            success: function (data) {
               console.log(data);
               $("#LoginForm")[0].reset();
               $('#loginmodal').modal('hide');
               $("#msgwel").load(location.href + " #msgwel");
               
            }
         });
      }

   });

   $(document).on("click", "#logout", function () {
      $.ajax({
         url: "index.php",
         type: "GET",
         data: {
            'logout': 'logout',
         },
         success: function () {
            $("#msgwel").load(location.href + " #msgwel");
         }
      });

   });




});