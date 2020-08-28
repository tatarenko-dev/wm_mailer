<?php
/**
 * WEB МАСТЕРСКАЯ
 * Скрипт отправки почты
 * Канал на Youtube - https://www.youtube.com/channel/UCZz0APRoLt4gt96iodDQ25g
 * Ссылка на разбор видео
 */
// Три строчки ниже раскоментируйте для отображения ошибок (Если что то не работает)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


/**
 * Основные настройки
 */
global $config;
$config = [
    'email_template' => 'clear.php', // Название файла с шаблоном письма
    'subject' => 'Заявка с сайта', // Тема письма
    'to' => 'tatarenko.dev@gmail.com', // Получатель письма
    'headers' => 'Content-type: text/html; charset=utf-8 \r\n 
                  From: <no-reply@contact-form.test>\r\n', // Во from обязательно указывать домен сайта с которого отправляете письмо
    'fields' => [ //Указываем поля со всех форм которые хотим отправлять
        'name' => 'Имя:',
        'email' => 'Email:',
        'message' => 'Сообщение:',
        'phone' => 'Телефон:',
    ],
];

/**
 * Ловим форму
 */
if (spamProtection()) {
    $to = $config['to'];
    $subject = $config['subject'];
    $template =  $config['email_template'];
    $headers = $config['headers'];
    $fields = dpSanitizeFields($_POST); // Очистка полученных данных из формы

    $fields = dpGetAllowedFields($fields); // Отправить в шаблон только поля которые находятся в $config['fields']
    $fields = dpChangeKeyFields($fields); // Отправить в шаблон все поля которые приходят с формы и переименовать key для тех которые находятся в в $config['fields']
    // $fields = dpChangeKeyFields(dpGetAllowedFields($fields)); // Отправить в шаблон поля которые находятся в $config['fields'] + переименовать key для найденых
    
    if (dpSendEmail($to, $subject, $fields, $template, $headers)) {
        // if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        //     if (dpSendEmail($_POST['email'], 'СПАСИБО ЗА ЗАЯВКУ', $fields, 'client.php', $headers)) {
        //         echo json_encode([
        //             'status' => 'success',
        //             'message' => 'Ваша заявка принята!'
        //         ], true);
        //     }
        // } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Ваша заявка принята!'
            ], true);
        // }
    }

    // dpTestTemplate($fields, $template = 'client.php'); // Закоментируй отправку формы dpSendEmail(...) и раскоментируй эту строку для теста шаблона письма
    
    die();
}

/**
 * Тест шаблона
 *
 * @param array $fields
 * @param string $template
 * @return void
 */
function dpTestTemplate($fields, $template) {
    $html = dpTemplateEmail($fields, $template);
    echo $html;
    die();
}

/**
 * Отправляем письмо
 *
 * @param string $to
 * @param string $subject
 * @param array $fields
 * @param string $template
 * @return void
 */
function dpSendEmail($to, $subject, $fields, $template = 'default.php', $headers) {
    $html = dpTemplateEmail($fields, $template);
    $result = mail( $to, $subject, $html, $headers);
    return $result;
}

/**
 * Готовим шаблон письма
 *
 * @param array $fields
 * @param string $template
 * @return string html
 */
function dpTemplateEmail($fields, $template) {
    ob_start();
    global $email_fields; // Прокидываем поля из формы в шаблон
    $email_fields = $fields; 
    include_once __DIR__ . '\/email-templates/' . $template;
    $html = ob_get_contents();
    ob_end_clean();
    return $html;
}

/**
 * Очистка полученных из формы полей
 *
 * @param array $data
 * @return array
 */
function dpSanitizeFields(array $data) {
    foreach($data as $key => $field) :
        $data[$key] = filter_var($field, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    endforeach;
    return $data;
}

/**
 * Взять поля только из массива $config['fields']
 *
 * @param array $data
 * @return array
 */
function dpGetAllowedFields(array $data) {
    global $config;
    $temp_fields = [];
    foreach($config['fields'] as $key => $item) :
        if (array_key_exists($key, $config['fields'])) {
            $temp_fields[$key] = $data[$key];
        }
    endforeach;
    return $temp_fields;
}

/**
 * Заменить ключи в массиве на новые из $config['fields']
 *
 * @param array $data
 * @return void
 */
function dpChangeKeyFields(array $data) {
    global $config;
    foreach($data as $key => $field) :
        if (array_key_exists($key, $config['fields'])) {
            $data[$config['fields'][$key]] = $data[$key]; // Записываем значение поля под новым ключем
            unset($data[$key]); // Удаляем старый ключ
        }
    endforeach;
    return $data;
}

/**
 * Простая защита от спама
 *
 * @return void
 */
function spamProtection() {
    if (isset($_POST['check']) && $_POST['check'] === 'no_spam') {
        return true;
    }
    // Дополнительные проверки 
    return false;
}