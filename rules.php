<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<title>Paradise Station</title>
	<link rel="stylesheet" type="text/css" href="reset.css">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
	<link rel="icon" href="Images/favicon.png">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="disableFind.js"></script>
	<script type="text/javascript" language="javascript">
	 $(document).ready(function () {
	     $('.unsearchable').disableFind();
	 });
	</script>
    </head>
    <body>
	<div class="wrapper">
	    <nav>
		<ul>
		    <li id ="logo">  <a href="/"><img src="Images/Paradise2icon.PNG" alt="server logo"></a></li>
		    <li id="server"> <a href="byond://byond.nanotrasen.se:6666">Server</a></li>
		    <li id="patreon"><a href="https://www.patreon.com/ParadiseStation">Patreon</a></li>
		    <li id="wiki">   <a href="https://nanotrasen.se/wiki/index.php/Main_Page">Wiki</a></li>
		    <li id="forums"> <a href="https://nanotrasen.se/forum/">Forums</a></li>
		    <li id="discord"><a href="https://discord.gg/nuqD478">Discord</a></li>
		    <li id="github"> <a href="https://github.com/ParadiseSS13/Paradise">GitHub</a></li>
		    <li id="stats">  <a href="stats.php">Stats</a></li>
		</ul>
	    </nav>
	    <main id="content">
		<h1>Server Rules</h1>
		<h2>Abbreviations for common terms used on the server.</h2>
		<ol>
		    <li><u>RP: Roleplay</u> - To take up a character and act like they would, performing out their emotions, feelings, characteristics and actions.</li><br>
		    <li><u>IC: In Character</u> - When you are Roleplaying and are in your character.</li><br>
		    <li><u>OOC: Out of Character</u> - This has two applications within the server.</li><br>
		    <li>Something done outside of your character, this may be a list of things but all boil down to things that would not been done while In Character.</li><br>
		    <li>To use the server wide OOC chat, where you may talk OOCly with other players about various things.</li><br>
		    <li><u>LOOC: Local Out of Character</u> - Only the people near your character will see this out of character text.</li><br>
		    <li><u>Deadchat</u>: A special chat for observers/ghosts who've died in game. People are free to discuss current round information in this chat, and it is considered to be another form of OOC.</li><br>
		    <li><u>SSD: Sudden Sleep Disorder</u> - When a player disconnects or loses connection, his character will fall over and begin to sleep. This phenomenon is referred to as going ‘SSD.’</li><br>
		    <li><u>Antag: Antagonist</u> - A player that has gotten an antagonist role, designed to add some chaos to the round to make things fun.</li><br>
		    <li><u>Valid</u>: Mostly referring to Antagonists that are able to be killed by other players under any context. Certain Antagonists (Nuke ops, Wizard, Blob, Xenos, Terror Spiders) are all considered valid, while others (Traitor, Changeling, Cult, Shadowlings) are not. Cluwnes are always valid under any and all circumstances.</li><br>
		    <li><u>Murderboning: Excessive Killing</u> - A player who excessively kills everyone in his path not because he has to but rather he wants to do so.</li><br>
		    <li><u>Self Antaging: Antagonizing without being an Antag</u> - Self Antaging refers to players who decide to do actions that normally only a Antagonist would do, i.e; Murdering other players, heavily damaging the station or causing chaos on a mass scale.</li>
		</ol>
		<?php
		echo '<br>';
		$rules_string = ' Adminhelping the words Emulated Feelings will also let us know you\'ve read the Rules;';
		$data = json_decode(file_get_contents('./rules.json'), true);
		$rules = $data['rules'];
		$secret_rule_indices = array();

		for ($i = 0; $i < count($rules); $i++) {
		    if ($rules[$i]['can_have_secret_words']) {
			array_push($secret_rule_indices, $i);
		    }
		}

		$secret_rule_index = $secret_rule_indices[0];

		if (isset($_GET['seed'])) {
		    $seed = hexdec(substr(sha1($_GET['seed']), 0, 15));
		    srand(intval($seed));
		    /* This list of words is taken from eff-short, designed by the EFF for passphrase generation and is licensed under CC BY 3.0. */
		    $words = $data['words'];
		    $secret_rule_index = $secret_rule_indices[rand(0, count($secret_rule_indices) - 1)];
		    $word1 = $words[rand(0, count($words) - 1)];
		    $word2 = $words[rand(0, count($words) - 1)];
		    $secret_words = "{$word1} {$word2}";
		    $rules_string = " <span class=\"unsearchable\">Adminhelping the words</span> {$secret_words} <span class=\"unsearchable\">will also let us know you've read the Rules;</span>";
		}

		for ($i = 0; $i < count($rules); $i++) {
		    $rule_title = $rules[$i]['title'];
		    echo "<br><h2>{$rule_title}</h2>";
		    $rule_lines = $rules[$i]['lines'];
		    echo '<p>';

		    $secret_line_index = -1;
		    if ($i === $secret_rule_index) {
			$secret_line_index = rand(1, count($rule_lines) - 1);
		    }

		    for ($j = 0; $j < count($rule_lines); $j++) {
			echo $rule_lines[$j];
			if ($secret_line_index === $j) {
			    echo $rules_string;
			}
			echo '<br><br>';
		    }
		    echo '</p>';
		}
		?>
	    </main>
	</div>
	<footer><p>This webpage is licensed under the MIT License (MIT).</p></footer>

    </body>
</html>
