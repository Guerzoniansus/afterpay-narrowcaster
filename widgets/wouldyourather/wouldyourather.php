<?php


function loadRandomWouldyouratherQuestion() : string {
    $file = "widgets/wouldyourather/questions.txt";
    $contents = file_get_contents($file);
    $questions = explode("\n", $contents);
    $question = $questions[array_rand($questions)];
    return $question;
}

?>
<link rel="stylesheet" href="widgets/wouldyourather/wouldyourather.css">


<div style="margin: 0 30px 0 30px;">
    <img class="mx-auto" width="300"  src="widgets/wouldyourather/speechbubble.png" style="display: block">
    <br>
    <p class="wouldyourather-text" align="center" style="align-self: center">
        "<?= loadRandomWouldyouratherQuestion() ?>"
    </p>
</div>

