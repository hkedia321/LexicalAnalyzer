<?php
if(isset($_POST['submit'])){
	$fileName=$_FILES["fileToUpload"]["name"];
	function __autoload($class)
	{
		$class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
		require_once(__DIR__ . "/lib/$class.php");
	}
	$file = file_get_contents($fileName);
/**
 * We have a new instance of the LaTeX lexical analyzer, that will parse
 * the input string when we call the parse method, returning an array
 * of token objects
 */
$latex = new LexicalAnalyzer\Analyzers\LatexAnalyzer;
$tokens = $latex->parse($file);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
	body{
		background-color: #fefefe;
	}
		.table-div{
			min-height: 90vh;
		}
		hr{
			background-color: black;
			color: black;
			border:solid 2px black;
		}
		.red,.count{
			color: red;
		}
		.KEYWORD{
			color: red;
		}
		.key-color-keyword{
			height: 0.5rem;
			width: 0.5rem;
			padding: 0.05rem 0.5rem;
			background-color: red;
		}
		.PUNCTUATION{
			color: blue;
		}
		.key-color-punctuation{
			height: 0.5rem;
			width: 0.5rem;
			padding: 0.05rem 0.5rem;
			background-color: blue;
		}
		.WHITESPACE{
			color: grey;
		}
		.key-color-whitespace{
			height: 0.5rem;
			width: 0.5rem;
			padding: 0.05rem 0.5rem;
			background-color: grey;
		}
		.INDENTIFIER{
			color: green;
		}
		.key-color-identifier{
			height: 0.5rem;
			width: 0.5rem;
			padding: 0.05rem 0.5rem;
			background-color: green;
		}
		.NUMBER{
			color: #dfcd30;
		}
		.key-color-number{
			height: 0.5rem;
			width: 0.5rem;
			padding: 0.05rem 0.5rem;
			background-color: #dfcd30;
		}
		.COMMENT{
			color: #00bcd4;
		}
		.key-color-comment{
			height: 0.5rem;
			width: 0.5rem;
			padding: 0.05rem 0.5rem;
			background-color: #00bcd4;
		}
		.key-color-all{
			height: 0.5rem;
			width: 0.5rem;
			padding: 0.05rem 0.5rem;
			background-color: black;
		}
		.key-wrap span{
			transition: 1s all ease;
		}
		.key-wrap span:hover{
			cursor: pointer;
			text-decoration: underline;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="col-md-8 col-md-offset-2 table-div table-responsive">
			<h1 class="text-center"><u>Lexical Analyzer</u></h1>
			<h4 class="text-right"> - Under the guidance of <b>Prof. Sendhil Kumar K.S</b></h4>
			<h3 align="left">What is Lexical Analyzer?</h3>
			<p>Lexical analysis is the first phase of a compiler. It takes the modified source code from language pre-processors that are written in the form of sentences. The lexical analyser breaks these syntaxes into a series of tokens, by removing any whitespace or comments in the source code.
				If the lexical analyser finds a token invalid, it generates an error. The lexical analyser works closely with the syntax analyser. It reads character streams from the source code, checks for legal tokens, and passes the data to the syntax analyser when it demands.
			</p>
			<h3>Upload a source code</h3>
			<form action="#" method="POST" enctype="multipart/form-data"">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-sm-4">Upload the source code file:</label>
						<div class="col-sm-4">
							<input type="file" class="btn" name="fileToUpload" id="fileToUpload">
						</div>
						<div class="col-sm-4">
							<input type="submit" class="btn btn-primary" name="submit">
						</div>
					</div>
				</div>
			</form>
			<br>
			<?php
			if(isset($_POST['submit'])){
				echo "<h3>Code found:</h3>";
				echo "<pre>";
				print_r(htmlspecialchars($file));
				echo "</pre>";
				echo "<h3>Showing Lexical Analysis of <span class='red'>".$fileName."</span> file:</h3>";
			}
			?>
			<div class="row spanrow">
				<div class="key-wrap col-xs-6 col-sm-2">
					<span class="key-color-all spanall" href="">&nbsp;</span>
					<span class="key-word spanall">showall</span>
				</div>
			</div>
			<div class="row">
				<div class="key-wrap col-xs-6 col-sm-2">
					<span class="key-color-keyword spankeyword" href="">&nbsp;</span>
					<span class="key-word spankeyword">Keyword</span>
				</div>
				<div class="key-wrap col-xs-6 col-sm-2">
					<span class="key-color-punctuation spanpunctuation">&nbsp;</span>
					<span class="key-word spanpunctuation">punctuation</span>
				</div>
				<div class="key-wrap col-xs-6 col-sm-2">
					<span class="key-color-whitespace spanwhitespace">&nbsp;</span>
					<span class="key-word spanwhitespace">whitespace</span>
				</div>
				<div class="key-wrap col-xs-6 col-sm-2">
					<span class="key-color-identifier spanidentifier">&nbsp;</span>
					<span class="key-word spanidentifier">identifier</span>
				</div>
				<div class="key-wrap col-xs-6 col-sm-2">
					<span class="key-color-number spannumber">&nbsp;</span>
					<span class="key-word spannumber">number</span>
				</div>
				<div class="key-wrap col-xs-6 col-sm-2">
					<span class="key-color-comment spancomment">&nbsp;</span>
					<span class="key-word spancomment">comment</span>
				</div>
			</div>
			<br>
			<table class="table table-bordered table-hover" id="table">
				<thead>
					<tr>
						<th>Line,position</th>
						<th>token</th>
						<th>type</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(isset($_POST['submit'])){
						foreach ($tokens as $token) {
							if(!isset($token->type) or empty($token->type))
								$totype="None";
							else
								$totype=$token->type;
							$totype=substr($totype,2);
							if($token->value=='include'||$token->value=='for'||$token->value=='return'||$token->value=='int'||$token->value=='double'||$token->value=='float'||$token->value=='while'||$token->value=='do'||$token->value=='continue'||$token->value=='break'||$token->value=='goto'||$token->value=='class'||$token->value=='public'||$token->value=='private')
								$totype="KEYWORD";
							echo "<tr class='{$totype} trow'>";
							echo "<td>{$token->line}, {$token->column}</td>";
							echo "<td>".str_replace(PHP_EOL, '', $token->value) . PHP_EOL."</td>";
							echo "<td>{$totype}</td>";
				//echo "{$token->type} at {$token->line}, {$token->column}:" . str_replace(PHP_EOL, '', $token->value) . PHP_EOL;
							echo "</tr>";
						}
					}
					else{
						echo "<h3 class='red'>No file is choosen</h3>";
					}
					?>
				</tbody>
			</table>
				<p class="count"></p>
		</div>
	</div>
	<footer>
		<hr>
		<div class="container">
			<div class="pull-left">Theory of Computation<br>CSE2002<br>slot-F1</div>
			<div class="pull-right">Project by:
				<ul>
					<li><b>Harshit Kedia</b> (15BCE0329)</li>
					<li><b>Vinit Bodhwani</b> (15BCE0719)</li>
					<li><b>Ratnasambhav Priyadarshi</b> (15BCE0646)</li>
				</ul>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function update_count(){
			var trs=$(".show-tr");
			var show_len=trs.length;
			$(".count").html("No. of tokens:"+show_len);
		}
		$(".spanrow").hide();
		$(".trow").show();
		$(".trow").addClass('show-tr');
		update_count();
		$(".spankeyword").click(function(){
			$(".trow").removeClass('show-tr');
			$(".trow").hide();
			$(".KEYWORD").addClass('show-tr');
			$(".KEYWORD").show();
			$(".spanrow").show();
			update_count();
		});
		$(".spanpunctuation").click(function(){
			$(".trow").removeClass('show-tr');
			$(".trow").hide();
			$(".PUNCTUATION").addClass('show-tr');
			$(".PUNCTUATION").show();
			$(".spanrow").show();
			update_count();
		});
		$(".spanwhitespace").click(function(){
			$(".trow").removeClass('show-tr');
			$(".trow").hide();
			$(".WHITESPACE").addClass('show-tr');
			$(".WHITESPACE").show();
			$(".spanrow").show();
			update_count();
		});
		$(".spanidentifier").click(function(){
			$(".trow").removeClass('show-tr');
			$(".trow").hide();
			$(".INDENTIFIER").addClass('show-tr');
			$(".INDENTIFIER").show();
			$(".spanrow").show();
			update_count();
		});
		$(".spannumber").click(function(){
			$(".trow").removeClass('show-tr');
			$(".trow").hide();
			$(".NUMBER").addClass('show-tr');
			$(".NUMBER").show();
			$(".spanrow").show();
			update_count();
		});
		$(".spancomment").click(function(){
			$(".trow").removeClass('show-tr');
			$(".trow").hide();
			$(".COMMENT").addClass('show-tr');
			$(".COMMENT").show();
			$(".spanrow").show();
			update_count();
		});
		$(".spanall").click(function(){
			$(".trow").show();
			$(".spanrow").removeClass('show-tr');
		});

	</script>
</body>
</html>