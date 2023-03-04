1) ne pas mettre de package lock.json car il est inutile

2) pense a mettre un eslint et prettier afin de pouvoir travailler en équipe

3) pense au npmrc afin de bloquer les monter de version sinon tu vas avoir des problèmes en productions, en gros avec save_exact=true cela va faire les monter de version en manuel. 

4) je n'ai pas vu de média queries dans ton css, et mas de return dans tes res de ton middlewares

5) "start": "nodemon index.js" -> je te conseil de migrer en pm2 car est plus performants que nodemon

6) attention au faute de caratère type , et ne pas laisser des console.log