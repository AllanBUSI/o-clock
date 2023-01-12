const database = require('./database');

const dataMapper = {
  async getAllCards() {
    const query = "SELECT * FROM card";
    const result = await database.query(query);
    return result.rows;
  },

  // ETAPE 1: créer méthode getCard pour récupérer les infos d'une carte
  
  getCard: async (id) => {
  
    const queryResult = await database.query(
      `
      SELECT *
      FROM "card"
      WHERE "id" = $1;
      `,
      [id],
    );
    
    if (queryResult.rowCount === 1){
      return queryResult.rows[0];
    }
    return null;
  },  

  // ETAPE-2 recuperer les cartes par élément:

  getCardByElement: async () => {
  
    const queryResult = await database.query(
      `
      SELECT *
      FROM "card"
      WHERE "element" IS NOT NULL;
      `,
    
    );
    
      return queryResult.rows;
    }
   
  };







module.exports = dataMapper;
