//Use DOM to get Database-status field
function checkDBStatus()
{
  var div = document.getElementById("Database-Status");
  var DBStatus = div.textContent;

  alert(DBStatus);
}
