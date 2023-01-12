const database = require('./database');

const dataMapper = {
  getAllCards: async() => {
    const query = 
    `
      SELECT *
      FROM "card"
    `;
    const result = await database.query(query);
    return result.rows;
  },
  getOneCard: async(id) => {
    const query =
    `
      SELECT *
      FROM "card"
      WHERE "id" = $1
    `;
    const result = await database.query(query, [id]);
    if (result.rowCount === 1){
      return result.rows[0];
    }
  },
  searchByElement: async(element) => {

    let query;
    if(element === 'null'){
      query =
      `
        SELECT *
        FROM "card"
        WHERE "element" IS NULL
      `;
    } else {
      query = {
        text:
        `
          SELECT *
          FROM "card"
          WHERE "element" = $1
        `,
        values: [element]
      };
    }
    const result = await database.query(query);
    return result.rows;
  },
  searchByElementNull: async() => {
    
    const result = await database.query(query);
    return result.rows;
  },
  searchByLevel: async(level) => {
    const query =
    `
      SELECT *
      FROM "card"
      WHERE "level" = $1
    `;
    const result = await database.query(query, [level]);
    return result.rows;
  },
  searchByValues: async(direction,value) => {
    // const valueColumn = `value_${direction}`;
    const valueColumn = `value_${direction.replace(/'/g, "''")}`;

    const query =
    `
      SELECT *
      FROM "card"
      WHERE ${valueColumn} = $1
    `;

    // Proposition de requete de la correction
    // SELECT * FROM card WHERE
    // // -- on teste la valeur de $1, $1 = 'xxx' va renvoyer true ou false
    // // --si $1 vaut 'north', on ajoute un critère de filtre value_north
	  // $1 = 'north' AND value_north >= $2
    // // --sinon, si $1 vaut 'south', on ajoute un critère de filtre value_south
    // OR	$1 = 'south' AND value_south >= $2
    // // --sinon, si $1 vaut 'east', on ajoute un critère de filtre value_east
    // OR	$1 = 'east' AND value_east >= $2
    // // --sinon, si $1 vaut 'west', on ajoute un critère de filtre value_west
    // OR	$1 = 'west' AND value_west >= $2;'
    
const result = await database.query(query, [value]);
    return result.rows;
  },
  searchByName: async(string) => {
    const stringSearch = `%${string}%`;
    const query =
    `
      SELECT *
      FROM "card"
      WHERE "name" ILIKE $1
      ORDER BY "id" ASC
    `;
    const result = await database.query(query, [stringSearch]);
    return result.rows;
  }
};


module.exports = dataMapper;
