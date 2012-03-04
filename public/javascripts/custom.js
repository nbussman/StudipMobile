
// global counter of the 
var dropbox_counter = 0;
// global indicator for upload or login errors
var dropbox_fail    = false;


/*
 * You use this function to upload a specified 
 * file to a specified folder in the users dropbox
 * via a Jquery Ajax Call.
 * No existing folders are created. 
 * Dependencies: 
 *    - users dropbox should be connectet via 
 *      dopbox php api project
 *    - jQuery should be included
 *    - needs an div width id ="uploadList"
 * 
 * @param filename the path to file 
 * @param folder folder in the users dropbox to put the file
 * @return creates li elements in the div width the status message
 */
function uploadFileDropbox(filename, folder)
{
	dropbox_counter++;
	$.ajax(
	{
	  	type: "GET",
	  	url: "upload.php",
		data: "filename=" + filename + "&folder=" + folder,
		success: function( data )
		{
			dropbox_counter--;
			
			if( data.substring(0,7) == "success" )
			{
				data = "Erfolgreich: " + data.substring(8,data.length);
			}
			if( data.substring(0,6) == "exists" )
			{
				data = "Existiert bereits: " + data.substring(7,data.length);
			}
			else if ( data.substring(0,4) == "fail" )
			{
				data = "Fehler: " + data.substring(5,data.length);
				dropbox_fail = true;
			}
			var newLI           = document.createElement("li");
			newLI.innerHTML =  data;
			document.getElementById("uploadList").appendChild(newLI);
			if (( dropbox_fail == false ) && ( dropbox_counter == 0 ))
			{
				newLI           = document.createElement("li");
				newLI.innerHTML =  "Alle Dateien aktualisiert";
				document.getElementById("uploadList").appendChild(newLI);
			}
		},
		error: function()
		{
			var newLI           = document.createElement("li");
			newLI.innerHTML =  "Fehler: " + filename;
			document.getElementById("uploadList").appendChild(newLI);
		}
		
	});
}
