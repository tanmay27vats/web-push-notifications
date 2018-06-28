<?php
require __DIR__ . '/../vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)
$subscription = Subscription::create(json_decode(file_get_contents('php://input'), true));

$auth = array(
    'VAPID' => array(
        'subject' => 'Tanmay Vats',
        'publicKey' => 'BH0qMwONUPOKfUr4AGEbp-FAFYH43LAONgbgzhi2UyiwbpKehLpjVXHUtY_LOdRoX78zirZbA-qnuonM7ul6uLo',
        'privateKey' => 'nIEQyPvnCe02Cc3MTG-9PGP6s4XG9tri0NpI-L_MeY4', // in the real world, this would be in a secret file
    ),
);

$webPush = new WebPush($auth);

$images = ["https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_OlJRPtDOeWJxOZYmgiXVYcbalKRrakZmhdZOKe3w2tN0bzChkg",
	"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSZk6z0Ij5sNGQmix6u_-s9NOjm81YOAsl9uK6x9Q24_eCkAbW9",
	"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkOhzMZGvyTO9aOim_RW_IFjtmpN9Wurs1_3nb86s6oB-359GaUA",
	"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRZkwIOvBYiwvGfr5KDv00QmoDDafAuEO4UlQvLEnnmrhm0ANL6",
	"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaThmDbmkdXp2AqRSroOqX0eGlRYWnnyOKk-R06PsWndlu_Mul"
	];

$rand 	= array_rand($images);
$image 	= $images[$rand];

$urls 	= ["http://facebook.com", "http://google.com", "http://www.rediff.com/"];
$rand 	= array_rand($urls);
$url 	= $urls[$rand]; 

/*
for more styling & options info check following links
https://developer.mozilla.org/en-US/docs/Web/API/ServiceWorkerRegistration/showNotification
https://web-push-book.gauntface.com/demos/notification-examples/
*/

$payloadData = [
				'title' => 'This is dynamic Title '.date('d M, y h:i:s A'),
				'payload' => [
					'icon' => $image, /* icon image should be 192x192 */
					'badge' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxvsHej9GOtoucT6KgeUVk_WXXxV-uVddfyb7QfRpo66fga6-6rw', /* badge image should be 92x92 */
					'body' => 'Tanmay testing dynamic body @ '.date('d M, y h:i:s A'),
					'vibrate' => [300, 100, 400],
					'data' => [
						'url' => $url
					],
					'image' => 'https://scontent-bom1-1.cdninstagram.com/vp/dc008cd43bf1a1102ba28e060432d3ad/5BA6512A/t51.2885-15/sh0.08/e35/p640x640/31157081_460969021021722_3955048135197196288_n.jpg'
				]
			];

$res = $webPush->sendNotification(
    $subscription,
    json_encode($payloadData),
    true
);

print_r($res);

/**
if $res is not true that means an error occurred so you should delete that endpoint from DB.
*/