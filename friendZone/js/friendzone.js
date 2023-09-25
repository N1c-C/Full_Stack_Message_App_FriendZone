/** Js Script for the user's home page */

function addCommentBox(msgId){
    /** Adds a comment box and controls to a comment area
     * Called by the add comment link.
     * Hides the link and reveals submit and cancel buttons
     * appends a text area to the div and activates the Tiny MCE text exitor on the new id
     * This is a customisable full featured text editer . For this assignment all the features have been disable
     * as there would be excessive parsing required.
     * However it does allow for an improved text entry in the future and provides a better textarea than the standard one
     * */

    /* Define id for text area and the parent div to append it too */
    let divId = "com_"+msgId
    let txtArea = "txtArea"+msgId
        // Hide the add link so no further text boxes are added
    $("#link"+msgId).attr("hidden",true)
        // Reveal the Submit and cancel buttons
    $("#com_buttons"+msgId).attr("hidden",false)

    /* Create textarea element and set it's id */
    let textarea = document.createElement("textarea")
    textarea.setAttribute("id",txtArea)

    /* Append it to the add comments div */
    document.getElementById(divId).appendChild(textarea)

    /* Initiate Tiny MCE text editor on the new textarea */
    tinymce.init({
        selector: String("#"+txtArea),
        branding: false,
        menubar: false,
        toolbar: false,
        statusbar: false
    });
}

function cancelCommentBox(msgId){
    /** Function called when a comment is cancelled
     * Hides the comment submit and cancel buttons
     * Reveals the lin add comment link
     * Removes the text area *
     * */
    // Reveal the add comment link
    $("#link"+msgId).attr("hidden",false)
    // Hide the Submit and cancel buttons
    $("#com_buttons"+msgId).attr("hidden",true)
    /* Delete the text area*/
    $("#com_"+msgId).empty()
}

function submitComment(msgId){
/** Recieves the msgid
 * Checks the the content is not empty
 * if not performs ajax call to addComment.php
 * json obj returned with the userName & comment sanitised for html along with the time stamp
 * */

    /* Test for an empty comment text area. use tinymce getContent method to return the txt box value */

    let comment = tinymce.get(String("txtArea"+msgId)).getContent({ format: 'text' });
    if( comment ==''){
        return
    }
    /* Check inputs and / or  insert entry in comments table */
    let url = "./addComment.php"
    $.ajax({
        data: {
            "msgId": msgId, "comment": comment
        },
        url: url,
        dataType: 'json',
        type: "POST"
    }).done(function (response) {

        if(response.notPoster){
            // The user's account cannot post comments
            $("#comErr").remove() // remove existing error message
            let err = " <p class = 'text-danger' id='comErr'>You can not add comments</p>"
            $("#com_"+msgId).append(err)
        }else
        if (response.error) {
            // There was an error adding comment to the database
            $("#comErr").remove() // remove existing error message
            let err = " <p class = 'text-danger' id='comErr'>Unable to add comment.</p>"
            $("#com_"+msgId).append(err)
        }else {
            /* Otherwise append the comment to the end of the comments for the message */
            $("#comErr").remove() // remove existing error message
            $('#table' + msgId + ' tr:last').after("<tr class='border-top pt-1'>" +
                "<td class = 'tab-usr' >" +
                "<div class='ms-4'> <a  href = '#' data-value = '" + response.userName + "' class='icon-usr' title='User profile'>" +
                "<img height='35'  src='img/user-circle-icon.svg'><br><b>" + response.userName + "</b></a>\n" +
                "</div>" +
                "</td>" +
                "<td>" +
                "<div> <em class='small tab-date'>" + response.date + "</em></div>" +
                "<div class = 'column float-left msg-title-text align-self-center msg-t-w'>" +
                "<div>" + response.comment + "</div>" +
                "</div>" +
                "</td>" +
                "</tr>")
            /* Close the window after the  text has been appended */
            cancelCommentBox(msgId)
        }

    }).fail(function (jqXHR, error, errorThrown) {
        //console.log(error + errorThrown) // For debugging.
        $("#comErr").remove() // remove existing error message
        let err = " <p class = 'text-danger' id='comErr'>Unable to add failed.</p>"
        $("#com_"+msgId).append(err)

    }) // display any errors when the there is a problem calling script
}

function delMsg(msgId){
    /** Receives the message Id and displays a pop up for confirmation.
     * The pop up is a form with a the message Id as a hidden value
     *  If the user confirms the delete. The id is posted to delMsg.php
     *  The page is then up dated */

    // Test if pop up is already open
    if($("#confirmAlert").length == 0) { // returns the number of elements the selected object has
        console.log("Opening")
        let popUP = "<form id='confirmAlert' action='./delMsg.php' method='post' class = 'row confirm-box align-content-center justify-content-center msg-t-w' >" +
            "            <div class='w-80'>" +
            "                <div class='row float-end msg-t-w' style='align-self: end'>" +
            "            <a id='' onclick='cancelConfirmAlert()' class='link-add-com '  title='Cancel'  aria-label='Cancel comment' ><i class= 'fa fa-times float-right pt-1 '></i></a></div>" +
            "            </div>" +
            "            <H3 class='text-center py-2'>Confirm Delete</H3>" +
            "            <H5 class='text-center py-2'>of your post and all comments</H5>" +
            "            <h6 class='text-center'>This can not be undone.</h6>" +
            "                <br><br>" +
            "               <input type='hidden' id='msgId' name='msgId' value ='"+msgId +"' >" +
            "                <button type = 'submit'  class = 'btn btn-primary msg-t-w mb-3'  aria-label='Confirm delete'><i  class='fa fa-check ms-5 me-5 py-1'></i></button>" +
            "                <br><br>" +
            "        </form>"


        $(document.body).append(popUP)
    }else{ // text box already open do nothing
        return
    }
}
function cancelConfirmAlert(){
    /** Function to delete the confirmation box from the document body */
    $("#confirmAlert").remove() // remove existing error message
}

function page(page){
    /** Receives page where:
     * 1 = next page, -1 = previous page, end = last page, 0 = first page
     * Passes the variable via GET method to the page.php script */
    window.location.href = "./page.php?page="+page
}

function cancelNewPost(){
    /** Returns user back to their home page if they have canceled making a new post **/
    window.location.href="./home.php"
}
function submitPost(){
    /** Submit function for a new post
     * Obtains the message title and main text
     * Posts the dat data to submitPost.php
     * Displays an error message on failure or returns to users home view on success */

    let title = $("#title").val() // acquire title text
    let message = tinymce.get(String("message")).getContent({ format: 'text' }) // acquire the main message text
    let url = "./submitPost.php"
    let error = "<span id = 'err' class= text-danger><b>Unable to add your post please try again.</b></span>"
    $.ajax({
        data: { "title": title, "message": message},
        url: url,
        type: "POST"
    }).done(function (response) {

        if(response){
            window.location.href="./home.php" //success return to user's home page
        }else
            $("#err").remove() // clear previous errors
            $(document.body).append(error) // show error message if the insert fails

    }).fail(function (jqXHR, error, errorThrown) {
        //console.log(error + errorThrown) // For debugging.
        $("#err").remove() // clear previous errors
        $(document.body).append(error) // show error message if ajax fails
    })
}

function updateProfile(){
    /** Update function for user's profile
     * Reads data from form fields
     * Posts the data to updateProfile.php for sanity checks
     * Displays an error message on failure or returns to users home view on success */

    let firstName = $("#firstName").val() // acquire firstname
    let lastName = $("#lastName").val() // acquire lastname
    let phone = $("#phone").val() // acquire phone
    // call Tiny MCE api to get bio text from text box
    let bio = tinymce.get(String("bio")).getContent({ format: 'text' })

    let url = "./updateProfile.php"

    $.ajax({
        data: { "firstName": firstName, "lastName": lastName, "phone": phone, "bio":bio},
        url: url,
        dataType: "json",
        type: "POST"
    }).done(function (response) {

        if(response.success) {
            window.location.href = "./home.php" //success return to user's home page
        }
        if(response.firstName){
            $("#firstName").attr("placeholder","Invalid: Characters Only") // problem with the first name
            $("#firstName").val("")
        }
        if(response.lastName){
                $("#lastName").attr("placeholder","Invalid: Characters Only") // problem with the lastname
                $("#lastName").val("")
            }
        if(response.phone){
            $("#phone").attr("placeholder","Invalid: Numbers Only") // problem with the phone number
            $("#phone").val("")
        }
        let error = "<span id = 'err' class= text-danger><b>Unable to update your profile.</b></span>"
        if(response.error){
            $("#err").remove() // clear previous errors
            $(document.body).append(error) // problem with the phone number
        }

        }).fail(function (jqXHR, error, errorThrown) {
        //console.log(error + errorThrown) // For debugging.
        $("#err").remove() // clear previous errors
        $(document.body).append(error) // show error message if ajax fails
    })
}

function displayProfile(userName){
    /** Function to display a profile of a user */
    window.location.href="./displayProfile.php?userName="+userName
}

function userSearch(){
    /** Called when a user search is submitted
     * Reads the search text and posts it via ajax to search php
     * if no user was found then reveals error message below the search text box */

    let searchStr = $("#search").val() // acquire search value
    let url = "./search.php"
    $.ajax({
        data: { "userName": searchStr},
        url: url,
        type: "POST"
    }).done(function (response) { // success update home page view to display results
        if(response){
            window.location.href="./home.php"
        }else
            $("#search-err").css("opacity",1) // reveal  error message below text box
    }).fail(function (jqXHR, error, errorThrown) {
        //console.log(error + errorThrown) // For debugging.
        $("#search-err").css("opacity",1) // reveal error message below text box
    })
}

function checkCookie() {
    /** Tests is a cookie exists. Returns a bool */
    let username = getCookie("login");
    if (username != "") {
        return true}
}
function getCookie(cname) {
    /** Function to extract a cookie from the document string
     *  https://www.w3schools.com/js/js_cookies.asp*/
    let name = cname + "="
    let decodedCookie = decodeURIComponent(document.cookie)
    let ca = decodedCookie.split(';')
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i]
        while (c.charAt(0) == ' ') {
            c = c.substring(1)
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length)
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    /** Function to set a cookie */
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}