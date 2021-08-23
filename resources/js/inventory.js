    $(document).ready(function() {
        $('table[id="twg_itemsRequest"]').on('click', 'button[id="markdone"]', function () {
            var value = $(this).attr('data-id');
            var strArray = value.split("||");
            $('#firstCategory1').val(strArray[0]);
            $('#secondCategory1').val(strArray[1]);
            $('#description1').val(strArray[2]);
            $('#category1').val(strArray[3]).trigger('change');
            $('#itemCost1').val(strArray[4]);
            $('#unit1').val(strArray[5]).trigger('change');
            $('#category1').val(strArray[6]);
            $('#id1').val(strArray[7]);
            // alert(strArray[8])
            $('#branch1').val(strArray[8]).trigger('change');
            // alert(strArray[8]);
            // $('#status1').val(strArray[9]).trigger('change');
        });
    });
