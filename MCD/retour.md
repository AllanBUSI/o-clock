
1) un modèle conceptuelle de donnée a pour bute de comprendre la logique relationnelle de la base de donnée. Il n'y a pas de bonne ou de mauvais réponse, mais il y a des choses qui ne vont pas dans ton modèle relationnel

2) Pour tes relations, pense a mettre les id_relation, exemple : user -> order, tu n'a pas mis id_user dans la table order donc on ne peut pas savoir si ta relation est correcte. 

3) il faut typer tes relation (varchar (size)), (int), (enum) etc etc etc, de plus pour les relations one to one pense a mettre le terme unique.

4) voici comment je ferait mon MCD : 1 je télécharge mysqlworkbench, je créer un diagramme EER (entité et relation), et ensuite j'adapte le EER en MCD.

5) voici les sources que je te conseil d'utiliser : 
    (grafikart = papa du web fr)
    - https://www.youtube.com/watch?v=OxJo051TMr8&ab_channel=Grafikart.fr
    (openclassroom wikipeidia et tp grauit du web)
    - https://openclassrooms.com/fr/courses/6227506-assistez-la-maitrise-douvrage-dun-projet-si/6796645-concevez-votre-base-de-donnees
    (download mysql workbench)
    - https://www.mysql.com/products/workbench/

Bonus) le bute d'un MCD est que n'importe qui, dans n'importe qu'elle pays doit connaître la logique de ta base de donnée, la conception de la base de donnée est faites en 3 phases 
    - Modèle Cconceptuelle de Donnée 
    - Modèle Logique de Donnée 
    - Modèle Physique de Donnée

