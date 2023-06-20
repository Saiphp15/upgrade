$(document).ready(function () {
    let base_url = window.location.origin;
    if(base_url == "http://localhost"){
        base_url= '/upgrade';        
    }else{
        base_url = '/upgrade';
    }
    
    $("#chk_login").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#chk_login").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#chk_login')[0];
            var requestData = new FormData(form);
            var action_page = $("#chk_login").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    console.log(resp);
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                      window.location.href = resp.redirectUrl;
                    } else {
                        swal({title: "", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#add_student_form").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#add_student_form").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#add_student_form')[0];
            var requestData = new FormData(form);
            var action_page = $("#add_student_form").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
		                    function(){ 
                                $("#add_student_form")[0].reset();
		                        window.location.href = resp.redirectUrl;
		                    }
		                );
                    } else {
                        swal({title: "", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#edit_student_form").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#edit_student_form").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#edit_student_form')[0];
            var requestData = new FormData(form);
            var action_page = $("#edit_student_form").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
		                    function(){ 
                                $("#edit_student_form")[0].reset();
		                        window.location.href = resp.redirectUrl;
		                    }
		                );
                    } else {
                        swal({title: "", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    /* Action Common js for delete,activate,deactivate operations start */
    $(".actionBtn").click(function(){
        let action_page = $(this).data('actionurl');
        let operation = $(this).data('operation');
        if(operation=='delete'){
            let id = $(this).data('id');
            swal({
                title: "Are you sure You Want to Remove this Record ?",
                text: "This Record will Remove ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Remove !",
                showLoaderOnConfirm: true,
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                    ({
                        type: "POST",
                        data: {"id":id},
                        url: action_page,
                        beforeSend: function() {
                            swal({
                            title: "",
                            text: "Processing...",
                            imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                            showConfirmButton: false
                        });
                        },
                        success: function(resp) 
                        {
                            resp = JSON.parse(resp);
                            resp_statuscode = resp.responseCode;
                            if(resp_statuscode==200){
                                resp_msg = resp.responseMessage;
                                swal({title: "Removed!", text: resp_msg, type: "success"},
                                    function(){ 
                                       window.location.reload();
                                    }
                                );
                            }else{
                                resp_error = resp.responseMessage;
                                swal("Error", resp_error, "error");
                            }
                        }
                    });
        
                } else {
                    swal("Cancelled", "Record is Safe", "error");
                }
            });
        }else if(operation=='activate'){
            let id = $(this).data('id');
            swal({
                title: "Activate Record",
                text: "This Record will Activate",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes Activate",
                showLoaderOnConfirm: true,
                cancelButtonText: "No cancel please",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                    ({
                        type: "POST",
                        data: {"id":id},
                        url: action_page,
                        beforeSend: function() {
                            swal({
                            title: "",
                            text: "Processing...",
                            imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                            showConfirmButton: false
                        });
                        },
                        success: function(resp) 
                        {
                            resp = JSON.parse(resp);
                            resp_statuscode = resp.responseCode;
                            if(resp_statuscode==200){
                                resp_msg = resp.responseMessage;
                                swal({title: "Activated" , text: resp_msg, type: "success"},
                                    function(){ 
                                       window.location.reload();
                                    }
                                );
                            }else{
                                resp_error = resp.responseMessage;
                                swal("Error", resp_error, "error");
                            }
                        }
                    });
        
                } else {
                    swal("Cancelled", "Record is Safe", "error");
                }
            });
        }else if(operation=='deactivate'){
            let id = $(this).data('id');
            swal({
                title: 'Are you sure You Want to Deactivate this Record ?',
                text: " ",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Deactivate !",
                showLoaderOnConfirm: true,
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    $.ajax
                    ({
                        type: "POST",
                        data: {"id":id},
                        url: action_page,
                        beforeSend: function() {
                            swal({
                            title: "",
                            text: "Processing...",
                            imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                            showConfirmButton: false
                        });
                        },
                        success: function(resp) 
                        {
                            resp = JSON.parse(resp);
                            resp_statuscode = resp.responseCode;
                            if(resp_statuscode==200){
                                resp_msg = resp.responseMessage;
                                swal({title: "Deactivated", text: resp_msg, type: "success"},
                                    function(){ 
                                       window.location.reload();
                                    }
                                );
                            }else{
                                resp_error = resp.responseMessage;
                                swal("Error", resp_error, "error");
                            }
                        }
                    });
        
                } else {
                    swal("Cancelled", "Record is safe.", "error");
                }
            });
        }
        
    });
    /* Action Common js for delete,activate,deactivate operations end */

    
    $("#update_user_form").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#update_user_form").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#update_user_form')[0];
            var requestData = new FormData(form);
            var action_page = $("#update_user_form").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
		                    function(){ 
                                $("#update_user_form")[0].reset();
		                        window.location.href = resp.redirectUrl;
		                    }
		                );
                    } else {
                        swal({title: "", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    
    $("#add_subject_form").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#add_subject_form").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#add_subject_form')[0];
            var requestData = new FormData(form);
            var action_page = $("#add_subject_form").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
		                    function(){ 
                                $("#add_subject_form")[0].reset();
		                        window.location.href = resp.redirectUrl;
		                    }
		                );
                    } else {
                        swal({title: "", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    $("#edit_subject_form").on('submit', (function (e) {
        e.preventDefault();
        var isvalidate = $("#edit_subject_form").valid();
        if (!isvalidate) {
            return false;
        } else {
            var form = $('#edit_subject_form')[0];
            var requestData = new FormData(form);
            var action_page = $("#edit_subject_form").attr('action');
            $.ajax({
                url: action_page,
                type: "POST",
                enctype: 'multipart/form-data',
                data: requestData,
                contentType: false,
                cache: false,
                processData: false,
                timeout: 600000,
                beforeSend: function() {
                    swal({
                        title: "",
                        text: "Processing...",
                        imageUrl: "https://media.tenor.com/OzAxe6-8KvkAAAAi/blue_spinner.gif",
                        showConfirmButton: false
                    });
                },
                success: function (resp) {
                    resp = JSON.parse(resp);
                    if (resp.responseCode == 200) {
                        swal({title: "", text: resp.responseMessage, type: "success"},
		                    function(){ 
                                $("#edit_subject_form")[0].reset();
		                        window.location.href = resp.redirectUrl;
		                    }
		                );
                    } else {
                        swal({title: "", closeOnClickOutside: false, text: resp.responseMessage, type: "error"});
                    }
                }
            });
        }
    }));

    

});
/* theme filter function start */
