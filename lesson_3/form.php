<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задание 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 0px 0px 0px 20px;
            width: 320px;
            max-width: 90%;
            box-sizing: border-box;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        select,
        textarea {
            width: calc(100% - 22px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
            transform: scale(1.2);
        }

        textarea {
            width: calc(100% - 22px);
            resize: vertical;
        }

        .submit-container {
            text-align: center;
        }

        .submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit:hover {
            background-color: #45a049;
        }

        .success-message {
            display: none;
            color: #4CAF50;
            font-size: 1.2em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Задание 3</h1>
        <form action="index.php" method="post">
            <label for="fio">1) ФИО:</label>
            <input type="text" id="fio" name="fio" required maxlength="75" pattern="[A-Za-zА-Яа-яЁё\s]{1,}" title="Максимум 75 символов. Только русские или английские буквы"><br>
            <label for="phone">2) Телефон:</label>
            <input type="tel" id="phone" name="phone" required maxlength="15" pattern="[0-9]{1,}" title="Максимум 15 цифр. Только цифры."><br>
            <label for="email">3) E-mail:</label>
            <input type="email" id="email" name="email" required maxlength="50" title="Максимум 50 символов, только английские буквы"><br>
            <label for="birthdate">4) Дата рождения:</label>
            <input type="date" id="birthdate" name="birthdate" required><br>
            <label>5) Пол:</label>
            <input type="radio" id="male" name="gender" value="male" required>
            <label for="male">Мужской</label>
            <input type="radio" id="female" name="gender" value="female" required>
            <label for="female">Женский</label><br>
            <label for="programming_languages">6) Любимый язык программирования:</label><br>
            <select id="programming_languages" name="programming_languages[]" multiple>
                <option value="Pascal">Pascal</option>
                <option value="C">C</option>
                <option value="C++">C++</option>
                <option value="JavaScript">JavaScript</option>
                <option value="PHP">PHP</option>
                <option value="Python">Python</option>
                <option value="Java">Java</option>
                <option value="Haskell">Haskell</option>
                <option value="Clojure">Clojure</option>
                <option value="Prolog">Prolog</option>
                <option value="Scala">Scala</option>
            </select><br>
            <label for="bio">7) Биография:</label><br>
            <textarea id="bio" name="bio" rows="4" cols="50" maxlength="500"></textarea><br>
            <input type="checkbox" id="contract_agree" name="contract" required>
            <label for="contract_agree">8) С контрактом ознакомлен(а)</label><br>
            <div class="submit-container">
                <input class="submit" type="submit" value="Сохранить">
            </div>
        </form>
        <div class="success-message">Данные успешно сохранены!</div>
    </div>
    <?php
        if(isset($_GET['save']) && $_GET['save'] == '1') {
            echo '<script>document.querySelector(".success-message").style.display = "block";</script>';
        }
    ?>
</body>
</html>
