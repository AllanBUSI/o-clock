const { request } = require('express');
const client = require('../database');

const dataMapper = require ('../dataMapper');

const deckController = {
 
    addDeck : async (req, res, next) => {
        try {
            if(!req.session.deck){
                req.session.deck = [];
            }
            const id = Number(req.params.id);
            const deckCard = await dataMapper.getOneCard(id);
            if(deckCard){
                const foundDeckCard = req.session.deck.find((deck) => deck.id === id);
                if (!foundDeckCard) {
                    req.session.deck.push(deckCard);
                }
                res.redirect('/deck');
            } else {
                next();
            }
        } catch (error) {
            res.status(500).send('Oups, problème technique, repassez plus tard');
        }
    },
    deckPage : (req , res) => {
        res.render('deck', {deck : req.session.deck})
    }
}

module.exports = deckController;