<?php

    include_once('line-bot-api-master/php/line-bot.php');

    $accessToken = "vF8xGUCn6fAi9hSd9aeTKNMKk55jZUydm0eUul+qi9D4EdpuEtO5cIdIEyEU1mTfKV1Bi1cKOCo+Mj56+jzM8phjzopKKGuKvd+33oXaSYI6UgGH6fGSkYzx4CpnTlWd06TjQzVYsWbQU1cvixnMNgdB04t89/1O/w1cDnyilFU=
Issue";//copy Channel access token ตอนที่ตั้งค่ามาใส่
    $channelSecret = '02507cc2576972f641459e2e782cd4f4';

    $bot = new BOT_API($channelSecret, $accessToken);

    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);

    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";

    //รับข้อความจากผู้ใช้
    $type_message = $arrayJson['events'][0]['message']['type'];
#ตัวอย่าง Message Type "Text"



if ($type_message == 'text') {

    $message = $arrayJson['events'][0]['message']['text'];

    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "บายย";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "2";
        $arrayPostData['messages'][1]['stickerId'] = "502";
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if ($message == "รูป") {
        $image_url = "https://grean.000webhostapp.com/IMG_DL_LINE_BOT/";

        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "imagemap";
        $arrayPostData['messages'][0]['baseUrl'] = 'https://grean.000webhostapp.com/IMG_DL_LINE_BOT/' ;
        $arrayPostData['messages'][0]['altText'] = "This is an imagemap";
        $arrayPostData['messages'][0]['baseSize']['height'] = 700;
        $arrayPostData['messages'][0]['baseSize']['width'] = 700;

        $arrayPostData['messages'][0]['actions'][0]['type'] = "uri";
        $arrayPostData['messages'][0]['actions'][0]['linkUri'] = "https://www.droidsans.com/";
        $arrayPostData['messages'][0]['actions'][0]['area']['x'] = 0;
        $arrayPostData['messages'][0]['actions'][0]['area']['y'] = 0;
        $arrayPostData['messages'][0]['actions'][0]['area']['width'] = 700;
        $arrayPostData['messages'][0]['actions'][0]['area']['height'] = 700;
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "uid"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $message2 = $arrayJson['events'][0]['source']['userId'];

        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "".$message2;
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "yesno"){

        //$arrayPostData['to'] = $messageUID;
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $message2 = $arrayJson['events'][0]['source']['userId'];


        $arrayPostData['messages'][0]['type'] = "template";
        $arrayPostData['messages'][0]['altText'] = "this is a confirm template";
        $arrayPostData['messages'][0]['template']['type'] = "confirm";
        $arrayPostData['messages'][0]['template']['text'] = "Wanna join The Avengers ?";

        $arrayPostData['messages'][0]['template']['actions'][0]['type'] = "message";
        $arrayPostData['messages'][0]['template']['actions'][0]['label'] = "Yes";
        $arrayPostData['messages'][0]['template']['actions'][0]['text'] = "yes";

        $arrayPostData['messages'][0]['template']['actions'][1]['type'] = "message";
        $arrayPostData['messages'][0]['template']['actions'][1]['label'] = "No";
        $arrayPostData['messages'][0]['template']['actions'][1]['text'] = "no";

        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "yes"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "yes";
        replyMsg($arrayHeader,$arrayPostData);
    }

    else if($message == "no"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "no";
        replyMsg($arrayHeader,$arrayPostData);
    }









}else if ($type_message == 'sticker') {


        $message = $arrayJson['events'][0]['message']['packageId'];
        $message2 = $arrayJson['events'][0]['message']['stickerId'];


        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "Package ID : ".$message;
        $arrayPostData['messages'][1]['type'] = "text";
        $arrayPostData['messages'][1]['text'] = "Sticker ID : ".$message2;
        replyMsg($arrayHeader,$arrayPostData);

}else if ($type_message == 'image') {

        $message = $arrayJson['events'][0]['message']['id'];
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "Img ID : ".$message;
        //replyMsg($arrayHeader,$arrayPostData);

        $messageId=$message;
        $response = $bot->getMessageContent($messageId);
        if($response->isSucceeded()){
        $tmpfile = tmpfile();
        $output = "IMG_DL_LINE_BOT/".$messageId .'.jpg';
        file_put_contents($output, $response->getRawbody());
        }else{
            error_log($response->getHTTPStatus().'  '.$response->getRawbody());
        }

        $image_url = "https://grean.000webhostapp.com/IMG_DL_LINE_BOT/".$message.".jpg";
        $arrayPostData['messages'][1]['type'] = "image";
        $arrayPostData['messages'][1]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][1]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
}





else{
        $image_url = "https://vignette.wikia.nocookie.net/villains/images/2/2b/Jerrythemouse.jpg/revision/latest?cb=20170721111021";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
}


function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }

function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>
