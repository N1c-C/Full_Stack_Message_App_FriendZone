/** Script for friendZone Signup page  **/

/*Jquery ajax call, (when create account button is clicked) to test if the password is acceptable,
 the email is unique and
 and if user details are correct before logging in */

$(document).ready(function () {
    let options = {};
    options.common = {
        minChar: 8,
        onScore: function (options, word, totalScoreCalculated) {
            if(totalScoreCalculated<20){
                $('#signup').prop("disabled", true);
            }else{
                $('#signup').prop("disabled", false);
            }
            return totalScoreCalculated;
        }
    };
    $('#pwd').pwstrength(options);
});

$(document).on('click', '#signup', function(event) {
    event.preventDefault()
    // obtain the values
    let url = "./signup.php"
    let email = $("#email").val()
    let password =$("#pwd").val()
    let userName = $("#userName").val()
    let poster = false
    if ($('#poster').is(":checked")) { poster=true }
    console.log(poster)
    $(".toggle-txt").css("opacity","0")  // Clear error messages

    /* check for empty inputs */
    if (email == '' || password == '' || userName =='' ) {
        $("#toggle-txt").css("opacity","0") // clear error messages
        if(email == ''){ $("#errEmail").html("Required").css("opacity","1")}
        if(password == ''){$("#errPwd").html("Required").css("opacity","1")}
        if(userName == ''){$("#errUser").html("Required").css("opacity","1")}
    }else {
        /* Check inputs or  insert entry */
        $.ajax({
            data: {
                "email": email, "password": password, "userName": userName, "poster": poster
            },
            url: url,
            dataType: 'json',
            type: "POST"
        }).done(function (response) {
            console.log(response)


            if (response.password) // Password does not meet criteria set
                $("#errPwd").html("Password does not meet requirement").css("opacity", "1")

            if (response.emailExists) // email address already exists
                $("#errEmail").html("email already exists").css("opacity", "1")

            if (response.userNameExists) // user already exists
                $("#errUser").html("Username already exists").css("opacity", "1")

            if (response.invalidUserName) // invalid characters in user name
                $("#errUser").html("Letters, numbers,-_ & whitespace ").css("opacity", "1")

            if (response.invalidEmail) // invalid email address
                $("#errEmail").html("Not a valid email").css("opacity", "1")

            if (response == null)
                // There was an issue checking or adding the user account - display friendly simple message for usability guidelines
                $("#errEmail").html("There was a technical problem. Try again later").css("opacity", "1")

            if (response.success) // move to home page
                window.location.href = "./home.php"

        }).fail(function (jqXHR, error, errorThrown) {
            //console.log(error + errorThrown) // For debugging. User friendly error displayed (and more secure) when ajax call fails
            $("#errEmail").html("Unable to connect to friendZone at this time. Please try again.").css("opacity", "1")
        }) // display any errors when the there is a problem calling script
    }
})
