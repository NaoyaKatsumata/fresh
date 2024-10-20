@extends('header')

@section('content')
    <div class="flex flex-row justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">商品一覧</h1>
        <a href="/products/register" class="py-2 px-8 bg-amber-500 rounded-[5px] hover:bg-amber-600">+ 商品を追加</a>
    </div>
    <div class="my-4 flex flex-row">
        <!-- 検索＆ソートナビゲーション -->
        <div class="w-[20%] mr-4">
        
            <!-- 商品名で検索 -->
            <form action="/products" method="post">
                @csrf
                <input type="text" name="fruitName" class="w-full border rounded-[50px] p-2" value="{{ isset($fruitName) ? $fruitName : null }}" placeholder="商品名で検索">
                <input type="submit" name="search" class="w-full mt-4 py-2 text-center bg-yellow-400 rounded-[5px] hover:bg-yellow-500" value="検索">
            </form>
            <!-- 値段で並び替え -->
            <form id="price-sort" action="/products" method="get" class="my-12">
                <p class="text-xl font-semibold leading-tight text-gray-800 mb-4">価格順で表示</p>
                <input type="hidden" name="sort" id="sort-value" >
                <input type="hidden" name="fruitName" id="fruit-value" >
                <div class="relative inline-block w-full">
                    <div class="custom-select">
                        <div class="custom-select-trigger bg-white border border-gray-300 rounded-lg p-2 cursor-pointer @php
                                    if(empty($sort)) {
                                        echo 'text-gray-400';
                                    }
                                @endphp">
                            @php
                                $test = "";
                                if(empty($sort)){
                                    echo "選択してください";
                                }elseif($sort==='lowest'){
                                    echo "安い順に表示";
                                }elseif($sort==='highest'){
                                    echo "高い順に表示";
                                }
                            @endphp
                        </div>
                        <div class="custom-options absolute hidden bg-white border border-gray-300 rounded-lg mt-2 w-full shadow-lg">
                            <span class="custom-option block px-4 py-2 hover:bg-gray-200 cursor-pointer" data-value="highest">高い順に表示</span>
                            <span class="custom-option block px-4 py-2 hover:bg-gray-200 cursor-pointer" data-value="lowest">安い順に表示</span>
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-2 flex items-center pr-2 pointer-events-none">
                        <svg id="custom-arrow" class="w-8 h-8 text-red-500 transition-transform duration-200" viewBox="0 0 24 24" fill="#A0A0A0">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5H7z"/>
                        </svg>
                    </div>
                </div>
                <hr class="w-full mt-4 border-t-2 border-gray-300">
            </form>
        </div>
        <!-- 果物カード -->
        <div class="w-[80%] flex flex-wrap">
            @foreach($fruits as $fruit)
            <a href="{{'/products/'.$fruit->id}}" class="w-[30%] mr-[3%] mb-8">
                <img src="{{ asset($fruit->image)}}" alt="{{$fruit->image}}" class="w-full h-[80%]">
                <div class="flex flex-row justify-between items-center px-4 bg-white h-[20%]">
                    <p class="">{{$fruit->name}}</p>
                    <p class="">¥{{$fruit->price}}</p>
                </div>
            </a>
            @endforeach
            <!-- ページネーションUIカスタム -->
            <div class="flex justify-center w-full">
                @if ($fruits->hasPages())
                    <nav class="flex items-center">
                        <div class="mr-4">
                            @if ($fruits->onFirstPage())
                                <span class="w-2 h-2 px-2 py-1 text-black bg-white rounded-full"><</span>
                            @else
                                <a href="{{ $fruits->previousPageUrl() }}&sort={{ $sort }}" class="w-2 h-2 px-2 py-1 text-black bg-white rounded-full hover:underline"><</a>
                            @endif
                        </div>

                        <div class="flex space-x-2 mx-4">
                            @foreach ($fruits->getUrlRange(1, $fruits->lastPage()) as $page => $url)
                                @if ($page == $fruits->currentPage())
                                    <span class="bg-yellow-400 px-2 text-white rounded-full">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}&sort={{ $sort }}" class="bg-white px-2 text-black rounded-full hover:underline">{{ $page }}</a>
                                @endif
                            @endforeach
                        </div>

                        <div class="ml-4">
                            @if ($fruits->hasMorePages())
                                <a href="{{ $fruits->nextPageUrl() }}&sort={{ $sort }}" class="w-2 h-2 px-2 py-1 text-black bg-white rounded-full hover:underline">></a>
                            @else
                                <span class="w-2 h-2 px-2 py-1 text-black bg-white rounded-full">></span>
                            @endif
                        </div>
                    </nav>
                @endif
            </div>
        </div>
    </div>

    <!-- 価格で並び替えのselectボックスのカスタム関連 -->
    <script>
        const select = document.getElementById('custom-select');
        const customSelectTrigger = document.querySelector('.custom-select-trigger');
        const arrowIcon = document.getElementById('custom-arrow');
        const customOption = document.querySelector('.custom-options');
        const options = document.querySelectorAll('.custom-option');
        const sortValue = document.getElementById('sort-value');
        const fruitValue = document.getElementById('fruit-value');
        const priceForm = document.getElementById('price-sort');
        const fruitNameInput = document.querySelector('input[name="fruitName"]');

        customSelectTrigger.addEventListener('click', function() {
            customOption.classList.toggle('hidden');
            arrowIcon.classList.toggle('rotate-180');
        });

        options.forEach(option => {
            option.addEventListener('click', function() {
                const selectedValue = this.getAttribute('data-value');
                const selectedText = this.textContent;
                customSelectTrigger.textContent = selectedText;
                customOption.classList.add('hidden');
                customSelectTrigger.classList.remove('text-gray-400');
                customSelectTrigger.classList.add('text-black');
                arrowIcon.classList.toggle('rotate-180');
                
                let url = new URL(window.location.href);
                url.searchParams.set('sort', selectedValue); // クエリパラメータにsortを追加
                url.searchParams.set('fruitName', fruitNameInput.value); // クエリパラメータにsortを追加
                window.location.href = url.toString(); // ページをリロード
                sortValue.value = selectedValue;
                fruitValue.value = fruitNameInput.value
                priceForm.submit();
            });
        });
    </script>

    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }

        .custom-options.hidden {
            display: none;
        }
    </style>
@endsection