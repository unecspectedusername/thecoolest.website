<?php

// функция проверяет являются ли запрос пустым
function checkIfEmpty($request) {
    return empty($request) ? null : $request;
}
