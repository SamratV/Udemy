$("ul").on("click","li",function(){
    $(this).toggleClass("checked");
});
$("ul").on("click","span",function(event){
    $(this).parent().fadeOut(500,function(){
        $(this).remove();
    });
    event.stopPropagation();
});
$("input[type='text']").keypress(function(event){
    if(event.which === 13){
        var task = "<li><span><i class='fa fa-trash'></i></span> "+$(this).val()+"</li>";
        $("ul").append(task);
        $(this).val("");
    }
});
$(".fa-plus").click(function(){
    $("input[type='text']").fadeToggle();
});