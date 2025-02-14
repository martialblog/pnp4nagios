<?php

defined('SYSPATH') or die('No direct access allowed.');
$lang = [
    'rrdtool-not-found'                 => 'RRDTool не обнаружено в %s. <a href="http://docs.pnp4nagios.org/faq/1">Read FAQ online</a>',
    'config-not-found'                  => 'Файл конфигурации %s не найден. <a href="http://docs.pnp4nagios.org/faq/2">Read FAQ online</a>',
    'perfdata-dir-empty'                => 'Директория с данными производительности "%s" пуста. Пожалуйста, проверьте конфигурацию Nagios. <a href="http://docs.pnp4nagios.org/faq/3">Read FAQ online</a>',
    'host-perfdata-dir-empty'           => 'Директория с данными производительности "%s" пуста. Пожалуйста, проверьте конфигурацию Nagios. <a href="http://docs.pnp4nagios.org/faq/4">Read FAQ online</a>',
    'perfdata-dir-for-host'             => 'Директория с данными производительности "%s" для хоста "%s" не существует. <a href="http://docs.pnp4nagios.org/faq/5">Read FAQ online</a>',
    'xml-not-found'                     => 'XML файл "%s" не найден. <a href="http://docs.pnp4nagios.org/faq/6">Read FAQ online</a>',
    'get-first-service'                 => 'Невозможно определить первую службу для хоста "%s". <a href="http://docs.pnp4nagios.org/faq/7">Read FAQ online</a>',
    'get-first-host'                    => 'Ни по одному хосту данных не обнаружено. <a href="http://docs.pnp4nagios.org/faq/8">Read FAQ online</a>',
    'xml-structure-mismatch'            => 'Несоответствие структуры данных XML. Обнаружена версия "%d", ожидаемая версия - "%d". <a href="http://docs.pnp4nagios.org/faq/9">Read FAQ online</a>',
    'save-rrd-image'                    => 'Функция php fopen("%s") завершилась неудачей. <a href="http://docs.pnp4nagios.org/faq/10">Read FAQ online</a>',
    'xml-structure-without-version-tag' => 'Несоответствие структуры данных XML. Тэг версии не найден в "%s". <a href="http://docs.pnp4nagios.org/faq/11">Read FAQ online</a>',
    'template-without-opt'              => 'Шаблон %s не предоставляет массив $opt[]. <a href="http://docs.pnp4nagios.org/faq/12">Read FAQ online</a>',
    'template-without-def'              => 'Шаблон %s не предоставляет массив $def[]. <a href="http://docs.pnp4nagios.org/faq/13">Read FAQ online</a>',
    'no-data-for-page'                  => 'Извините, не удалось обнаружить никаких данных используя конфигурационный файл "%s", <a href="http://docs.pnp4nagios.org/faq/14">Read FAQ online</a>',
    'page-not-readable'                 => 'Конфигурационный файл "%s" не может быть прочитан или не существует. <a href="http://docs.pnp4nagios.org/faq/15">Read FAQ online</a>',
    'auth-pages'                        => 'Вы не авторизованы для просмотра "страниц" <a href="http://docs.pnp4nagios.org/faq/16">Read FAQ online</a>',
    'page-config-dir'                   => 'Файл конфигурации "страниц" не найден в "%s" <a href="http://docs.pnp4nagios.org/faq/17">Read FAQ online</a>',
    'xport-host-service'                => 'Контроллер Xport требует параметры "host" и "srv" в URL. <a href="http://docs.pnp4nagios.org/faq/18">Read FAQ online</a>',
    'mod-rewrite'                       => 'Модуль Rewrite для Apache не включен. <a href="http://docs.pnp4nagios.org/faq/19">Read FAQ online</a>',
    'tpl-no-services-found'             => 'Службы "%s" не найдены. <a href="http://docs.pnp4nagios.org/faq/20">Read FAQ online</a>',
    'tpl-no-hosts-found'                => 'Хосты "%s" не найдены. <a href="http://docs.pnp4nagios.org/faq/21">Read FAQ online</a>',
    'no-templates-found'                => 'Шаблоны "%s" не найдены. <a href="http://docs.pnp4nagios.org/faq/22">Read FAQ online</a>',
    'not_authorized'                    => 'Вы не авторизованы для просмотра данного хоста/службы',
    'remote_user_missing'               => 'Удалённый пользователь не указан. Проверка аутентификации отменена. <a href="http://docs.pnp4nagios.org/faq/23">Read FAQ online</a>',
    'livestatus_socket_error'           => 'Ошибка Livestatus сокета: %s (%s) <a href="http://docs.pnp4nagios.org/faq/24">Read FAQ online</a>',
    'not_authorized_for_host_overview'  => 'Вы не авторизованы для доступа к странице обзора хоста.',
    'xml-generic_error'                 => 'Не удаётся распарсить XML файл "%s".<p><strong>Ошибки XML:</strong>%s</p>',
    'gd-missing'                        => 'PHP GD functions are missing. More on <a href="http://www.php.net/manual/en/book.image.php">www.php.net</a>',
];
