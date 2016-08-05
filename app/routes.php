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

	$domain = "sandboxc8186689a6dd47e59d12999145f8e354.mailgun.org";

	$this->mail->sendMessage($this->config->get('services.mailgun.domain'), [
		'from'    => 'Mailgun Sandbox <postmaster@sandboxc8186689a6dd47e59d12999145f8e354.mailgun.org>',
        'to'      => $params['email'],
        'subject' => 'Message from Destructor',
        'html'    => $this->view->fetch('message.twig', ['hash' => $hash])
    ]);

	return $response->withRedirect($this->router->pathFor('home'));
})->setName('send');