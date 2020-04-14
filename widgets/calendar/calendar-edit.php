<?php


?>

<style>
	.calendar-form{
		font-size: 175%;
		padding: 10px;
		padding-top: 2px;

	}

	.calendar-submit-button {
		cursor:pointer;
		border: 1px solid transparent;
		border-radius:5px;
		background-color:rgba(135, 205, 155, 0.5);
	}

	.calendar-submit-button:hover {
		background-color: rgba(135, 205, 155, 0.8);
	}

	.calendar-input {
		padding:2px;
		border: 1px solid rgba(135, 205, 155, 0.8);
		border-radius:5px;
	}

	.calendar-input:focus {
		outline:none;
	}
</style>

<div class="calendar-div" style="width: 90%; height: 90%">

</div>
<h3 style="margin:0px;">Insert Google Calendar URL here</h3> <p>Height and Width will automatically get adjusted -
    Click <a target="_" href="https://support.google.com/calendar/answer/41207?hl=en">HERE</a> for instructions on how to get the URL</p>
<form method="post" class="calendar-form">
	<input type="text" name="calendar-url" class="calendar-input">
	<button class="calendar-submit-button" type="submit">Save</button>
</form>
<script>

	function loadCalendar() {
	    $('.calendar-div').load("/widgets/calendar/calendar-handler.php", {action: "load"});
	};

	function saveCalendar(URL) {
        $.post('/widgets/calendar/calendar-handler.php', {
            action: "save",
			URL: URL
			}, function() {
            loadCalendar();
        });
	};

    $(document).ready(function() {

        loadCalendar();

        $(".calendar-form").submit(function(e) {
            e.preventDefault();

            //TODO: Fix bug where this doesnt work when theres multiple of the same widgets on the same page
            let calendarURL = $(".calendar-input").val();

            saveCalendar(calendarURL);
        });

	});
</script>
