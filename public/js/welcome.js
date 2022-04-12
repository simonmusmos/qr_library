$(document).ready(function(){
    $("#student-id").focus().on("input",function(){
        let barcode = $(this).val();
        // console.log(barcode);
        // $(this).val("");
        // if(barcode.substr(barcode.length - 1) == "}"){
        //     console.log(barcode);
        // }
        if(barcode.length >= 200){
            console.log(barcode);
            $.ajax({
                url: $("meta[name=student-change-state]").attr("content"),
                type: "post",
                data: {
                    token: barcode
                },
                success: function (response) {
                    var data = JSON.parse(response);

                    if(data.result){
                        console.log(data);
                        // $("input[name=isbn]").val(data.data.isbn);
                    }
                // You will get response from your PHP page (what you echo or print)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
            $(this).val("");
        }
    }).blur(function(){
        $(this).focus();
    });
});