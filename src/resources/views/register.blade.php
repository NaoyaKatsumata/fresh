@extends('header')

@section('content')
    <div class="flex flex-col">
        <div class="w-[60%] mx-auto">
            <form action="{{'/products/register'}}" method="post" enctype="multipart/form-data">
                @csrf
                <h1 class="text-3xl font-bold text-gray-900">商品登録</h1>
                <div class="flex mt-8">
                    <p>商品名</p>
                    <span class="bg-red-500 mx-4 px-2 text-white">必須</span>
                </div>
                <input type="text" name="name" class="w-full h-[40px] mt-4 px-4 border rounded-md" placeholder="商品名を入力">
                @if ($errors->has('name'))
                    <div class="text-red-500">{{ $errors->first('name') }}</div>
                @endif
                <div class="flex mt-8">
                    <p>値段</p>
                    <span class="bg-red-500 mx-4 px-2 text-white">必須</span>
                </div>
                <input type="text" name="price" class="w-full h-[40px] mt-4 px-4 border rounded-md" placeholder="値段を入力">
                @if ($errors->has('price'))
                    <div class="text-red-500">{{ $errors->first('price') }}</div>
                @endif
                <div class="flex mt-8">
                    <p>商品画像</p>
                    <span class="bg-red-500 mx-4 px-2 text-white">必須</span>
                </div>
                <img id="previewImage" class="hidden w-[50%]" alt="Image Preview">
                <input type="file" id="imageInput" name="image" class="mt-4">
                @if ($errors->has('image'))
                    <div class="text-red-500">{{ $errors->first('image') }}</div>
                @endif
                <div class="flex mt-8">
                    <p>季節</p>
                    <span class="bg-red-500 mx-4 px-2 text-white">必須</span>
                </div>
                <div class="flex item-center  mt-4">
                    <input type="checkbox" name="spring" value="spring" class="w-6 h-6 mr-2">春
                    <input type="checkbox" name="summer" value="summer" class="w-6 h-6 ml-4 mr-2">夏
                    <input type="checkbox" name="autumn" value="autumn" class="w-6 h-6 ml-4 mr-2">秋
                    <input type="checkbox" name="winter" value="winter" class="w-6 h-6 ml-4 mr-2">冬
                </div>
                @if ($errors->has('season'))
                    <div class="text-red-500">{{ $errors->first('season') }}</div>
                @endif
                <div class="flex mt-8">
                    <p>商品説明</p>
                    <span class="bg-red-500 mx-4 px-2 text-white">必須</span>
                </div>
                <textarea cols="100" rows="5" maxlength="255" name="description" class="w-full mt-4 border border-gray-300 resize-none" placeholder="商品の説明を入力"></textarea>
                @if ($errors->has('description'))
                    <div class="text-red-500">{{ $errors->first('description') }}</div>
                @endif
                <div class="flex justify-center mt-4 space-x-4">
                    <a href="/products" class="w-[150px] px-4 py-2 bg-gray-300 rounded-m text-center">戻る</a>
                    <input type="submit" name="save" value="変更を保存" class="w-[150px] px-4 py-2 bg-yellow-400 rounded-md">
                </div>
            </form>
        </div>
    </div>

    <!-- 選択した写真をリアルタイムで表示するスクリプト -->
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('previewImage');
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection