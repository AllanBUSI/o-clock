const { request } = require('express');
const client = require('./database');
const database = require('./database');

const dataMapper = {
  async getAllCards() {
    const query = "SELECT * FROM card";
    const result = await database.query(query);
    return result.rows;
  },
  getCard: async (id) => {
    //const targetId = Number(request.params.id);
    const queryResult = await client.query(
      `SELECT * 
      FROM card 
      WHERE card.id = $1;
      `);
     if (resultQuery.rowCount === 1) {
      return queryResult.rows[0] 
      } 
      return null;
  },
};


module.exports = dataMapper;
