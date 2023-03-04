1) ne pas mettre le composer.lock car inutile, composer.phar idem

2) pense a stocker l'ip dans la session php afin de vérifier que la session est bonne ainsi que le header, car si j'était un A <3, je ferait une copie de ta session afin de usurper ton identité.

3) pour chaque requete PHP, tu doit impérativement faire un try,catch afin d'évité d'afficher des erreurs.

4) dans ta classe Database tu a mis un try catch avec le détail de erreur, ce que je te conseil est d'ajouter dans .env production ou developpement, parce que tu affiche en production les erreurs, donc je te conseil de mettre une redicrection vers la page 500 + envoi email avec ton erreur

5) je te conseil aussi d'ajouter une expiration de tes sessions, de plus  $this->password =  password_hash($password, PASSWORD_DEFAULT); ! PASSWORD_DEFAULT doit etre remplacer par ARGON2I qui est la nouvelle convention, je te deconseille d'utiliser BCRYPT ou PASSWORD_DEFAULT car des A <3 on pu créer des attaques DDOS avec algo.

6) source

    https://www.php.net/manual/en/function.password-hash.php 
    playliste PHP (grafikart papa du web)
    https://www.youtube.com/watch?v=cWoq5znh0vw&list=PLjwdMgw5TTLVDv-ceONHM_C19dPW1MAMD&ab_channel=Grafikart.fr
    autres source 
    https://www.w3schools.com/php/default.asp

7) attention au injection SQL, au attaque XSS et autres prepare et execute + personnellement j'ajoute aussi des pseudo variable! 

8) commentaire personnel : c'est un bon début mais il te reste beaucoup de notion a voir, mais rome ne c'est pas construit en 1 jour. le secret la passion ;)

9) te former a la sécurité informatique : https://www.root-me.org/ 

10) pense a utilise les .env de ne pas le mettre dnas ton git, mettre dans ton .gitignore et de mettre un env.exemple

11) quand visual studio code devient rouge cela veut dire qui y a une erreur -> regarde dans ton fichier App/Studients et Teachers controller.php