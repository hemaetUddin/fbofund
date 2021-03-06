function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>Rendering engine:</td><td>'+aData[1]+' '+aData[4]+'</td></tr>';
    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
    sOut += '</table>';

    return sOut;
}



$(document).ready(function() {

    // $('#dynamic-table').dataTable( {
    //     "aaSorting": [[ 4, "desc" ]]
    // } );

    var oTable = $('#transactionTable').dataTable({
        "aLengthMenu": [
            [10, 30, 50, -1],
            [10, 30, 50, "All"] // change per page values here
        ],
        // set the initial value
        "iDisplayLength": 4,
        "bFilter": false,
        "bLengthChange": false,
        "showNEntries" : false,
        "bLengthChange": false,
            "bInfo": false,
            "bAutoWidth": false,
         "info":     false,
        "sDom": '<"row view-filter"<"col-sm-12"<"pull-left"l><"pull-right"f><"clearfix">>>t<"row view-pager"<"col-sm-12"<"text-center"ip>>>',
        // "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sLengthMenu": "_MENU_ records per page",
            "oPaginate": {
                "sPrevious": "Prev",
                "sNext": "Next"
            }
        },
        "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0]
            }
        ]
    });


    var oTable = $('#supportQuery-table').dataTable({
           "aLengthMenu": [
               [3, 15, 20, -1],
               [3, 15, 20, "All"] // change per page values here
           ],
           // set the initial value
           "iDisplayLength": 3,
           "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
           "sPaginationType": "bootstrap",
           "oLanguage": {
               "sLengthMenu": "_MENU_ records per page",
               "oPaginate": {
                   "sPrevious": "Prev",
                   "sNext": "Next"
               }
           },
           "aoColumnDefs": [{
                   'bSortable': false,
                   'aTargets': [0]
               }
           ]
       });


    /*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="images/details_open.png">';
    nCloneTd.className = "center";

    $('#hidden-table-info thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

    $('#hidden-table-info tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
    var oTable = $('#hidden-table-info').dataTable( {
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $(document).on('click','#hidden-table-info tbody td img',function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
             // This row is already open - close it 
            this.src = "images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
             // Open this row 
            this.src = "images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
} );