/** Script for friendZone login page  **/

/** Jquery ajax call, (when sign in button is clicked)
 * Tests entry fields aren't blank
 * If not passes the user entries to login script.
 * Displays any appropriate errors with any returned response
 */

$(document).on('click', '#login', function(event) {
    event.preventDefault();
    let url = "./login.php"
    let email = $("#email").val()
    let password =$("#pwd").val()
    let remember = "false"

    // check if the remember box is checked
    if($("#remember").is(":checked")) {
        remember = "true"
    }

    /* Test for blank fields */

    if (email == '' || password == '') {
        $(".toggle-txt").css("opacity","0") // clear error messages
        if(email == ''){
            $("#errEmail").html("Required").css("opacity","1")}
        if(password == ''){$("#errPwd").html("Required").css("opacity","1")}
    }else{
        $.ajax({
            data: {
                "email": email, "password": password, "remember":remember
            },
            url: url,
            type: "POST"
        }).done(function (response) {
            console.log(response)

            $(".toggle-txt").css("opacity","0") // Clear previous error messages
            switch (response) {
                case "true":
                    window.location.href = "./home.php"
                    break
                case "password": // Login details are correct go the users home page
                    $("#errPwd").html("Incorrect").css("opacity", "1")
                    break
                case "email": // The entered details are incorrect. Display an error message
                    $("#errEmail").html("Not registered").css("opacity", "1")
                    $("#pwd").val('')    // clear password field
                    break
                default: // There was an issue checking the user account - display friendly simple message for usability guidelines
                    $("#errEmail").html("We are experiencing technical problems. Try again later").css("opacity", "1")
            }

        }).fail(function (jqXHR, error, errorThrown) {
            //console.log(error + errorThrown) // For debugging. User friendly error displayed (and more secure) when ajax call fails
            $("#errmsg").html("Unable to connect to friendZone at this time. Please try again.").css("opacity", "1")
        }) // display any errors when the there is a problem calling script
    }
})
