<?php
function validate($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function noHtml($input, $encoding = 'utf-8')
{

    return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}
