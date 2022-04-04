window.onload = () => {
    // Gestion des boutons supprimer
    let links = document.querySelectorAll("[data-delete]")
    //boucle sur links
    for(link of links) {
        link.addEventListener("click", function(e){
        e.preventDefault()

        //Comfirmation de suppression
        if (confirm("Voulez vous supprimer cette image ?"))
        {
            //Envoie de la requete ajax vers href du lien avec DELETE
            fetch(this.getAttribute("href"), {
                method: "DELETE",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
                    
                },
                body: JSON.stringify({ "_token": this.dataset.token})
            }).then(
                //Recuperer la reponse en JSON
                response => response.json()
            ).then(data => {
                if (data.success)
                    this.parentElement.remove()
                else
                    alert(data.error)
            }).catch(e => alert(e))

            }
            })
    }

}