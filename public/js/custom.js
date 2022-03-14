// Adding Books Ajax

$("#add-book-form").on('submit', function(e){
    e.preventDefault();

    $(this).children().find('button[id=add-book-submit-form]').attr('disabled', '1');
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'), //get value from forms action attrbute
        data: formData,
        success:function(data){
            data = JSON.parse(data);
            console.log(data);
            if(data.result){
                $("#qr_logo_holder").attr("src", $("input[name=qr_url]").val() + "/" + data.qr);
                $("#download_qr_button").attr("href", $("input[name=qr_url]").val() + "/" + data.qr);
                $(".qr_display").removeClass("hidden");
                $(".qr_initial_display").addClass("hidden");
            }else{
                console.log("error");
            }
        }
    });
});

$("#add-book-clear-form").on("click", function(){
    $("#add-book-form").trigger("reset");
    $(".qr_display").addClass("hidden");
    $(".qr_initial_display").removeClass("hidden");
    $("#add-book-submit-form").removeAttr('disabled');
});


// Adding Students Ajax

$("#add-student-form").on('submit', function(e){
    e.preventDefault();

    $(this).children().find('button[id=add-student-submit-form]').attr('disabled', '1');
    var formData = $(this).serialize();

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'), //get value from forms action attrbute
        data: formData,
        success:function(data){
            data = JSON.parse(data);
            console.log(data);
            if(data.result){
                $("#qr_logo_holder").attr("src", $("input[name=qr_url]").val() + "/" + data.qr);
                $("#download_qr_button").attr("href", $("input[name=qr_url]").val() + "/" + data.qr);
                $(".qr_display").removeClass("hidden");
                $(".qr_initial_display").addClass("hidden");
            }else{
                console.log("error");
            }
        }
    });
});

$("#add-student-clear-form").on("click", function(){
    $("#add-student-form").trigger("reset");
    $(".qr_display").addClass("hidden");
    $(".qr_initial_display").removeClass("hidden");
    $("#add-student-submit-form").removeAttr('disabled');
});