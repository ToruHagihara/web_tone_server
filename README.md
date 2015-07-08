# web_tone_server
[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

#Overview

スマホのブラウザから登録したメロディを演奏する電子オルゴールを作ります。

http://fabble.cc/toruhagihara/web-connected-orgel

#API
/get/tonelist
ブラウザ上で登録されているメロディ一覧を","区切りで表示する
 
/get/tonelist/json
登録されているメロディ一覧をJSON形式で取得する。

/delete/
登録されているメロディをすべて削除する。

#Sample
JSON形式で取得するには以下のURLを指定します。
https://deploy-url-nnnn.herokuapp.com/get/tonelist/json/
->
[{"id":"1","tone":"1232123"}]
