const client = require('./database');
const database = require('./database');

const dataMapper = {
  async getAllCards() {
    const query = "SELECT * FROM card";
    const result = await database.query(query);
    return result.rows;
  },
  async getElements() {
    const query = "SELECT * FROM card WHERE element IS NOT NULL";
    const result = await database.query(query);
    return result.rows;
  },
  async getOneCard (id) {
    const selectQuery = 
      `
      SELECT *
      FROM "card"
      WHERE "id" = ${id}
      `
    ;
    const cardResults = await client.query(selectQuery);

    if (cardResults.rowCount === 1){
      return cardResults.rows[0];
    } else {
      return null;
    }
   
  }
};


module.exports = dataMapper;
