setInterval(addPoints,10000);
function addPoints() {
        const Http = new XMLHttpRequest();
        const url = 'https://micronodes.tech/client/panel/afk';
        Http.open("POST", url);
        Http.send();
        Http.onreadystatechange = (e) => {
            if (Http.responseText != "") {
                document.getElementById("points").innerHTML = Http.responseText;
            }
        }
}
