<h1>新規作成画面</h1>
<form action="{{ route('store.post') }}" method="post">
    @csrf
    <div>
        @if ($errors->any())
           <div class="alert alert-danger">入力内容に不備があります。エラー内容をご確認ください。</div> 
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        @endif
    </div>

    <div>
        タイトル
        <input type="text" name="title">
    </div>


    <div>
        投稿者
        <select name="author_id" id="">
            <option value="">選択してください</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->author_name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        本文
        <textarea name="content" id="" cols="30" rows="10"></textarea>
    </div>
    <input type="submit">
</form>
