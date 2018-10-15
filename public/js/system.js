$( document ).ready(function() {
    $('#company_filter').change(function () {
        var url = "?company="+$(this).val();
        if($(this).val()===''){
            url = '?';
        }
        window.location.replace(url);
    })
});
