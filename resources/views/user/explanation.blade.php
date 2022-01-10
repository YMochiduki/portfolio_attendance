@extends('layouts.not_logged_in')

@section('content')

<h5>欠課・欠席記録システムの概要</h5>
<div class="description">
    <p>欠課・欠席記録システムは、生徒の欠課・欠席連絡を記録するためのアプリケーションです。</p>
    <p>職員室にいる職員が、保護者や生徒からの欠席・遅刻の連絡を欠課・欠席記録システムに入力することで、教室にいる職員もその場で自分のスマートフォンから最新の欠課・欠席連絡の有無を確認することができます。</p>
</div>

<h5>使用方法</h5>
<div class="description">
    <p class="description-head">◆学校情報</p>
    <p>アカウントは、学校で１つ作成してください。</p>
    <p>アカウント作成時に登録した、学校名、メールアドレス、学年数、クラス数（１学年当たり最大数）は、学校情報のページから変更できます。</p>
</div>

<div class="description">
    <p class="description-head">◆名簿操作</p>
    <p>欠課・欠席入力の前に、生徒情報を登録してください。名簿操作から生徒情報を登録することができます。</p>
</div>

<div class="description">
    <p class="description-head">◆多数の生徒を一度に登録する場合</p>
    <p>名簿様式ダウンロードから、様式（エクセルファイル）をダウンロードしてください。</p>
    <p>様式に以下の情報を記入してください。</p>
    
    <p>※入力時の注意※</p>
    <table class="explanation">
    <tr>
        <th>year</th>
        <td>年度を半角数字で入力</td>
    </tr>
    <tr>
        <th>grade</th>
        <td>所属学年を半角数字で入力</td>
    </tr>
    <tr>
        <th>class</th>
        <td>所属クラスを半角数字で入力</td>
    </tr>
    <tr>
        <th>number</th>
        <td>生徒の出席番号を半角数字で入力</td>
    </tr>
    <tr>
        <th>name</th>
        <td>生徒の名前を入力</td>
    </tr>
</table>
    <ul>
        <li>ヘッダー行（１行目）は改変しないでください。<br>
            改変すると、インポート時にエラーが発生します。</li>
        <li>name列以降（F列以降）は何も入力しないでください。</li>
        <li>生徒情報は２行目から入力してください。</li>
        <li>途中に空白行、空欄があるとインポート時にエラーが発生します。</li>
    </ul>
    <p>インポート後に欠課・欠席入力が使用できるようになります。</p>
    <p>【推奨】年度ごとに名簿を削除し、新規作成してください。</p>
</div>

<h6>欠課・欠席入力</h6>
<div class="description">
    <p>欠課・欠席を入力する生徒を検索してください。</p>
    <p>入力ボタンをクリックすると入力フォームが表示されます。</p>
    <p>日付、欠課・欠席、欠課の場合欠課予定の時間、連絡者、理由を入力し、保存してください。</p>
</div>

<h6>欠課・欠席履歴</h6>
<div class="description">
    <p>欠課・欠席履歴を確認・編集する対象を検索してください。</p>
    <p>欠課・欠席日を指定しない場合は、日付設定を削除してください。</p>
    <p>編集ボタンをクリックすると編集フォームが表示されます。</p>
    <p>欠課・欠席履歴を削除する場合も、編集フォームから削除できます。</p>
    <p>欠課・欠席履歴の一覧は、欠課・欠席情報ダウンロードからエクセル形式でダウンロードすることができます。</p>
</div>

@endsection