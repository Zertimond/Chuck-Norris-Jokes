const express = require('express');
const axios = require('axios');

const app = express();
const port = 3000;

async function fetchData(apiEndpoint) {
  try {
    const response = await axios.get(apiEndpoint);
    return response.data;
  } catch (error) {
    console.error('Error fetching data:', error.message);
    throw error;
  }
}

app.get('/', async (req, res) => {
  const apiEndpoint = 'https://api.chucknorris.io/jokes/random';

  try {
    const rawData = await fetchData(apiEndpoint);

    // Отримання тільки значення з цитатою Чака Норріса
    const jokeValue = rawData.value;

    const htmlResponse = `
      <html>
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Chuck Norris Joke</title>
          <style>
            body {
              font-family: 'Arial', sans-serif;
              background-color: #f5f5f5;
              color: #333;
              margin: 20px;
            }

            h1 {
              color: #d9534f;
            }

            .joke-container {
              background-color: #fff;
              border-radius: 5px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              padding: 20px;
              margin-bottom: 20px;
            }

            .joke {
              font-size: 18px;
              line-height: 1.6;
            }

            .powered-by {
              margin-top: 10px;
              font-size: 12px;
              color: #777;
            }
          </style>
        </head>

        <body>
          <h1>Chuck Norris Joke</h1>
          <div class="joke-container">
            <div class="joke">
              ${jokeValue}
            </div>
            <div class="powered-by">Powered by Chuck Norris API</div>
          </div>
        </body>
      </html>
    `;

    res.send(htmlResponse);
  } catch (error) {
    console.error('Помилка виконання програми:', error.message);
    res.status(500).send('Internal Server Error');
  }
});

app.listen(port, () => {
  console.log(`Server is running at http://localhost:${port}`);
});
