<?php
echo "<h1>Start script</h1>";

echo "<div id=\"myDiv\">

</div>

<script>
    let div = document.getElementById(\"myDiv\");
    let ul = document.createElement(\"ul\");

    for (let i = 0; i < 3; i++) {
        let li = document.createElement(\"li\");
        li.innerText = i;
        ul.appendChild(li);
    }
    
    div.appendChild(ul);


</script>
";


echo "<h1>Script End</h1>";
echo "\n\n\n";
