function ajax_call(id, action_name, page_name, column_id, url, row_id){
    var data = "id="+id+"&action_name="+action_name+"&page_name="+page_name+"&column_id="+column_id+"&row_id="+row_id+"&url="+url;
    block_show();
    $.ajax({
        type   : "POST",
        url    : url,
        //url    : "/laravel/app-admin/ajax_call",
        //url    : "{{ URL::to('/app-admin/ajax_call'); }}",
        data   : data,
        success: function(response){
            block_hide();
            if(row_id == false){ 
                $("#"+column_id+id).html(response);
            } else {    
                $("#"+row_id).html(response);
            }
         }
    });
}


/*****Add/Edit Form Script*****/
//Cancel Add Form
$('body').on('click', '#cancelForm', function(){
    $("#loadPageDataAddForm").hide();
    $("#loadPageData").fadeIn('fast');
});
//Cancel Edit Form
$('body').on('click', '#cancelEditForm', function(){
    $("#loadPageDataEditForm").hide();
    $("#loadPageData").fadeIn('fast');
});

//Show Add Form
function showAddForm(showAddFormUrl, addButtonId, addFormDivId, mainPageLoadDivId)
{
    $('body').on('click', addButtonId, function(){
        $(mainPageLoadDivId).hide();
        $(addFormDivId).fadeIn('fast');
        $.ajax({
            type   : "POST",
            url    : showAddFormUrl,
            data   : "",
            success: function(response){
                $(addFormDivId).html(response);
             }
        });
    });
}

//Submit Add Form
function submitAddFormOnclick(AddUrlSubmitTo, AddFormClass, addFormDivId, mainPageLoadDivId)
{
    $('body').on('submit', AddFormClass, function(e){
        e.preventDefault();
        
        $('#mws-button-row').hide();
        $('#mws-button-row-loader').show();
        
        $.ajax({
            type   : "POST",
            dataType: "json",
            url    : AddUrlSubmitTo,
            data   : $(AddFormClass).serialize(),
            success: function(response){
                if(response.status == "error"){
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#ajax_message_jgrowl').html(response.msgjgrowl);
                } else {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $(addFormDivId).hide();
                    $(mainPageLoadDivId).fadeIn('fast');
                    $('#ajax_message_jgrowl').html(response.msgjgrowl);
                    loadData(page, '', '', showEntries, '', '');
                }
                $('#mws-button-row').show();
                $('#mws-button-row-loader').hide();
             }
        });
    });
}

//Submit Edit Form
function submitEditFormOnclick(EditUrlSubmitTo, EditFormClass, editFormDivId, mainPageLoadDivId)
{
    $('body').on('submit', EditFormClass, function(){
        e.preventDefault();
        
        $('#mws-button-row').hide();
        $('#mws-button-row-loader').show();
        
        $.ajax({ 
            type   : "POST",
            dataType: "json",
            url    : EditUrlSubmitTo,
            data   : $(EditFormClass).serialize(),
            success: function(response){
                if(response.status == "error"){
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $('#ajax_message_jgrowl').html(response.msgjgrowl);
                } else {
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $(editFormDivId).hide();
                    $(mainPageLoadDivId).fadeIn('fast');
                    $('#ajax_message_jgrowl').html(response.msgjgrowl);
                    loadData(page, '', '', showEntries, '', '');
                }
                $('#mws-button-row').show();
                $('#mws-button-row-loader').hide();
             }
        });
    });
}

//Show Edit Form
function showEditForm(urlSubmitTo, EditRowClass, editFormDivId, mainPageLoadDivId)
{
    $('body').on('click', EditRowClass, function(){
        var attrId = $(this).attr("data-id");
        var attrTitle = $(this).attr("data-title");
        
        $(mainPageLoadDivId).hide();
        $(editFormDivId).fadeIn('fast');
        
        $.ajax({
            type   : "POST",
            url    : urlSubmitTo,
            data   : "id="+attrId+"&title="+attrTitle,
            success: function(response){
                $(editFormDivId).html(response);
             }
        });
    });
}