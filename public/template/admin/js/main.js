function delete_zalo(id){
    $('#'+id).val("");
    document.getElementById('row-item'+ id).remove();
} 

function add_zalo(){
    let num = $('.dynamic-row-item').length;
    let nextNum = num + 1
    if (parseInt(nextNum) > 5) {
        alert('Nhiều nhất là 5 số zalo')
    } else {
        $('.dynamic-row').append('<div class="form-group dynamic-row-item" id="row-item' + nextNum + '">' +
        '<label> Số '+ nextNum +'</label> ' + 
        '<input class="form-control" type="tel" name="zalos[]" id="form_zalo' + nextNum + '">' +
        '<span class="js-event-delete" onclick="delete_zalo('+ nextNum +')"><i class="fa fa-minus-circle" aria-hidden="true"></i></span>');
    }
}