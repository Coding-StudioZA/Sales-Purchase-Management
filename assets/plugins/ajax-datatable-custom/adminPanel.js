loadData(page, '', '', showEntries, '', '');

$('body').on('click', 'ul.pagination li.clickable', function(){
    var page = $(this).attr('p');
    var meta = $('#hiddenShowMeta').val();
    var order = $('#hiddenShowOrder').val();
    var showEntries = $('#hiddenShowDataEntries').val();
    var searchResults = $('#hiddenSearchResult').val();
    var message = "You are at Pagination No [<b>"+page+"</b>]";
    loadData(page, meta, order, showEntries, searchResults, message);
    //loadData(page, meta, order, showEntries, '');
});

$('body').on('click', '.sortOrder', function(){
    var meta = $(this).attr('data-meta');
    var order = $(this).attr('data-order');
    var title = $(this).attr('data-title');
    var showEntries = $('#hiddenShowDataEntries').val();
    var searchResults = $('#hiddenSearchResult').val();
    var page = 1;//$('#hiddenPage').val();
    var message = "[<b>"+title+"</b>] Order Changed To [<b>"+order+"</b>]";
    loadData(page, meta, order, showEntries, searchResults, message);
    //loadData(page, meta, order, showEntries, '');
    //alert(order);
});

$('body').on('change', '#showDataEntries', function(){
    var showEntries = $(this).val();
    var searchResults = $('#searchResult').val();
    var searchResults = $('#hiddenSearchResult').val();
    var meta = $('#hiddenShowMeta').val();
    var order = $('#hiddenShowOrder').val();
    var page = 1;//$('#hiddenPage').val();
    var message = "Entries Showing [<b>"+showEntries+"</b>]";
    loadData(page, meta, order, showEntries, searchResults, message);
    //loadData(page, meta, order, showEntries, '');
    //alert(value);
});

$('body').on('keyup', '#searchResult', function(e){
    var searchResults = $(this).val();
    var showEntries = $('#hiddenShowDataEntries').val();
    var meta = $('#hiddenShowMeta').val();
    var order = $('#hiddenShowOrder').val();
    var page = 1;//$('#hiddenPage').val();

    var code = (e.keyCode ? e.keyCode : e.which);
    if(code == 13) {
        var message = "[<b>"+searchResults+"</b>] Keyword Searched";
        loadData(page, meta, order, showEntries, searchResults, message);
        //alert(showEntries);
    }
});

function loadData(page, meta, order, showEntries, searchResults, message){ 
    loading_show();
    block_show();
    $.ajax
    ({
        type: "POST",
        url: pageUrlLoad,
        data: "page="+page+"&meta="+meta+"&order="+order+"&showEntries="+showEntries+"&searchResults="+searchResults+"&message="+message,
        success: function(response){
            $("#loadPageData").html(response);
            loading_hide();
            block_hide();
        }
    });
}

function loading_show(){
    $('#loadPageData #ajaxloader').fadeIn('fast');
}
function loading_hide(){
    $('#loadPageData #ajaxloader').fadeOut('fast');
}
function block_show(){
    $('#loadPageData #ajaxBlock').block({ 
        message: '<h1>Processing ...</h1>', 
        css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: 1, 
            color: '#fff'
        }
    });
}

function block_hide(){
    $('#loadPageData #ajaxBlock').unblock(); 
}



