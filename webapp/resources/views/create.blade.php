<h1>新規作成画面</h1>
<form action="{{ route('store.post') }}" method="post">
    @csrf
    <!-- タイトル入力 -->
    <div>
        タイトル
        <input type="text" name="title">
        <!--value="{{ old('title') }}"
        @error('title')
            <li>{{ $message }}</li>
        @enderror-->
    </div>


    <div>
        投稿者
        <select name="author_id" id="">
            <option value="">選択してください</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}">{{ $author->author_name }}</option>
            @endforeach

            <!--@if ($errors->has('author_id'))
            <tr>
                <tr>ERROR</tr>
                @foreach($errors->get('author_name') as $message)
                <td>{{ $message }}</td>
                @endforeach
            </tr>
            @endif-->
        </select>
    </div>
    <div>
        本文
        <textarea name="content" id="" cols="30" rows="10"></textarea>
       <!--@if ($errors->has('content'))
        <tr>
            <tr>ERROR</tr>
            @foreach($errors->get('content') as $message)
            <td>{{ $message }}</td>
            @endforeach
        </tr>
        @endif-->
    </div>
    <input type="submit">

     <!-- エラーメッセージ全体表示 -->
     <div>
        @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
        @endif
    </div>
</form>
