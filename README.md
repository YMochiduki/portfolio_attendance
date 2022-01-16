
# 学校用欠課・欠席記録システム

学校用欠課・欠席記録システムは欠課・欠席記録システムは、生徒の欠課・欠席連絡を記録するためのアプリケーションです。  
職員室にいる職員が、保護者や生徒からの欠席・遅刻の連絡を欠課・欠席記録システムに入力することで、教室にいる職員もその場で自分のスマートフォンから最新の欠課・欠席連絡の有無を確認することができます。

## アプリケーション
URL https://ymochi.sakura.ne.jp/attendance  

動作確認用アカウント  
* メールアドレス：testuser@gmail.com
* パスワード：hogehoge  

## 利用方法
 [利用方法外部リンク参照](https://ymochi.sakura.ne.jp/explanation "使用方法外部リンク")

## 制作目的
学校現場で朝の欠席連絡の情報共有を円滑にするため。  
連絡を受けた職員から担任の職員への伝達漏れがあったり、教科担任への伝達が煩雑になったりするため、情報を一括管理できるアプリケーションを制作した。

## 主な機能
* 生徒名簿操作（app\Http\Controllers\StudentController.php)  
* 欠課・欠席入力、履歴確認・編集（app\Http\Controllers\AttendanceControler.php)  
* 欠課・欠席履歴ダウンロード（エクセル形式）（app\Http\Controllers\AttendanceControler.php)  

## 今後実装検討予定機能
* 連絡者選択肢のテーブル化（連絡者選択肢の増加への対応）  
* 欠課予定時間の変更（遅刻の他、早退も入力可能とする）

## 作成者
Y.Mochiduki
