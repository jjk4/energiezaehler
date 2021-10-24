<?php include("header.php");?>
<script>
    $.get( "visu-backend.php", { v: "month", m: "16", d: "2019-08"} )
        .done(function( data ) {
        alert( "Data Loaded: " + data );
    });
</script>