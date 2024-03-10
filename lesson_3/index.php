<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Подключаемся к базе данных
    $user = 'u67315'; // ваш логин
    $pass = '9441005'; // ваш пароль
    $db = new PDO('mysql:host=localhost;dbname=u67315', $user, $pass);

    // Обработка данных формы
    $name = $_POST['fio'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $bio = $_POST['bio'];
    $contract = isset($_POST['contract']) ? 1 : 0;
	
	

	echo "<div class='error-message-container'>";
    // Проверка данных на корректность
    $errors = [];

    if (!preg_match("/^[a-zA-Zа-яА-Я ]+$/u", $name)) {
        $errors[] = "Пожалуйста, введите корректное имя.";
    }

    if (!preg_match("/^\+?[0-9]{1,4}[0-9]{10}$/", $phone)) {
        $errors[] = "Пожалуйста, введите корректный номер телефона";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Пожалуйста, введите корректный email";
    }

    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $birthdate)) {
        $errors[] = "Дата рождения должна быть в формате ДЕНЬ-МЕСЯЦ-ГОД";
    }

    if (empty($gender)) {
        $errors[] = "Пожалуйста, выберите пол.";
    }

    if (!preg_match("/^[a-zA-Zа-яА-Я.,! ]+$/u", $bio)) {
        $errors[] = "Поле Биография не может содержать спец. символы.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div error-message style='color: red;'>$error</div>";
        }
    } else {
        // Если ошибок нет, выполняем запрос на вставку данных
        $stmt = $db->prepare("INSERT INTO Applications (FIO, Phone, Email, Birthdate, Gender, Bio, Contract) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $phone, $email, $birthdate, $gender, $bio, $contract]);

        // Получаем ID последней вставленной записи
        $last_id = $db->lastInsertId();

        // Вставляем способности
        if (isset($_POST['programming_languages']) && !empty($_POST['programming_languages'])) {
            foreach ($_POST['programming_languages'] as $language) {
                // Выбираем ID языка программирования из таблицы Abilities
                $stmt = $db->prepare("SELECT ID FROM Abilities WHERE ProgrammingLanguage = ?");
                $stmt->execute([$language]);
                $ability_id = $stmt->fetchColumn();

                // Проверяем, что $ability_id не пустой и является корректным целым числом
                if ($ability_id !== false && is_numeric($ability_id)) {
                    // Вставляем соответствующую связь между заявкой и способностью
                    $stmt = $db->prepare("INSERT INTO Application_Ability (ApplicationID, AbilityID) VALUES (?, ?)");
                    $stmt->execute([$last_id, $ability_id]);
                } else {
                    error_log("Язык '$language' Не найден в таблице Abilities");
                }
            }
        }

        // Перенаправляем пользователя обратно на форму с сообщением об успешном сохранении
        header('Location: form.php?save=1');
        exit();
    }
}

// Если запрос был GET, просто показываем форму
include('form.php');
?>
