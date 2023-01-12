const dataMapper = require('../dataMapper.js');

const cardsController = {
  item: async (req, res) => {
    const id = Number(req.params.id);
    try {
      const card = await dataMapper.getOneCard(id);
      res.render('card', { card });
    } catch (error) {
      console.error(error);
      res.status(500).send(`An error occured with the database :\n${error.message}`);
    }
  }
};

module.exports = cardsController;