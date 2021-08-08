
let ajouter = $('#ajouter'); 
let supprimer = $('#supprimer'); 
let duplicata = $('.duplicate'); 
let alert = $('#alert'); 
let group_creation = $('#groupe_creation'); 
let compteur = 1; 
// fonction pour gérer l'affichage des actions
function superAlert(couleur, content) {
    alert.append('<div class="alert alert-'+couleur+'" role="alert">'+content+'</div>');
    setTimeout(function() {
        alert.html('');  
        }, 4000);     
};
// Duplique un élément au clic
ajouter.click(function(e){   
    e.preventDefault();
    compteur++
    alert.html('');
    let clone = duplicata.clone().appendTo(group_creation);
    clone.find("input").val('');
    clone.attr('id','creation-'+compteur);
    clone.find(".upload label").attr("for","photo"+compteur); 
    clone.find(".upload input").attr("name","photo"+compteur);
    clone.find(".form-group label").attr("for","legende"+compteur);
    clone.find(".form-group input").attr("name","legende"+compteur);
    superAlert('success','Vous avez ajouté une ligne.'); 
});
// Supprime dernier element au clic
supprimer.click(function(e){   
    e.preventDefault();
    alert.html('');
    if (group_creation.children().length > 1 ) {
        compteur--
        group_creation.children().last().remove(); 
        superAlert('warning','Vous avez supprimé la dernière ligne');  
    } else {
        superAlert('danger','Vous ne pouvez pas supprimer la première ligne.');  
    }
});