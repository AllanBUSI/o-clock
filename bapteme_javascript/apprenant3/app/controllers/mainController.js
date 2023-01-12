const dataMapper = require('../dataMapper.js');

const mainController = {
  homePage: async (req, res) => {
    try {
      const cards = await dataMapper.getAllCards();
      res.render('main/cardList', {
        cards,
        title: 'Liste des cartes'
      });
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured with the database :\n${error.message}`);
    }
  },

  //ETAPE 1: Créer nouvelle méthode pour appeler dataMapper.getCard et récuperer les infos de la carte et les passer à la view
    //TODO creer view - problème d'affichage

 
  cardPage: async (request, response, next) => {

    try {
      const id = Number(request.params.id);

      const oneCard = await dataMapper.getCard(id);

      if (oneCard){
        response.render('main/cardDetails', {oneCard});
      }else{
        next();
      }
      
    } catch (error) {
      console.log(error);
      response.status(500).send('Oups, nous rencontrons un problème technique');
    }    
  },
  notFound: (request, response) => {
    response.render('main/notFound');
  },



};

module.exports = mainController;
