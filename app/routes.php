<?php

$app->get('/', function($request, $response, $args) {
	$this->view->render($response, 'home.twig');
})->setName('home');

$app->post('/', function($request, $response, $args) use ($app) {
	$params = $request->getParams();
	$hash = md5(uniqid(true));

	$message = $this->db->prepare("
		INSERT INTO messages (hash, message)
		VALUES (:hash, :message)
	");

	$message->execute([
		'hash' => $hash,
		'message' => $params['message']
	]);

	return $response->withRedirect($this->router->pathFor('home'));
})->setName('send');