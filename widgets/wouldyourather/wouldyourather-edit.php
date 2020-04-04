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


<div style="margin: 0 30px 0 30px">
    <h2 align="center">Would you rather?</h2>
    <p align="center" class="w-75 mx-auto">This widget will show a random <b>"would you rather?"</b> question to start a conversation about, chosen from a list of 198 questions.</p>
    <p align="center" class="w-75 mx-auto">Below is a possible question. Keep in mind that questions are random and the one shown on the slideshow might be a different question than this one.</p>

    <p class="wouldyourather-text" align="center">
        "<?= loadRandomWouldyouratherQuestion() ?>"
    </p>
</div>
