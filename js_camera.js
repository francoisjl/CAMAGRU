
class Cfusion
{

  constructor(fond) // ***** charge la vidéo 
  {
    this.image_selected = 'not selected';
    var page = document.location.href;
    if ( page.substring(page.length -8) != 'home.php') { return;} // on ne charge pas la video
    this.fond_select = fond; // this est important pour une variable de la classe et non de fonction 
    this.previous_imgt_id = ''; // gestion du bord de l'imagette fond 
    var video = document.querySelector('#video');

    //this.btn_activer_camera = document.querySelector('#activer_camera');
    // seul this.btn_activer_camera peut être utiliser dans une methode de la class
    // donc pas nécessaire
    // il suffit d'utiliser activer_camera.style.display == "none" sans document.querySelector ou getElementById

    // Prefer camera resolution nearest to 1280x720.
    var constraints = { audio: false, video: { width: 480, height: 360 } }; 

    navigator.mediaDevices.getUserMedia(constraints)
    .then(function(mediaStream)
    {
        video.srcObject = mediaStream;
        video.onloadedmetadata = function(e) { video.play(); };
    })
    .catch(function(err)
    {
       console.log(err.name + ": " + err.message);
    })
  }

  uploadEx() // ***** transfert le fichier de la vidéo figé
  {
    var dataURL = canvas.toDataURL("image/png"); // format sera image en png
    document.getElementById('hidden_data').value = dataURL; // input du form qui contiendra l'image pour envoi
    var fd = new FormData(document.forms["form1"]); // nom du form

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fusion.php', true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
        }
    };

    xhr.onload = function() {
    };
    xhr.send(fd);
  }

  draw(Id) // ***** fige la vidéo à l'écran
  {
    var ctx = canvas.getContext('2d');
    var canvaswidth = canvas.width;
    var canvasheight = canvas.height;
    // Draw photo
    ctx.drawImage(video, 0, 0, canvaswidth, canvasheight);
    // on transfère au serveur la photo avant fusion avec le nom du fond 
    //var inputfond = document.querySelector('#hidden_fond');
    var inputfond = document.getElementById('hidden_fond');
    inputfond.value = this.fond_select;
    traitement.uploadEx();
    // Draw background
    ctx.drawImage(document.getElementById(this.fond_select), 0, 0, canvaswidth, canvasheight);
    // effacer video et afficher fusion
    video.style.display = "none";
    div_video.style.visibility = "hidden";
    div_fond.style.visibility = "hidden";
    div_canvas.style.visibility = "visible";
    canvas.style.display = "inline";
    draw.style.display = "none";
    activer_camera.style.display = "inline";
    msg_fonds.style.display = "none";
    // ajout de l'image dans la liste
    alert('Transfert réussi');
    traitement.refresh_usr(Id, 'user_imgs');
    
  }

    draw_file(Id) // ***** affiche le fichier à l'écran
  {
    //https://developer.mozilla.org/fr/docs/Web/API/FileReader#readAsDataURL()
    
    
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    var fichier = document.getElementById('inputfile').files;

    if (!fichier) {alert('Choisir votre fichier'); return;}
    var charge = new FileReader();
    if (!fichier[0].type.match('image.*')) { alert('Format de fichier interdit'); return;}
    charge.readAsDataURL(fichier[0]);

        var inputfond = document.getElementById('hidden_fond');
        inputfond.value = this.fond_select;
        charge.onloadend = function(e)
    {
        img_file.src = e.target.result;
        var id_img_file = document.getElementById('img_file');

        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext('2d');
        var canvaswidth = canvas.width;
        var canvasheight = canvas.height;

        ctx.drawImage(id_img_file, 0, 0, canvaswidth, canvasheight);

        traitement.uploadEx();
        alert('Transfert réussi');
        traitement.refresh_usr(Id, 'user_imgs');
        traitement.refresh_canvas();

    document.getElementById("inputfile").value = ""; // reset inpu file


    }// charge.onloadend = function(e){   

  }

  refresh_canvas()
  {
    var inputfond = document.getElementById('hidden_fond');
    inputfond.value = this.fond_select;

    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext('2d');
    var canvaswidth = canvas.width;
    var canvasheight = canvas.height;
    // Draw background
    ctx.drawImage(document.getElementById(this.fond_select), 0, 0, canvaswidth, canvasheight);
    // effacer video et afficher fusion
    video.style.display = "none";
    div_video.style.visibility = "hidden";
    div_fond.style.visibility = "hidden";
    div_canvas.style.visibility = "visible";
    canvas.style.display = "inline";
    draw.style.display = "none";
    activer_camera.style.display = "inline";
    msg_fonds.style.display = "none";

  }

  test(var1)
  {
    alert(var1);
    //traitement.refresh_usr('1', 'user_imgs');
  }

  changefond(id) // ***** sélectionne le fond
  {
    this.fond_select = id;
    if (activer_camera.style.display == "none" ) draw.style.display = "inline";
    div_transfert.style.display = "inline";
    msg_fonds.style.display = "none";
    var imagette_fond = document.getElementById(id); // div du fond souhaité
    imagette_fond.style.border='1px solid #E8272C';
    // on desactive le bord de l'ancien fond
    if (this.previous_imgt_id) {var previous = this.previous_imgt_id; var imgt_fond_previous = document.getElementById(previous); imgt_fond_previous.style.border='0px solid #E8272C';}
    var url = "url('fonds/"+id+".png')"; // on recupère le nom du fond
    div_fond.style.backgroundImage = url ;//= 'fonds/fond01.png';
    this.previous_imgt_id = id;
    // mise a jour text div fond et hidden
    div_fond_text.innerHTML = id;
    div_fond_text.style.display = "none";  
    //div_transfert.style.display = "none";  
    var inputfond = document.getElementById('hidden_fond');

  }


   camera(Id) // ***** réactive la caméra 
  {
    var canvas = document.getElementById("canvas");

    draw.style.display = "inline";
    video.style.display = "inline";
    canvas.style.display = "none";
    div_video.style.visibility = "visible";
    div_fond.style.visibility = "visible";
    div_canvas.style.visibility = "hidden";
    div_transfert.style.display = "inline";
    activer_camera.style.display = "none";
    traitement.refresh_usr(Id, 'user_imgs');

    var ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  }

    Fajax( page_php, to_send, id_div, caller) // ***** échange les demandes avec le serveur 'ajax_usr.php' 
  {
    if (window.XMLHttpRequest) var XHR = new XMLHttpRequest(); // Mozilla, Safari, ...
    if (window.ActiveXObject) var XHR = new ActiveXObject("Microsoft.XMLHTTP"); // IE
    if (!window.XMLHttpRequest || window.ActiveXObject) {alert('Erreur initialisation Ajax'); return;}
    XHR.overrideMimeType('text/xml');
    XHR.open('GET', page_php+to_send, true);
    XHR.onreadystatechange = function (aEvt)
    {
        if (XHR.readyState == 4)
        {
            if(XHR.status === 200)
                {
                if ( caller == 'refresh_usr') traitement.refresh_usr_chk (XHR.responseText, id_div);
                if ( caller == 'delete_img_usr') traitement.delete_img_usr_chk (XHR.responseText, id_div);
                if ( caller == 'view_comment') traitement.view_comment_chk (XHR.responseText, id_div);
                if ( caller == 'send_comment') traitement.send_comment_chk (XHR.responseText, id_div);
                if ( caller == 'send_like') traitement.send_like_chk (XHR.responseText, id_div);
                if ( caller == 'display_galerie') traitement.display_galerie_chk (XHR.responseText, id_div);
                }
            else
                {
                alert("Erreur pendant le chargement de la page.\n");
                return 'Erreur';
                }
        }
    };
    XHR.send();
  }

refresh_usr(id, id_div) // ***** récupère le contenu des images
{
    var action = '?action=refresh';
    var retour = traitement.Fajax('ajax_usr.php', action, id_div, 'refresh_usr'); // 
}

display_galerie(no_page, id_div) // ***** récupère le contenu des images
{
    var action = '?action=display_galerie&no_page='+no_page;
    var retour = traitement.Fajax('ajax_usr.php', action, id_div, 'display_galerie'); // 
}

delete_img_usr(id_photo, id_div)  // *****  demande la suppression d'une image
{
    var action = '?action=delete&id_photo='+id_photo;

    var image = document.getElementById(id_photo); // div du fond souhaité
    image.style.border='1px solid #E8272C';
            if (confirm('supprimer cette image : '+id_photo)) {
    			var retour = traitement.Fajax('ajax_usr.php', action, id_div, 'delete_img_usr');
        		} 
        		else 
        		{
    				image.style.border='0px solid #E8272C';
        		}
}

view_comment(id_img, id_div) // ***** demande les commentaires d'une image
{
    //alert('galerie_view_comment'+id_img+' '+id_div);
    document.getElementById('div_form_cmt').visibility = "visible";
    var action = '?action=view_comment'+'&image='+id_img; // ajouter Id_img
    var retour = traitement.Fajax('ajax_usr.php', action, id_div, 'view_comment'); // 
    this.image_selected = id_img; // important pour l'envoi du comment de savoir l'image view
    document.getElementById('div_form_cmt').visibility = "visible";
    document.getElementById('div_form_cmt').style.display = "inline"; // fonctionne 

}

send_comment(user_comment, id_div)// ***** envoi le commentaire d'une image
{
    // id_img,  ne peut etre passe car le form est global sans connaite l'image concernee, on a image_selected a la place
    //document.getElementById('div_form_cmt').visibility = "visible";
    var comment = document.getElementById('send_comment').value
    var action = '?action=send_comment'+'&image='+this.image_selected+'&user_comment='+user_comment+'&comment='+comment;
    var retour = traitement.Fajax('ajax_usr.php', action, id_div, 'send_comment'); // 
    document.getElementById('div_form_cmt').visibility = "hidden";
    document.getElementById('div_form_cmt').style.display = "none"; // fonctionne 
    /////////////////// ou pas necessaire car chk le recupere  a faire quand dessus est bon pour maj div comment : this.view_comment(id_img, id_div);

}

send_like($name_img, user_like, id_div)// ***** envoi le like d'une image
{
    // id_img,  ne peut etre passe car le form est global sans connaite l'image concernee, on a image_selected a la place
    var action = '?action=send_like'+'&image='+$name_img+'&user_like='+user_like;
    var retour = traitement.Fajax('ajax_usr.php', action, id_div, 'send_like'); // 

}

show_like()
{}


nb_img_page(id_div)
{

    alert (document.getElementsByTagName('select_nb_img_page'));
    var result = document.getElementsByTagName('select_nb_img_page').value;
    var action = '?action=nb_img_page'+'&value='+result;
    var retour = traitement.Fajax('ajax_usr.php', action, id_div, 'nb_img_page'); //    
}

refresh_usr_chk(reponse, id_div) // *****
{

    document.getElementById(id_div).innerHTML = reponse;
    document.getElementById(id_div).visibility = "visible";
}
display_galerie_chk(reponse, id_div) // *****
{

    document.getElementById(id_div).innerHTML = reponse;
    document.getElementById(id_div).visibility = "visible";
}

delete_img_usr_chk(reponse, id_div) // *****
{
    document.getElementById(id_div).visibility = "hidden"; // bizare , ne marche pas
    document.getElementById(id_div).style.display = "none"; // fonctionne 
//suppression dans base fait par ajax_usr.php
}

view_comment_chk(reponse, id_div) // *****
  {
    document.getElementById(id_div).innerHTML = reponse;   
  }

send_comment_chk(reponse, id_div) // *****
{
    if (reponse == 'interdit') {alert('Erreur vous ne pouvez commenter vos photos'); return;}
    document.getElementById(id_div).innerHTML = reponse;
    document.getElementById(id_div).visibility = "visible";
}

send_like_chk(reponse, id_div) // *****
{
    if (reponse == 'interdit') {alert('Erreur vous ne pouvez liker vos photos'); return;}
    document.getElementById(id_div).innerHTML = reponse;
    //document.getElementById(id_div).visibility = "visible";
}


handleImage(e)
{
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img,0,0);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}




} // fin de classe

const traitement = new Cfusion('fond02');