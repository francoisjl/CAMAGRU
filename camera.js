
class Cfusion
{
  constructor(fond)
  {

    //alert('fond construct : '+this.fond+' ' +fond);
    this.fond_select = fond; // this est important pour une variable de la classe et non de fonction
    //alert(' fond initial '+this.fond_select);

      // Prefer camera resolution nearest to 1280x720.
    var constraints = { audio: false, video: { width: 1280, height: 720 } }; 

    navigator.mediaDevices.getUserMedia(constraints)
    .then(function(mediaStream)
    {
      var video = document.querySelector('#video');
      video.srcObject = mediaStream;
      //var canvas = document.querySelector('#canvas');
      //alert(canvas+this.canvas.width);
      video.onloadedmetadata = function(e) { video.play(); };
    })
    .catch(function(err) { console.log(err.name + ": " + err.message); })
  }



      uploadEx() {
          var canvas = document.getElementById("canvas"); // div du canvas
          var dataURL = canvas.toDataURL("image/png"); // format sera image en png
          document.getElementById('hidden_data').value = dataURL; // input du form qui contiendra l'image pour envoi
          var fd = new FormData(document.forms["form1"]); // nom du form

          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'fusion.php', true);

          xhr.upload.onprogress = function(e) {
              if (e.lengthComputable) {
                  var percentComplete = (e.loaded / e.total) * 100;
                  console.log(percentComplete + '% uploaded');
                  alert('Succesfully uploaded');
              }
          };

          xhr.onload = function() {

          };
          xhr.send(fd);
      }



  draw()
  {
    //alert(' fond actif : '+this.fond_select);
 
    var canvas = document.querySelector('#canvas');
    var inputfond = document.querySelector('#hidden_fond');
    var ctx = canvas.getContext('2d');
    var canvaswidth = canvas.width;
    var canvasheight = canvas.height;
    // Draw photo
    ctx.drawImage(video, 1, 1, canvaswidth, canvasheight);
    // on transfère au serveur la photo avant fusion avec le nom du fond 
    //alert(inputfond+' '+this.fond_select);
    inputfond.value = this.fond_select;
    traitement.uploadEx();
    // Draw background
    ctx.drawImage(document.getElementById(this.fond_select), 0, 0, canvaswidth, canvasheight);
    // effacer video et afficher fusion
    video.style.display = "none";
    canvas.style.display = "inline";
  }

  changefond(nom)
  {
  this.fond_select = nom;
 alert(' changement du fond : '+this.fond_select);
  }

}

const traitement = new Cfusion('fond02');

