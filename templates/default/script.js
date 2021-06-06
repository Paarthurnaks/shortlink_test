function AjaxQuery()
{
    document.forms[0].onsubmit = function(e) {
        e.preventDefault();
        let shotrlink = document.getElementById('form0_link');

        let xhr = new XMLHttpRequest();

        xhr.open("POST", "/handlers/builder.php?original_link=" + shotrlink.value);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(shotrlink);
        xhr.onreadystatechange = function() {
            if(xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('shortlink_result').innerHTML = xhr.responseText;
            }
        }
    }
}