// Adding Books Ajax
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
                toastr.success("Book Added!");
                $("#qr_logo_holder").attr("src", $("input[name=qr_url]").val() + "/" + data.qr);
                $("#download_qr_button").attr("href", $("input[name=qr_url]").val() + "/" + data.qr);
                $(".qr_display").removeClass("hidden");
                $(".qr_initial_display").addClass("hidden");
            }else{
                toastr.error("Error Adding Book!");
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
                toastr.success("Student Added!");
                $("#qr_logo_holder").attr("src", $("input[name=qr_url]").val() + "/" + data.qr);
                $("#download_qr_button").attr("href", $("input[name=qr_url]").val() + "/" + data.qr);
                $(".qr_display").removeClass("hidden");
                $(".qr_initial_display").addClass("hidden");
            }else{
                toastr.error("Error Adding Student!");
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

$("#scan-book-qr-button").on("click", function(){
    $("#book-qr").focus().on("input",function(){
        let barcode = $(this).val();
        
        // if(barcode.substr(barcode.length - 1) == "}"){
            // console.log(barcode);
        // }
        if(barcode.length >= 200){
            console.log(barcode);

            $.ajax({
                url: $("meta[name=info-rdr]").attr("content"),
                type: "post",
                data: {
                    token: barcode,
                    type: "book"
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    

                    if(data.result){
                        console.log(data);
                        $("input[name=title]").val(data.data.book_title);
                        $("input[name=author]").val(data.data.author);
                        $("input[name=isbn]").val(data.data.isbn);
                        $("input[name=book_id]").val(data.data.id);
                    }
                // You will get response from your PHP page (what you echo or print)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                }
            });
            $(this).val("");
        }
    })
});

$("#scan-student-qr-button").on("click", function(){
    $("#student-qr").focus().on("input",function(){
        let barcode = $(this).val();
        
        // if(barcode.substr(barcode.length - 1) == "}"){
            // console.log(barcode);
        // }
        if(barcode.length >= 200){
            console.log(barcode);

            $.ajax({
                url: $("meta[name=info-rdr]").attr("content"),
                type: "post",
                data: {
                    token: barcode,
                    type: "student"
                },
                success: function (response) {
                    var data = JSON.parse(response);
                    console.log(data);

                    if(data.result){
                        console.log(data);
                        $("input[name=name]").val(data.data.student_name);
                        $("input[name=number]").val(data.data.student_number);
                        $("input[name=student_id]").val(data.data.id);
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
    })
});

$("#action-borrow-book").on("click", function(){
    $.ajax({
        url: $("meta[name=info-act]").attr("content"),
        type: "post",
        data: {
            book_id: $("input[name=book_id]").val(),
            student_id: $("input[name=student_id]").val()
        },
        success: function (response) {
            var data = JSON.parse(response);

            if(data.result){
                toastr.success("Book Borrowed!");
                $(".borrow-form").trigger("reset");
                // $("input[name=isbn]").val(data.data.isbn);
            }else{
                toastr.error(data.message);
            }
        // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        }
    });
});

$("#action-return-book").on("click", function(){
    $.ajax({
        url: $("meta[name=return-act]").attr("content"),
        type: "post",
        data: {
            book_id: $("input[name=book_id]").val()
        },
        success: function (response) {
            var data = JSON.parse(response);
            

            if(data.result){
                toastr.success("Book Returned!");
                console.log(data);
                // $("input[name=isbn]").val(data.data.isbn);
            }else{
                toastr.error(data.message);
            }
        // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        }
    });
});

// $(document).ready(function(){
//     $(".scanner-input").focus().on("input",function(){
//         let barcode = $(".scanner-input").val();
        
//         // if(barcode.substr(barcode.length - 1) == "}"){
//         //     console.log(barcode);
//         // }
//         if(barcode.length >= 200){
//             console.log(barcode);
//         }
//     }).blur(function(){
//         // $(this).focus();
//     });
// });

// function doneTyping(){
//     let barcode = $(".scanner-input").val();
//     console.log(barcode);
// }