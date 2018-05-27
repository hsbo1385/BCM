var url = window.location.toString();

if(url.slice(url.length - 7, url.lenght) != "/admin/"){
    window.location.href = "/admin/";
}

var ajaxURL = '/admin/ajax.php';

$(document).ready(function () {
    $("#loading").fadeOut();
});

//on form submit with new content
function submitData(form){
    //data object to be sent
    data = {}; 
    
    //var which stores bool of whether a field was left blank 
    var isBlank = false;
    
    //foreach form element, populate the data object
    $.each(form, function(i, field){
        data[field.name] = field.value;
        if(field.name !='' && field.value == "")
            isBlank = true;
    });
    console.log(data);
    //add action which needs to be triggered
    data.action = "upsert_data";

    //if no section has been chosen, set section to "new-item"
    var section = (data.section_id == null) ? "new-item" : data.section_id;
    $("#section-" + section + " .loading").removeClass("hide");

    //if a field has been left blank, warn the user
    if(isBlank){
        $("#section-" + section + "-submit .message .other-message").fadeIn().html("Label cannot be blank.").delay(2000).fadeOut();
    }
    else{
        //if all fields have been populated, send request to the backend
        sendRequest(data, section);
    }
}

function switchSection(sectionId){
    //switching between sections
    var sectionToShow = ".section-" + sectionId;

    //hide all sections, then show the one we want
    $(".section-form").fadeOut(100);
    $(sectionToShow).delay(100).fadeIn();
    
    //add and remove active clases for sidebar
    $("a.content-link").removeClass("active");
    $(sectionToShow + "-button").addClass("active");
}

function deleteField(fieldId, fieldName, section){
    $(".confirmation-window .confirmation-dialog p").html("Are you sure you would like to delete " + fieldName + "?<br>This cannot be undone.");
    $(".confirmation-window").fadeIn();

    var data = {};

    data.fieldId = fieldId;
    data.fieldName = fieldName;
    data.section = section;
    data.action = "delete_field";

    $(".response-buttons button").click(function (e) {
        e.preventDefault();

        $(".confirmation-window").fadeOut();
        
        if($(this).hasClass("confirm"))
            sendRequest(data, data.section)

    });
}

function sendRequest(data, section){
    $.ajax({
        url: ajaxURL,
        type: "POST",
        data: {
            input: data
        },
        success: function(returnedData){
            $("#section-" + section + "-submit .message .confirm").fadeIn().delay(2000).fadeOut();
        },
        error: function (returnedData){
            $("#section-" + section + "-submit .message .error").fadeIn().delay(2000).fadeOut();
        },
        complete: function (){
            $("#section-" + section + "-submit .loading").addClass("hide");
            reloadForms();
            if(section === "new-item")
                $(".new-item-container").fadeOut();
        }
    });
}

function reloadForms(){
    $.ajax({
        url: "assets/template/section-forms.php",
        type: "GET",
        complete: function(returnedData){
            $("#form-output").html(returnedData.responseText);
        }
    });
}

//toggle new item dialog
function toggleNewFieldForm(){
    $(".new-item-container input").val("");
    $(".new-item-container").fadeToggle();
}