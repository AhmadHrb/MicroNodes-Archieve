let data;
async function getEggs() {
        let servertype = parseInt(document.getElementById('servertype').value);  
	document.getElementById('eggs').innerHTML = "<option>Loading..</option>";
        data = await fetch("https://micronodes.tech/client/panel/create/eggs.php?nest=" + servertype, {
  "method": "GET",
  "headers": {
    "Accept": "application/json",
    "Content-Type": "application/json"}
})
  .then(response => response.json())
  .catch(err => console.error(err));
	document.getElementById("eggs").innerHTML = "";    
    for (let i=0;i<data.length;i++) {
            document.getElementById('eggs').innerHTML += "<option value='" + data[i].attributes.id + "'>" + data[i].attributes.name + "</option>"
}
}

