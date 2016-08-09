$(document).ready(function() {
      $(document).on("change","#UploadFiles",function(event)
      {
            $('#nomfichier').html('')
            console.log(tail = event.target.files.length);
            for (var i = 0; i < tail; i++) {
                  console.log( event.target.files[i]);
                  name = event.target.files[i].name;
                  poid = event.target.files[i].size / 1024 / 1024;
                  mo = poid.toFixed(2);
                  console.log(mo)
                  $("#nomfichier").append("<tr><td>"+name+"</td> <td>"+mo+" Mo</td></tr>")
                  console.log(name);
            }
      });
});
