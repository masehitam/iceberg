@if(!empty($errors))
    @if($errors->any())
        <ul class="alert alert-danger" style="list-style-type: none">
            <li><a href="#">入力内容に誤りがあります。</a></li>
            <li><a href="#">赤字でエラー表示されている項目の内容を訂正してください。</a></li>
        </ul>
    @endif
@endif
