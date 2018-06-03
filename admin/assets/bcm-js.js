var url = window.location.toString();

if(url.slice(url.length - 7, url.lenght) != "/admin/"){
    window.location.href = "/admin/";
}

var ajaxURL = '/admin/ajax.php/';

$(document).ready(function () {
    $("#loading").fadeOut();
});

function submitData(e, form){
    e.preventDefault();
    //data object to be sent
    var data = {};
    
    //foreach form element, populate the data object
    $.each(form, function(i, field){
        data[field.name] = (field.files) ? (field.files[0] === undefined) ? "" : field.files[0] : field.value;
    });

    delete data[""];
    data.action = "upsert_data";

    sendRequest(data);
}

function submitDataSection(e, form){
    e.preventDefault();
    //data object to be sent
    var data = {};
    
    //foreach form element, populate the data object
    $.each(form, function(i, field){
        data[field.name] = field.value;
    });

    delete data[""];
    data.action = "create_section";

    sendRequest(data);
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

function deleteSection(e, sectionId, sectionName){
    e.preventDefault();

    $(".confirmation-window .confirmation-dialog p").html("Are you sure you would like to delete " + sectionName + "?<br>This cannot be undone.");
    $(".confirmation-window").fadeIn();

    var data = {};

    data.sectionId = sectionId;
    data.sectionName = sectionName;
    data.action = "delete_section";
    
    $(".response-buttons button").click(function (e) {
        e.preventDefault();

        $(".confirmation-window").fadeOut();
        
        if($(this).hasClass("confirm"))
            sendRequest(data, 1)
    });
}

function sendRequest(formData){
    $("#request-loading").fadeIn();
    $.ajax({
        url: ajaxURL,
        type: "POST",
        data: {
            input: formData
        },        
        success: function(returnedData){
            console.log(returnedData);
            $("#request-loading .message, #request-loading .message .confirm").fadeIn();
        },
        error: function (returnedData){
            console.log(returnedData);
            $("#request-loading .message, #request-loading .message .error").fadeIn();
        },
        complete: async function (){
            $("#request-loading").delay(1500).fadeOut().children(".message div").fadeOut();
            await reloadForms();
            switchSection((!formData.section_id) ? firstSection : formData.section_id);
            $(".new-item-container, .new-section-container").fadeOut({done: reloadNewForms()}); 
        }
    });
}

async function reloadForms(){
    await $.ajax({
        url: "assets/template/section-forms.php",
        type: "GET",
        complete: function(returnedData){
            $("#form-output").html(returnedData.responseText);
            $('textarea').trumbowyg();
        }
    });
}

async function reloadNewForms(){
    $.ajax({
        url: "assets/template/new-section-form.php",
        type: "GET",
        complete: function(returnedData){
            $(".new-section-container").html(returnedData.responseText);
            $('textarea').trumbowyg();
        }
    });
    $.ajax({
        url: "assets/template/new-field-form.php",
        type: "GET",
        complete: function(returnedData){
            $(".new-item-container").html(returnedData.responseText);
            $('textarea').trumbowyg();
        }
    });
}


//toggle new item dialog
function toggleNewFieldForm(e){
    e.preventDefault();
    $(".new-item-container input[type='text']").val("");
    $(".new-item-container").fadeToggle();
}
function toggleNewSectionForm(e){
    e.preventDefault();
    $(".new-section-container input[type='text']").val("");
    $(".new-section-container").fadeToggle();
}