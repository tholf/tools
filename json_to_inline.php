<?php
/* *
 *** Converts formatted or unformatted JSON into inline formatted JSON
 ***
*/

function to_inline_json($string) {
    return json_encode(json_decode($string), JSON_UNESCAPED_SLASHES);
}
function to_prettyprint_json($string) {
    return json_encode(json_decode($string), JSON_PRETTY_PRINT);
}

$sample = '{"something":"else"}';
$inout_placeholder = print_r(to_prettyprint_json($sample), true);
$output_placeholder = print_r(to_inline_json($sample), true);

if (isset($_POST['content'])) {
    $result = !empty($_POST['content']) ? print_r(to_inline_json($_POST['content']), true) : $output_placeholder;
} else {
    $result = '';
}

?><html xmlns="http://www.w3.org/1999/xhtml" lang="us">
<head>
    <title>JSON to Inline</title>
    <?php include "includes/head.php"; ?>
</head>
<body>
    <div class="container">
        <h2><a href="index.php">Tools</a> :: JSON to Inline</h2>
        <?php include "includes/dev_menu.php"; ?>

        <div class="content">
            <form action='' method='post'>
                <label>
                    JSON
                    <textarea name="content" class="input" placeholder='<?php echo $inout_placeholder; ?>'></textarea>
                </label>
                <button type="submit" name="submit" id="submit">go</button>
                <?php if (isset($_POST['content'])) { ?>
                    <button type="button" name="reset" id="reset" onclick="window.history.back();">reset</button>
                <?php } ?>
            </form>
            <label>
                Inline JSON
                <textarea
                        id="result"
                        class="result"
                        placeholder='<?php echo $output_placeholder ?>'
                ><?php echo $result; ?></textarea>
            </label>
        </div>
    </div>
    <script>
        let resultTextarea = document.getElementById('result');
        resultTextarea.style.height = (resultTextarea.scrollHeight + 10) + "px";
    </script>
</body>
</html>
