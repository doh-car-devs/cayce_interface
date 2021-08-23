// sidebar

// const element = document.querySelector(".mainnavlink");

// if (element.classList.contains("active")) {
//     alert('sdf');
//     var i = document.getElementsByClassName("has-treeview");
//     i.classList.add("menu-open");
// }
// // endsidebar

// $('#q12, #q22 ,#q32, #q42').on('keyup', function()
// {
//     var sum = parseInt($('#q12').val()) + parseInt($('#q22').val()) + parseInt($('#q32').val()) +parseInt($('#q42').val());
//     $('#cost2').val(sum);
// });

$('button[id="dlt_id"]').on('click', function () {
    var value = $(this).attr('data-id');
    $('.modal-footer #delete_id').val(value);
});

$('button[id="comment"]').on('click', function () {
    var value = $(this).attr('data-id');
    $('.modal-body #comment_id').val(value);
});

$('button[id="dltPPMP_id"], button[id="edtPPMP_id"]').on('click', function () {
    var value = $(this).attr('data-id');
    $('.modal-footer #delete_id_ppmp').val(value);
});

$('button[id="markdone"]').on('click', function () {
    var value = $(this).attr('data-id');
    $('.modal-footer #approve_id').val(value);
});
$('button[id="markppmpdone"]').on('click', function () {
    var value = $(this).attr('data-id');
    // alert(value);
    $('.modal-footer #approve_id_ppmp').val(value);
});
$('button[id="commentppmp"]').on('click', function () {
    var value = $(this).attr('data-id');
    // alert(value)
    $('.modal-content #approve_id_ppmp2').val(value);
});

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 10000);

// Menu Toggle Script
$('[data-toggle="tooltip"]').tooltip()
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

$(document).ready(function() {
    // Back page script
    $("#addGenPO").on("click", function(e){
        // alert('sdf')
        document.getElementById("myformdefault").submit();
        // document.getElementById("poitem-frm").submit();
        // e.preventDefault();
        // window.history.back();
    });
    // Back page script
    $(".hBack").on("click", function(e){
        e.preventDefault();
        window.history.back();
    });
    // Forward page script
    $(".hForward").on("click", function(e){
        e.preventDefault();
        window.history.forward();
    });

    $(".single-basic").select2({
        theme: 'bootstrap4',
        // width: '300px'
    });

    $("#bsource").on('select2:select', function()
    {
        // alert($(this).find(':selected').attr('data-nep'));
        var bsourcenum = numeral($(this).find(':selected').attr('data-nep')).format('0,0.00');
        $('#viewactualamt').text(bsourcenum);
        $('#actualTA').attr('max', $(this).find(':selected').attr('data-nep')) ;
        var perdev = numeral($(this).find(':selected').attr('data-projected')).format('0,0.00');
        $('#viewperdev').text(perdev);
        $('#perdivisionbudget').attr('max', $(this).find(':selected').attr('data-projected')) ;
        // theme: 'bootstrap4',
        // // width: '300px'
    });

    // Allocate budget
    $('table[id="annualbudgettable"]').on('click', 'button[id="allocate_id"]', function () {
        var value = $(this).attr('data-id');
        var strArray = value.split("||");
        $('.allbud').val(strArray[0]);
        $('#annual_budget_id3').val(strArray[3]);
        $('#viewperdev3').text(numeral(strArray[1]).format('0,0.00'));
        $('#viewactualamt3').text(numeral(strArray[2]).format('0,0.00'));
        $('#viewactualamt3').text(numeral(strArray[2]).format('0,0.00'));

        $('#perdivisionbudget3').attr('max', strArray[1]);
        $('#actualTA3').attr('max', strArray[2]);

        $('.allocatealla3').on('click', function()
        {
            // alert(strArray[2])
            $('#perdivisionbudget3').val(strArray[1])
            $('#actualTA3').val(strArray[2])
        })
    });
    $('table[id="saaannualbudgettable"]').on('click', 'button[id="allocate_id"]', function () {
        var value = $(this).attr('data-id');
        var strArray = value.split("||");
        $('.allbud').val(strArray[0]);
        $('#annual_budget_id3').val(strArray[3]);
        $('#viewperdev3').text(numeral(strArray[1]).format('0,0.00'));
        $('#viewactualamt3').text(numeral(strArray[2]).format('0,0.00'));
        $('#viewactualamt3').text(numeral(strArray[2]).format('0,0.00'));

        $('#perdivisionbudget3').attr('max', strArray[1]);
        $('#actualTA3').attr('max', strArray[2]);

        $('.allocatealla3').on('click', function()
        {
            // alert(strArray[2])
            $('#perdivisionbudget3').val(strArray[1])
            $('#actualTA3').val(strArray[2])
        })
    });
    $('table[id="saroannualbudgettable"]').on('click', 'button[id="allocate_id"]', function () {
        var value = $(this).attr('data-id');
        var strArray = value.split("||");
        $('.allbud').val(strArray[0]);
        $('#annual_budget_id3').val(strArray[3]);
        $('#viewperdev3').text(numeral(strArray[1]).format('0,0.00'));
        $('#viewactualamt3').text(numeral(strArray[2]).format('0,0.00'));
        $('#viewactualamt3').text(numeral(strArray[2]).format('0,0.00'));

        $('#perdivisionbudget3').attr('max', strArray[1]);
        $('#actualTA3').attr('max', strArray[2]);

        $('.allocatealla3').on('click', function()
        {
            // alert(strArray[2])
            $('#perdivisionbudget3').val(strArray[1])
            $('#actualTA3').val(strArray[2])
        })
    });

    $("#fundSource_id2").on('select2:select', function()
    {
        var annual_parent = $(this).find(':selected').attr('data-parent');
        document.getElementById("budget-message").style.display = "none";
        if (annual_parent == 'GAA') {
            document.getElementById("SAA-GROUP").style.display = "none";
        }else{document.getElementById("SAA-GROUP").style.display = "block";}
        if (annual_parent == 'SAA' || annual_parent == 'SARO') {
            document.getElementById("GAA-GROUP").style.display = "none";
        }else{document.getElementById("GAA-GROUP").style.display = "block";}
        // alert($(this).find(':selected').attr('data-nep'));
        // var bsourcenum = numeral($(this).find(':selected').attr('data-nep')).format('0,0.00');
        // $('#viewactualamt').text(bsourcenum);
        // $('#actualTA').attr('max', $(this).find(':selected').attr('data-nep')) ;
        // var perdev = numeral($(this).find(':selected').attr('data-projected')).format('0,0.00');
        // $('#viewperdev').text(perdev);
        // $('#perdivisionbudget').attr('max', $(this).find(':selected').attr('data-projected')) ;
        // theme: 'bootstrap4',
        // // width: '300px'
    });

    $("#wfp_id1").on('select2:select', function()
    {
        // alert('sdf')
        // var annual_parent = $(this).find(':selected').attr('data-parent');
        document.getElementById("budget-message").style.display = "none";
        document.getElementById("PPMP-Group1").style.display = "block";
    });

    function generatePassword() {
        var length = 8,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        return retVal;
    }
    // console.log(generatePassword());

    $('#firstCategory11').bind('paste', null, function (e){
        var txt = $(this);
        // console.log('================================')
        setTimeout(function (){
            var values = txt.val().split(/\s+/);
            console.log(values)
        }, 0)
    })

    // $('#understood').on('click', function() {
    //     if ($(this).is(":checked")) {
    //         $("#submitsubmit").removeAttr("disabled");
    //     } else {
    //         $("#submitsubmit").attr("disabled", "disabled");
    //     }
    // })
    $('#temp').on('click', function() {
        console.log($this.val());
    });

    // $("#refresh").on("click", function () {
    //     tableuserstable.ajax.reload(null, false);
    // });
});
