<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuck Norris Jokes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .joke {
            font-size: 18px;
            color: #555;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Chuck Norris Jokes</h1>
        <?php
        require __DIR__ . '/vendor/autoload.php';

        use GuzzleHttp\Client;

        // URL публічного JSON-API
        $jsonApiUrl = 'https://api.chucknorris.io/jokes/random';

        // Створюємо клієнт Guzzle
        $client = new Client();

        // Отримуємо дані з JSON-API
        $response = $client->request('GET', $jsonApiUrl);

        // Перевірка, чи отримано коректний відгук від сервера
        if ($response->getStatusCode() === 200) {
            // Декодуємо JSON в асоціативний масив
            $data = json_decode($response->getBody(), true);

            // Перевірка, чи JSON декодується успішно
            if ($data !== null) {
                // Виводимо дані у форматі HTML
                echo '<div class="joke">' . htmlspecialchars($data['value']) . '</div>';
            } else {
                echo '<div class="joke">Помилка при декодуванні JSON.</div>';
            }
        } else {
            echo '<div class="joke">Помилка при виконанні запиту до сервера.</div>';
        }
        ?>
    </div>
</body>

</html>
