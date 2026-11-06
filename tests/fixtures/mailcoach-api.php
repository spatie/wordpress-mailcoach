<?php

header('Content-Type: application/json');

if (($_SERVER['HTTP_AUTHORIZATION'] ?? '') !== 'Bearer integration-token') {
    http_response_code(401);
    echo json_encode(['message' => 'Unauthorized']);

    return;
}

$lists = [
    ['uuid' => 'list-enabled', 'name' => 'Newsletter', 'active_subscribers_count' => 34, 'allow_form_subscriptions' => true],
    ['uuid' => 'list-disabled', 'name' => 'Customers', 'active_subscribers_count' => 7, 'allow_form_subscriptions' => false],
];

if ($_SERVER['REQUEST_URI'] === '/api/email-lists') {
    echo json_encode([
        'data' => $lists,
        'links' => ['first' => null, 'last' => null, 'prev' => null, 'next' => null],
        'meta' => ['current_page' => 1, 'total' => 2],
    ]);

    return;
}

if ($_SERVER['REQUEST_URI'] === '/api/email-lists/list-disabled') {
    echo json_encode(['data' => $lists[1]]);

    return;
}

http_response_code(404);
echo json_encode(['message' => 'Not found']);
