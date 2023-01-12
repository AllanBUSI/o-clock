const dataMapper = require('../dataMapper.js');


const cardController = {
  renderOneCard: async (req, res, next) => {
    try {
      // Je récupère la valeur de l'Id dans le paramètre
      const id = Number(req.params.id);
      // Je recherche la carte correspondant à l'Id
      const card = await dataMapper.getOneCard(id);
      // console.log(card);
      if(card){
        res.render("card/card-item", { card })
      } else {
        next();
      }
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured with the database :\n${error.message}`);
    }
  },
  deckPage: (req, res) => {
    // Initialisation des cartes du deck, pour l'instant vide
    let cards = [];
    if(req.session.cards) {
      // Ajout des cartes en session au deck
      cards = req.session.cards;
    }
    res.render('card/deck', { cards });
  },
  addCard: async (req, res) => {
    const cardId = Number(req.params.id);
    try {
      const card = await dataMapper.getOneCard(cardId);
      console.log("card",card);

      // // Initialiser le tableau si inexistant ==> ajouté dans un Middleware
      // if(!req.session.cards) {
      //   req.session.cards = [];
      // }
      console.log("req.session.cards",req.session.cards);
      if(card){
        // Rechercher si la carte est déjà dans le deck, si non l'ajouter, si oui ne rien faire
        const findCardInDeck = req.session.cards.find(card => card.id === cardId);
        // console.log("add ?",findCardInDeck);
        if(!findCardInDeck && req.session.cards.length < 5){
          req.session.cards.push(card);
        }
        res.redirect('/deck');
        console.log('req.session.cards', req.session.cards);
      }
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured with the database :\n${error.message}`);
    }
  },
  removeCard: async (req, res) => {
    const cardId = Number(req.params.id);
    // J'enlève la card qui correspond à l'id sélectionné
    const deck = req.session.cards.filter(card => !(card.id === cardId));
    // Je réaffecte la valeur du deck dans la session
    req.session.cards = deck;
    res.redirect('/deck');
  },
};

module.exports = cardController;
