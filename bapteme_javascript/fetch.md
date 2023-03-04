
1) fetch est une methode aifn d'appellé des requête HTTP : GET, POST, PUT, DELETE

2) fetch est une promesse donc il faudras il ajouter then et catch

3) un développeur est un faignant pour cela utilise postman pour générer ta requete fetch mais attention il ne feras pas le travail a ta place

########################################################################
Add headers requetes -> en tete de la requete permet de stocker des informations sur la personne qui envoi la requete | token, ip, modele pc ou telephone, etc etc 
var myHeaders = new Headers();
myHeaders.append("Authorization", "Bearer token");
myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

Add body si requete post, put, delete
var urlencoded = new URLSearchParams();
urlencoded.append("toto", "toto");

Create object configuration method (http), header (entete de la requete), body (body de la requete)
var requestOptions = {
  method: 'POST',
  headers: myHeaders,
  body: urlencoded,
};

Exemple 1 
fetch(Ton url, requestOptions)
  .then(result => console.log(result)) // ok status 200, 201, 202
  .catch(error => console.log('error', error)); // ko code error 300, 400, 500

Exemple 2 
const fetchAction = async () => {
    try {
        const response = await fetch(Ton url, requestOptions)

        console.log(response.data) // ok status 200, 201, 202
    } catch (err) {
        console.log('error', err.response.data) // ko code error 300, 400, 500
    }
}
####################################################################################################