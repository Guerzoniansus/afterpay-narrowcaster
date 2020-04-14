
<div class="calendar-div" style="width: 100%; height: 100%">

</div>

<script>

    function loadCalendar() {
        $('.calendar-div').load("/widgets/calendar/calendar-handler.php", {action: "load"});
    };

    $(document).ready(function() {

        loadCalendar();

    });
</script>
